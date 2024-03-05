<?php

namespace App\Models;

use App\Configs\Setting;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Session;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Models\Role;


class Occurrences extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'company_id',
        'department_id',
        'status',
        'severity',
        'topic',
        'description',
        'classification',
        'email',
        'confidential_name',
        'confidential_email'
    ];
    CONST RANDOM_BITE = 50;

    /**
     * @return BelongsTo
     */
    public function categories() : BelongsTo
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    /**
     * Get the Occurrebces associated with the Companies.
     */
    public function companies(): BelongsTo
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }

    /**
     * Get the Occurrebces associated with the departments.
     */
    public function departments(): BelongsTo
    {
        return $this->belongsTo(Departments::class, 'department_id');
    }

    /**
     * @return HasOne
     */
    public function whistleblower(): HasOne
    {
        return $this->hasOne(Whistleblower::class, 'occurrences_id');
    }

    /**
     * @return hasMany
     */
    public function files(): hasMany
    {
        return $this->hasMany(MediaOccurrence::class, 'occurrences_id');
    }


    /**
     * @return string
     * @throws Exception
     */
    public static function generatorPassword(): string
    {
        return bin2hex(random_bytes(self::RANDOM_BITE / 2));
    }

    public function sendEmail(int $companyId, string $settingName, $settingValue, $details)
    {
        $emails = $this->getEmails($companyId, $settingName, $settingValue);
        /** merge emails with sender email */
        //$emails = array_merge($emails, [$details['email']]);
        $emails = array_unique($emails);
        $createdByemail = $this->getEmailUserCreatedCompany($companyId);

        if (count($emails) > 0){

            foreach ($emails as $key => $email){
                if ($createdByemail === $email) {
                    continue;
                }

                //The email sending is done using the to method on the Mail facade
                //send email to all users in the company.
                Mail::to($email)->send(new EmailNotification($details, $email, true));
            }
        }

        /**
         * Send email to sender.
         */
        if($details['email']){
            Mail::to($details['email'])->send(new EmailNotification($details, $details['email']));
        }


    }

    /**
     * get user same company and get user setting allow status.
     * @param int $companyId
     * @param string $settingName
     * @param $settingValue
     * @return array
     */
    private function getEmails(int $companyId, string $settingName, $settingValue = true) : array
    {
        $users = Users::join('user_company', 'user_company.user_id', '=', 'users.id')
            ->join('user_settings', 'user_settings.user_id', '=', 'users.id')
            ->where('user_company.company_id', '=', $companyId)
            ->where('user_settings.name', '=', $settingName)
            ->where('user_settings.value', '=', $settingValue)
            ->where('user_settings.active', '=', 1)
            ->get(['users.email'])
            ->toArray();
        $emails = array_map(function ($users){
            return $users['email'];
        }, $users);
        return $emails ?? [];
    }


    public function mediaFiles( array $collection ) : array
    {
        foreach ($collection as $key => $values){
            $media = self::find($values['id'])->getMedia('media');
            $collection[$key]['media'] = $media;
        }
        return $collection;
    }


    public function mediaView(array $attributes) : array
    {
        if(is_numeric($attributes['id'])){
            $media = self::find($attributes['id'])->getMedia('media');
            $attributes['media'] = $media;
        }

        return $attributes;
    }


    /**
     * @param Request $request
     * @return array
     */
    public function getReport(Request $request): array
    {
        $occurrence = [];
        $accessKeys = [];
        $comments = [];
        $passCodes = explode(":", $request['password']);
        if(count($passCodes) == 2){
            $accessKeys = Whistleblower::select('whistleblower_public_key', 'whistleblower_private_key', 'occurrences_id')
                ->where([
                    'uuid' => $passCodes[0]
                ])->first();

            if( isset($accessKeys['occurrences_id']) ){
                $occurrence = Occurrences::with(['companies', 'categories', 'departments', 'whistleblower', 'files'])->where('id',  $accessKeys['occurrences_id'])
                    ->whereHas('companies')
                    ->whereHas('categories')
                    ->first();

                $comments = Notes::with('user')->where('occurrence_id', $accessKeys['occurrences_id'])->where('type', 'comment')->orderByDesc('id')->get();

            }
        }

        return [
            'occurrence' => $occurrence,
            'access_keys' => $accessKeys,
            'comments' => $comments,
            'password' => $passCodes[1] ?? '',
        ];
    }

    /**
     * @param $details
     * @return void
     * @throws Exception
     */
    public function sendEmailToTopicOwner($details)
    {
        try {
            if($details['email']){
                Mail::to($details['email'])->send(new EmailNotification($details, $details['email']));
            }
        } catch (\Exception $e) {
            throw new Exception(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Get comment detail before send the email.
     * @param Request $request
     * @return array
     */
    public function emaildetails(Request $request, string $actionSetingName ): array
    {
        $companyAttributes = $this->getCompanyLogo($request);

        return [
            'company_id' => $request['occurrence']['companies']['id'],
            'setting_name' => $actionSetingName,
            'company_name' => $request['occurrence']['companies']['name'] ?? '',
            'name' => $request['occurrence']['classification'],
            'email' => $request['email'] ?? '',
            'company_logo_url' => route('media.display', $companyAttributes['attribute_value'] ?? ''),
            'report_url' => route('occurrences.check.report'),
        ];
    }

    protected function getCompanyLogo($request): array
    {
        $query = CompanySettings::where([
            'company_id' => $request['occurrence']['companies']['id'] ?? 0,
            'attribute_name' => 'logo'
        ])->get();
        if ($query->count()) {
            return $query->first()->toArray();
        }
        return [];
    }


    public function sendEmailToUsers(int $companyId, string $settingName, bool $settingValue , array $details)
    {
        $emails = $this->getEmails($companyId, $settingName, $settingValue);
        $emails = array_unique($emails);
        $createdByemail = $this->getEmailUserCreatedCompany($companyId);

        if (count($emails) > 0){

            foreach ($emails as $key => $email){
                if ($createdByemail === $email) {
                    continue;
                }
                Mail::to($email)->send(new EmailNotification($details, $email, true));
            }
        }
    }

    public function getEmailUserCreatedCompany(int $companyId)
    {
        $company = Companies::with(['user'])->where('id', $companyId)->whereHas('user')->first()->toArray();
        return  ($company['user']) ? $company['user']['email'] : null;
    }
    public function getStatus()
    {
        return [
          Setting::SETTING_OCCURRENCE_STATUS_NEW,
          Setting::SETTING_OCCURRENCE_STATUS_RECEIVED,
          Setting::SETTING_OCCURRENCE_STATUS_INSPECTED,
          Setting::SETTING_OCCURRENCE_STATUS_WAITING,
          Setting::SETTING_OCCURRENCE_STATUS_SEND_COMPANY,
          Setting::SETTING_OCCURRENCE_STATUS_CLOSED
        ];
    }
    public function updateStatus(int $occurenceId, string $status)
    {
        try {
            self::find($occurenceId)->update([
                'status' => $status,
            ]);

        } catch (\Exception $e) {
            // Return a response with an error message
            return response()->json(['error' => 'An error occurred'], 500);
        }
        return true;
    }

    public function notificationMarkAsRead(int $occurenceId)
    {
        $user = Auth::user();
        foreach ($user->unreadNotifications as $notification) {
            if(
                $notification['data']['id'] === $occurenceId
                && $notification['notifiable_id'] === Auth::user()->id
                && $notification['notifiable_type'] === 'App\Models\User'
                && $notification['type'] === 'App\Notifications\OccurrencesSubmited'
            ){
                $notification->markAsRead();
            }
        }
    }

    public function getUsersInCompany(): array
    {
        $lists = array();
        $companyId = Session::get('company.id') ?? 0;
        $usersCompany = UserCompany::where('company_id', $companyId)->get();
        if($usersCompany->count()){
            foreach ($usersCompany->toArray() as $item){
                $user = User::find($item['user_id'])->toArray();
                $lists[] = $user;
            }
        }

        return $lists;
    }
    public function getUsersInCompanyExcludeAdmin()
    {
        $managerRole = Role::findByName('manager', 'web');
        $userRole = Role::findByName('user', 'web');
        $managerId = $managerRole->id ?? 0;
        $userId = $userRole->id ?? 0;

        $users = $this->getUsersInCompany();
        $roles = [$managerId, $userId];
        $companyUsers = array();

        foreach ($users as $user){
            if(in_array($user['role_id'], $roles)){
                $companyUsers[] = $user;
            }
        }
        return $companyUsers;
    }

    /**
     * @param int|null $occurrenceId
     * @return array
     */
    public function getAssignmentUsers(?int $occurrenceId): array
    {
        $assignment = Assignment::where('occurrence_id', $occurrenceId)->where('active', true)->get();
        if($assignment->count()){
            $assignmentUserIds = array_values($assignment->pluck('user_id')->toArray());
            $users = $this->getUsersInCompanyExcludeAdmin();

            return $this->assignmentUserActive($users, $assignmentUserIds);
        }
        return [];
    }
    private function assignmentUserActive(array $users, array $assignmentUserIds): array
    {
        $result = [];
        foreach ($users as $user){
            if(in_array($user['id'], $assignmentUserIds)){
                $result[] = $user;
            }
        }

        return $result;
    }

    public function assignmentUsersUpdate(Request $request)
    {
        /**Change all items to disable status before update */
        $this->assignmentDisableItems($request);

        if(count($request->users ) > 0){

            foreach ($request->users as $key => $user)
            {
                Assignment::updateOrCreate([
                    'user_id' => $user['id'],
                    'occurrence_id' => $request->id
                ],[
                    'user_id' => $user['id'],
                    'occurrence_id' => $request->id,
                    'active' => $request->status
                ]);

            }
        }

    }
    private function assignmentDisableItems(Request $request)
    {
        try {
            Assignment::where([
                'occurrence_id' => $request->id
            ])->update(
                ['active' => false]
            );
        }catch (\Exception $exception){
            die($exception);
        }
    }

	/**
	 * @param array $occurences
	 * @return array
	 */
	public function checkNullDepartment(array $occurences): array
	{
		return array_map(function ($occurence){
			if(!$occurence['departments']){
				$occurence['department_id'] = 0;
				$occurence['departments'] = [
						"id" => 0,
				        "name" =>  "None",
				        "default" => 0
				];
			}

			return $occurence;
		}, $occurences);

	}


}

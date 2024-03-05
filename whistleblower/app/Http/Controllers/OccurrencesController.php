<?php

namespace App\Http\Controllers;

use App\Configs\Severity;
use App\Mail\EmailNotification;
use App\Models\CompanySettings;
use App\Models\MediaOccurrence;
use App\Models\Notes;
use App\Models\Occurrences;
use App\Models\UserCompany;
use App\Models\Users;
use App\Models\UserSettings;
use App\Models\Whistleblower;
use App\Permissions\Permission as PermissionName;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Categories;
use App\Models\Companies;
use App\Models\Departments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Notifications\OccurrencesSubmited;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Jobs\OccurrencesSendEmail;
use Illuminate\View\Compilers\BladeCompiler;
use App\Models\Notifications;
use App\Jobs\OccurrencesCommentSendEmail;
use App\Jobs\OccurrencesGuestCommentSendEmail;

class OccurrencesController extends Controller
{
    private Occurrences $occurrences;
    private UrlGenerator $url;

    public function __construct(
        Occurrences $occurrences,
        UrlGenerator $urlGenerator
    )
    {
        $this->occurrences = $occurrences;
        $this->url = $urlGenerator;

        $this->middleware('permission:'.PermissionName::CAN_VIEW_OCCURRENCES,['only'=>['index', 'show']]);
//        $this->middleware('permission:'.PermissionName::CAN_CREATE_OCCURRENCES, ['only' => ['create', 'store']]);
        $this->middleware('permission:'.PermissionName::CAN_UPDATE_OCCURRENCES, ['only'=>['edit', 'update']]);
        $this->middleware('permission:'.PermissionName::CAN_DELETE_OCCURRENCES, ['only' => ['destroy']]);

        /** comment permission */
//        $this->middleware('permission:'.PermissionName::CAN_VIEW_NOTES,['only'=>['index', 'show']]);
//        $this->middleware('permission:'.PermissionName::CAN_CREATE_NOTES.'|'.PermissionName::CAN_UPDATE_NOTES, ['only' => ['postComment', 'updateComment']]);
        $this->middleware('permission:'.PermissionName::CAN_DELETE_NOTES, ['only' => ['destroyComment']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /** get companies in current user */
        $companyIds = UserCompany::companyIdsByUser();
        $companies = UserCompany::getUserCompanies();

        $occurrences = Occurrences::with(['companies', 'categories', 'departments', 'whistleblower'])->whereIn('company_id', $companyIds )->get(); /** files disabled*/
        $collection = $occurrences->toArray() ?? [];

        return Inertia::render('Company/Occurrences/Index',[
            'user_company' => UserCompany::getSelectedCompany(),
            'occurrences' => $this->occurrences->checkNullDepartment($collection),
            'companies' => $companies,
	        'categories' => Categories::getEnabledCagegoryById(Session::get('company.id')),
	        'departments' => Departments::getEnabledDepartmentById(Session::get('company.id')),
            'severity_types' => Severity::getSeverity()
        ]);
    }

    /**
     * @return array
     */
    private function getUserCompanies(): array
    {
        $userCompanies = UserCompany::with('companies', 'users')->where('user_id', Auth::user()->id)
            ->whereHas('companies')->pluck('company_id')->toArray();
        return $userCompanies ?? [];
    }

    /**
     * @param Request $request
     * @return \Inertia\Response|string
     */
    public function create(Request $request)
    {
        if($request->company_slug){
            return $this->companySlug($request->company_slug);
        }
        return redirect()->route('occurrences.index');
    }

    /**
     * Store validate before a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function validateCreateForm(Request $request)
    {
        Validator::make($request->all(), [
            'company_id' => ['required'],
            'category_id'=> ['required'],
            'topic' => ['required'],
            'description' => ['required'],
            'classification' => ['required'],
            'file' => 'nullable',
        ])->validate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $occurrences = Occurrences::create($request->all());
        if ($request['file']) {
            $this->addOccurrencesMedia($request['file'], $occurrences->id);

        }
        $request['id'] = $occurrences->id;


        /** add notification alert system */
        if($request['company_id']){
            $this->receiveOccurrence($request, $request['company_id']);
        }

        /**
         * whistleblower system add data.
         */
        if($occurrences->id){
            $request = $this->whistleBlowerAddData($request);
        }


        return Inertia::render('Company/Occurrences/Notification',['request' => $request]);
    }


    /**
     * @param array $files
     * @param int $occurence_id
     * @return \Illuminate\Http\JsonResponse|void
     */
    private function addOccurrencesMedia(array $files,int $occurence_id)
    {
        foreach ($files as $index => $file) {
            try {
                $file = json_decode($file);
                $data = [
                    'occurrences_id' => $occurence_id,
                    'data_base64' => $file->data_base64,
                    'file_name' => $file->file_name,
                    'mime_type' => $file->mime_type,
                    'size' => $file->size,
                    'uuid' => (string) Str::uuid(),
                    'user_id' => Auth::user()->id ?? 0
                ];
                $mediaOccurrence = MediaOccurrence::create($data);

            } catch (\Exception $e) {
                // Return a response with an error message
                return response()->json(['error' => 'An error occurred'], 500);
            }
        }
    }



    /**
     * Send notification to all user in the company.
     * @param Request $request
     * @param int $companyId
     * @return void
     */
    private function receiveOccurrence(Request $request, int $companyId): void
    {
        /** send notification to all users in the company */
        $userIds = UserCompany::getAllUserIdsInCompany($companyId);
        if(count($userIds) > 0){
            $users = User::whereIn('id', $userIds)->get();
            Notification::send($users, new OccurrencesSubmited($request));
        }
    }

    private function whistleBlowerAddData(Request $request): Request
    {
        $uuid = (string) Str::uuid();
        $data = [
            'occurrences_id' => $request['id'],
            'uuid' => $uuid,
            'whistleblower_private_key' => $request['whistleblower_private_key'],
            'whistleblower_public_rsa_key' => $request['whistleblower_public_rsa_key'],
            'company_public_key' => $request['company_public_key'],
            'whistleblower_public_key' => $request['whistleblower_public_key'],
        ];
         Whistleblower::create($data);

        return $this->downloadPassword($request, $uuid);
    }

    private function downloadPassword(Request $request, string $uuid): Request
    {
        /** create download password */
        $request['password'] = $uuid.":".$request['password'];

        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(?int $id)
    {
        $occurrences = Occurrences::with(['companies', 'categories', 'departments', 'whistleblower', 'files.user'])->where('id', $id )
            ->whereHas('companies')
            ->whereHas('categories')
            ->first();

        $comments = Notes::with('user')->where('occurrence_id', $id)->where('type', 'comment')->orderByDesc('id')->get();
        $notes = Notes::with('user')->where('occurrence_id', $id)->where('type', 'note')->orderByDesc('id')->get();

        $previous = Occurrences::where('id', '<', $id)->max('id');
        $next = Occurrences::where('id', '>', $id)->min('id');

        /** Mark as Read */
        $this->occurrences->notificationMarkAsRead($id);

        return Inertia::render('Company/Occurrences/Show', [
            'occurrence' => $occurrences,
            'next_page' => $next ?? 0,
            'previous' => $previous ?? 0,
            'comments' => Auth::user()->can('view-notes') ? $comments : [],
            'notes' => Auth::user()->can('view-notes') ? $notes : [],
            'status_types' => $this->occurrences->getStatus(),
            'severity_types' => Severity::getSeverity(),
            'assign_users' => $this->occurrences->getUsersInCompanyExcludeAdmin(),
            'assign_users_selected' => $this->occurrences->getAssignmentUsers($id),
	        'categories' => Categories::getEnabledCagegoryById($occurrences['company_id']),
	        'departments' => Departments::getEnabledDepartmentById($occurrences['company_id']),
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return; /** disable */

        $occurrences = Occurrences::find($id);
        $comments = Notes::with('user')->where('occurrence_id', $id)->where('type', 'comment')->orderByDesc('id')->get();
        $categories = Categories::getCategoryById($id); //Departments::where('company_id', $company['id'])->get();
        $departments = Departments::getDepartmentById($id);
        $companies = UserCompany::getUserCompanies();

        return Inertia::render('Company/Occurrences/Edit',
            [
                'occurrences' => $occurrences,
                'categories' => $categories,
                'companies' => $companies,
                'departments' => $departments,
                'comments' => Auth::user()->can('view-notes') ? $comments : []
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        Validator::make($request->all(), [
            'company_id' => ['required'],
            'category_id'=> ['required'],
            'topic' => ['required'],
            'description' => ['required'],
            'classification' => ['required'],
        ])->validate();

        Occurrences::find($id)->update($request->all());
        /** check comment */
        if($request->comment){
            $this->updateComment($id, $request->comment, $request->comment_id);
        }

        return back()->with('message','Updated the item successfully');
    }

    /**
     * Comment On view page and can comment written when Login.
     * @param Request $request
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postComment(Request $request)
    {
        Validator::make($request->all(), [
            'id' => ['required'],
            'comment' => ['required'],
        ])->validate();

        $this->updateComment($request->id,  $request->comment, $request->comment_id);

        /** When submited comment send the email to the owner of topic */
        if($request->email){
            $details = $this->occurrences->emaildetails($request, 'occurrence.updated');
            OccurrencesCommentSendEmail::dispatch($details)->onQueue('occurrences');

            //test direct Send email
//            $this->occurrences->sendEmailToTopicOwner($details);
            //end test
        }

        return back();
    }

    /**
     * @param int $occurrence_id
     * @param string $comment
     * @return array
     */
    public function updateComment(int $occurrence_id, string $comment, $commentId = '') : array
    {
        if(!is_numeric($occurrence_id) || !$comment){
            return [];
        }

        if(is_numeric($commentId)){
            $result =  Notes::find($commentId)->update([
                'text' => $comment,
            ]);
            return Notes::find($commentId)->get()->toArray();
        }

        /** adding comment */
        return Notes::create([
            'text' => $comment,
            'user_id' => Auth::id(),
            'occurrence_id' => $occurrence_id,
            'type' => 'comment'
        ])->toArray();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function destroyComment(Request $request)
    {
        Validator::make($request->all(), [
            'id' => ['required'],
        ]);
        Notes::find($request->id)->delete();

        return back()->with('message','Deleted the item successfully');
    }

    /**
     * @param Request $request
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postStatus(Request $request)
    {
        Validator::make($request->all(), [
            'id' => ['required'],
            'status' => ['required'],
            'occurrence' => ['required'],
            'email' => ['required'],
        ])->validate();

        if ($request->status){
            try {
                $this->occurrences->updateStatus($request->id, $request->status);

                /** Send email to the owner of topic */
                $details = $this->occurrences->emaildetails($request, 'occurrence.updated');
                OccurrencesCommentSendEmail::dispatch($details)->onQueue('occurrences');

                //test direct Send email
//                $this->occurrences->sendEmailToTopicOwner($details);
                //end test

            }catch (\Exception $exception){
                return response()->json($exception);
            }
        }

        return response()->json([
            'message' => 'Updated status to '.$request->status
        ]);
    }
    public function updateSeverity(Request $request)
    {
        Validator::make($request->all(), [
            'id' => ['required'],
            'severity' => ['required'],
            'occurrence' => ['required']
        ])->validate();

        try {
            Occurrences::find($request->id)->update([
                'severity' => $request->severity
            ]);
        }catch (\Exception $exception){
            return response()->json($exception);
        }

        return response()->json([
            'message' => 'Updated the severity item successfully'
        ]);
    }

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function updateCategory(Request $request)
	{
		Validator::make($request->all(), [
			'id' => ['required'],
			'category_id' => ['required']
		])->validate();

		try {
			Occurrences::find($request->id)->update([
				'category_id' => $request->category_id
			]);
		}catch (\Exception $exception){
			return response()->json($exception);
		}

		return response()->json([
			'message' => 'Updated the category item successfully'
		]);
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function updateDepartment(Request $request)
	{
		Validator::make($request->all(), [
			'id' => ['required'],
			'department_id' => ['required']
		])->validate();

		try {
			Occurrences::find($request->id)->update([
				'department_id' => $request->department_id
			]);
		}catch (\Exception $exception){
			return response()->json($exception);
		}

		return response()->json([
			'message' => 'Updated the department item successfully'
		]);
	}
    /**
     * @param Request $request
     */
    public function uploadFiles(Request $request)
    {
        Validator::make($request->all(), [
            'id' => ['required'],
            'file' => ['required']
        ])->validate();

        if ($request->file) {
            $this->addOccurrencesMedia([$request->file], $request->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Occurrences::findOrFail($id)->delete();
        if($record)
        {
           $notifications = Notifications::where('data->id', $id)
           ->where('type', 'App\Notifications\OccurrencesSubmited');
           if($notifications->first()){
               $notifications->delete();
           }

        }
	    return redirect()->route('occurrences.index')->with('message','Deleted the item successfully');
    }


    /**
     * @param string $companySlug
     * @return \Inertia\Response|string
     */
    public function companySlug(string $companySlug)
    {
        $categories = [];
        $departments = [];
        $logo = [];
        if(!$company = Companies::whereSlug($companySlug)->first()){
            return '';
        }
        if(is_numeric($company['id'])){
            $categories = Categories::getEnabledCagegoryById($company['id']);
            $departments = Departments::getEnabledDepartmentById($company['id']);
            $logo = CompanySettings::where([
                'company_id' => $company['id'],
                'attribute_name' => 'logo'
            ])->first();
        }

        return Inertia::render('Company/Occurrences/Create',
            [
                'categories' => $categories,
                'company' => $company->toArray() ?? [],
                'logo' => $logo ?? [],
                'departments' => $departments,
                'slug' => $companySlug,
                'rsa_key' => $company['rsa_key']
            ]
        );
    }
    /**
     * Report password and notification email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notification(Request $request)
    {
        $request['password'] = Occurrences::generatorPassword();
        return Inertia::render('Company/Occurrences/Notification',['request' => $request]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notificationStore(Request $request)
    {
        if($request->email){
            $occurrence = Occurrences::find($request->occurrence_id)->update([
                'email' => $request->email,
                'subject' => $request->subject
            ]);

            $logo = CompanySettings::where([
                'company_id' => $request->company_id,
                'attribute_name' => 'logo'
            ])->first();
            $company = Companies::find($request->company_id)->first();

            $details = [
                'subject' => $request->subject,
                'name' => $request->classification,
                'email' => $request->email_notification,
                'company_id' => $request->company_id,
                'company_name' => $company['name'] ?? '',
                'company_logo_url' => route('media.display', $logo['attribute_value'] ?? ''),
                'report_url' => route('occurrences.check.report'),
                'setting_name' => 'occurrence.created'
            ];

            /** send email */
            $this->sendEmailBySetting($request->company_id, 'occurrence.created', true, $details);
        }

        return $this->thankYou($request);
    }

    public function thankYou($request)
    {
        return Inertia::render('Company/Occurrences/ThankYou',[
            'slug' => $request->slug
        ]);
    }

    /**
     * Download password by link action.
     * @param string $password
     * @return mixed
     */
    public function passwordDownload( string $password)
    {
        $headers = [
            'Content-Type' => 'application/plain',
            'Cache-Control' => 'no-store, no-cache',
            'Content-Description' => 'attachment; filename="password.txt',
        ];

        return \Response::make($password, 200, $headers);
    }

    /**
     * @param int $companyId
     * @param string $settingName
     * @param $settingValue
     * @param array $details
     * @return void
     */
    public function sendEmailBySetting(int $companyId, string $settingName, $settingValue, array $details)
    {
        /** add a sender email to queues */
        $data = [
            'company' => $companyId,
            'name' => $settingName,
            'value' => $settingValue,
            'detail' => $details
        ];

        //Test Send email by not use cornjob
//        $occurrences = new Occurrences();
//        $occurrences->sendEmail(
//            $data['company'],
//            $data['name'],
//            $data['value'],
//            $data['detail']
//        );
        //end test


        /** Delay method not working ??? */
        OccurrencesSendEmail::dispatch($data)->onQueue('occurrences');

    }

    public function checkReport()
    {
        return Inertia::render('Company/Occurrences/Check');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showReport(Request $request)
    {
        Validator::make($request->all(), [
            'password' => ['required']
        ])->validate();

        $report = $this->occurrences->getReport($request);

        return Inertia::render('Company/Occurrences/ReportSummary', [
            'password' => $report['password'] ?? '',
            'occurrence' => $report['occurrence'],
            'access_keys' => $report['access_keys'],
            'comments' => $report['comments'],
            'full_password' => $request['password'],
	        'severity_types' => Severity::getSeverity()
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function reloadReport(Request $request)
    {
        return $this->showReport($request);
    }

    /**
     * CheckReport commenter
     */
    /**
     * @param Request $request
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function guestComment(Request $request)
    {

        Validator::make($request->all(), [
            'id' => ['required'],
            'comment' => ['required'],
        ])->validate();

        $this->guestUpdateComment($request->id,  $request->comment, $request->comment_id);
        /**
         * Send email to Users in the company.
         */
        $data = $this->occurrences->emaildetails($request, 'occurrence.updated');
        OccurrencesGuestCommentSendEmail::dispatch($data)->onQueue('occurrences');

        //test send email no queue
//        $this->occurrences->sendEmailToUsers($data['company_id'], $data['setting_name'], true, $data);
        //end test

        $report = $this->occurrences->getReport($request);
        return response()->json($report);
    }

    /**
     * @param int $occurrence_id
     * @param string $comment
     * @return array
     */
    public function guestUpdateComment(int $occurrence_id, string $comment, $commentId = '') : array
    {
        if(!is_numeric($occurrence_id) || !$comment){
            return [];
        }

        if(is_numeric($commentId)){
            $result =  Notes::find($commentId)->update([
                'text' => $comment,
            ]);
            return Notes::find($commentId)->get()->toArray();
        }

        /** adding comment */
        return Notes::create([
            'text' => $comment,
            'user_id' => Auth::id() ?? 0,
            'occurrence_id' => $occurrence_id,
            'type' => 'comment'
        ])->toArray();
    }

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function guestUploadFiles(Request $request)
	{
		Validator::make($request->all(), [
			'id' => ['required'],
			'file' => ['required']
		])->validate();

		if ($request->file) {
			$this->addOccurrencesMedia([$request->file], $request->id);
		}

		$report = $this->occurrences->getReport($request);
		return response()->json($report);
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function assignmentUsers(Request $request)
    {
        Validator::make($request->all(), [
            'id' => ['required'],
//            'users' => ['required'], // disabled in case remove all users selected.
            'status' => ['required']
        ])->validate();

        /** save action */
        try {
            $this->occurrences->assignmentUsersUpdate($request);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }



}

<?php

namespace App\Models;

use App\Models\Companies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

//use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class UserCompany extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'company_id',
    ];

    public function __construct(array $attributes = [])
    {
        $this->setTable('user_company');
        parent::__construct($attributes);
    }

    public function companies(): BelongsTo
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }

    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function companiesByUser(): array
    {
		if(isset(Auth::user()->id)){
			return self::with('companies', 'users')->where('user_id', Auth::user()->id)
				->whereHas('companies')->get()->toArray() ?? [];
		}
        return [];
    }

    public static function companyIdsByUser(): array
    {
        if(Session::has('company.id')){
            return [
                Session::get('company.id')
            ];
        }

        return [];
    }

    public static function getUserCompanies(): array
    {
        /** get companyIds */
        $companyIds = self::companyIdsByUser();

        /** get all allow categories */
        return Companies::with(['user'])->whereIn('id', $companyIds)->get()->toArray() ?? [];
    }

    /**
     * Retrive userIds in a company by id.
     * @param int $id
     * @return array
     */
    public static function getAllUserIdsInCompany(int $id): array
    {
        $userCompanies = self::where('company_id', $id)->get()->toArray() ?? [];

        return array_map(function ($userCompanies) {
            return $userCompanies['user_id'];
        }, $userCompanies) ?? [];
    }

    public static function selectCompanies()
    {
        /** get companyIds */
        $companyIds = self::getSelectCompanies();

        /** get all allow categories */
        return Companies::whereIn('id', $companyIds)->get()->toArray() ?? [];
    }

    public static function getSelectCompanies()
    {
        /** show company ids for current user */
        $userCompanies = self::companiesByUser();
        return array_map(function ($userCompanies) {
            return $userCompanies['company_id'];
        }, $userCompanies) ?? [];
    }

    /**
     * Get Selected Company details
     * @return array
     */
    public static function getSelectedCompany(): array
    {
        if(Session::has('company.id')){
            return Companies::where('id', Session::get('company.id'))->select(
                ['id', 'name', 'slug']
            )->first()->toArray();
        }
        return [];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Departments extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'company_id',
        'default'
    ];

    /**
     * Get the department associated with the Companies.
     */
    public function companies(): BelongsTo
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }
    /**
     * Get Departments by default and get by user.
     * @return array
     */
    public static function userDepartments(): array
    {
        /** 1.) get default categoryIds */
        $default = self::getDefault();
        $defaultIds = self::departmentDefaultIds($default);

        /** 2). get User companyIds */
        $companyIds = self::getCompanyIds();

        /** 3). get all categoryIds can allow actions */
        $categoryIds = self::getUserDepartmentIds($companyIds);

        /** 4). Merge default and allow categories */
        $allCategoryId = array_merge($defaultIds, $categoryIds);

        /** get all allow categories */
        return self::whereIn('id', $allCategoryId)->get()->toArray() ?? [];
    }
    /**
     * Get default departments.
     * @return array
     */
    public static function getDefault(): array
    {
        return self::where('default', true)->get()->toArray() ?? [];
    }

    /**
     * Get department ids by current user.
     * @param array $companyIds
     * @return array
     */
    private static function getUserDepartmentIds( array $companyIds): array
    {
        /** check in case admin get all departments */
        if(Auth::user()->hasRole('admin')){
            $deparments = self::all()->toArray();
            return array_map(function ($deparments) {
                return $deparments['id'];
            }, $deparments) ?? [];
        }

        $userDepartments = CompanyDepartments::with('companies', 'departments')
            ->whereIn('company_id', $companyIds)
            ->whereHas('companies')
            ->whereHas('departments')
            ->get()->toArray();

        return array_map(function ($userDepartments) {
            return $userDepartments['department_id'];
        }, $userDepartments) ?? [];
    }
    public static function getCompanies(): array
    {
        return UserCompany::companiesByUser();
    }

    private static function getCompanyIds(): array
    {
        return UserCompany::companyIdsByUser();
    }

    private static function departmentDefaultIds(array $departments): array
    {
        return array_map(function ($departments) {
            return $departments['id'];
        }, $departments) ?? [];
    }

    public static function getDepartmentById(int $companyId)
    {
        /** 1.) get default categoryIds */
        $default = self::getDefault();
        $defaultIds = self::departmentDefaultIds($default);

        /** 2). get all categoryIds can allow actions */
        $departmentIds = self::getCompanyDepartmentIds($companyId);

        /** 4). Merge default and allow department ids */
        $allCategoryId = array_merge($defaultIds, $departmentIds);

        /** get all allow categories */
        return self::whereIn('id', $allCategoryId)->get()->toArray() ?? [];
    }

    private static function getCompanyDepartmentIds( int $companyId): array
    {

        $userDepartments = CompanyDepartments::with('companies', 'departments')
            ->where('company_id', $companyId)
            ->whereHas('companies')
            ->whereHas('departments')
            ->get()->toArray();

        return array_map(function ($userDepartments) {
            return $userDepartments['department_id'];
        }, $userDepartments) ?? [];
    }

    public static function getEnabledDepartmentById(int $companyId)
    {
        $categoryIds = self::getEnabledCompanyDepartmentIds($companyId);
        return self::whereIn('id', $categoryIds)->get()->toArray() ?? [];
    }

    private static function getEnabledCompanyDepartmentIds( int $companyIds): array
    {
        $categories = CompanyDepartments::with('companies', 'departments')
            ->where('company_id', $companyIds)
            ->where('active', true)
            ->whereHas('companies')
            ->whereHas('departments')
            ->get();
        if(!$categories){
            return [];
        }

        $categories = $categories->toArray();
        return array_map(function ($categories) {
            return $categories['department_id'];
        }, $categories) ?? [];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Categories extends Model
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
        'default'
    ];
    public $timestamps = true;

    public function companies(): BelongsTo
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }

    /**
     * Get categories by default and get by company user.
     * @return array
     */
    public static function userCategories(): array
    {
        /** 1.) get default categoryIds */
        $default = self::getDefault();
        $defaultIds = self::categoryDefaultIds($default);

        /** 2). get User companyIds */
        $companyIds = self::getCompanyIds();

        /** 3). get all categoryIds can allow actions */
        $categoryIds = self::getUserCategoryIds($companyIds);

        /** 4). Merge default and allow categories */
        $allCategoryId = array_merge($defaultIds, $categoryIds);

        /** get all allow categories */
        return self::whereIn('id', $allCategoryId)->get()->toArray() ?? [];
    }

    /**
     * Get default category.
     * @return array
     */
    public static function getDefault(): array
    {
        return self::where('default', true)->get()->toArray() ?? [];
    }
    /**
     * Get default category Ids.
     * @return array
     */
    public static function getDefaultIds(): array
    {
        /** 1.) get default categoryIds */
        $default = self::getDefault();
        $defaultIds = self::categoryDefaultIds($default);

        return $defaultIds ?? [];
    }

    /**
     * Get category ids by current user.
     * @param array $companyIds
     * @return array
     */
    private static function getUserCategoryIds( array $companyIds): array
    {
        /** check in case admin get all categories */
        if(Auth::user()->hasRole('admin')){
            $categories = self::all()->toArray();
            return array_map(function ($categories) {
                    return $categories['id'];
                }, $categories) ?? [];
        }

        $userCategories = CompanyCategories::with('companies', 'categories')
            ->whereIn('company_id', $companyIds)
            ->whereHas('companies')
            ->whereHas('categories')
            ->get()->toArray();

        return array_map(function ($userCategories) {
            return $userCategories['category_id'];
        }, $userCategories) ?? [];
    }
    public static function getCompanies(): array
    {
        return UserCompany::companiesByUser();
    }
    private static function getCompanyIds(): array
    {
        return UserCompany::companyIdsByUser();
    }
    private static function categoryDefaultIds(array $categories)
    {
        return array_map(function ($categories) {
            return $categories['id'];
        }, $categories) ?? [];
    }


    public static function getCategoryById(int $companyId)
    {
        /** 1.) get default item ids*/
        $defaultIds = self::getDefaultIds();

        /** 2). get all categoryIds can allow actions */
        $categoryIds = self::getCompanyCategoryIds($companyId);

        /** 3). Merge default and allow categories */
        $allCategoryId = array_merge($defaultIds, $categoryIds);

        /** get all allow categories */
        return self::whereIn('id', $allCategoryId)->get()->toArray() ?? [];
    }

    private static function getCompanyCategoryIds( int $companyIds): array
    {
        $categories = CompanyCategories::with('companies', 'categories')
            ->where('company_id', $companyIds)
            ->whereHas('companies')
            ->whereHas('categories')
            ->get()->toArray();

        return array_map(function ($categories) {
            return $categories['category_id'];
        }, $categories) ?? [];
    }

    /**
     * @param int $companyId
     * @return array
     */
    public static function getEnabledCagegoryById(int $companyId)
    {
        $categoryIds = self::getEnabledCompanyCategoryIds($companyId);
        return self::whereIn('id', $categoryIds)->get()->toArray() ?? [];
    }

    /**
     * @param int $companyIds
     * @return array
     */
    private static function getEnabledCompanyCategoryIds( int $companyIds): array
    {
        $categories = CompanyCategories::with('companies', 'categories')
            ->where('company_id', $companyIds)
            ->where('active', true)
            ->whereHas('companies')
            ->whereHas('categories')
            ->get()->toArray();

        return array_map(function ($categories) {
            return $categories['category_id'];
        }, $categories) ?? [];
    }

}

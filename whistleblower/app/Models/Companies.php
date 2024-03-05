<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Companies extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'rsa_key'
    ];

    /**
     * @return HasMany
     */
    public function departments() : HasMany
    {
        return $this->hasMany(Departments::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function allCompanies(): array
    {
        return self::all()->toArray();
    }
    public static function setDefaultCategories(int $companyId)
    {
        $categories = Categories::getDefault();
        $data = array();

        if(count($categories) > 0){
            foreach ($categories as $category){
                $data[] = [
                    'category_id' => $category['id'],
                    'company_id' => $companyId,
                    'active' => true,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            /** query */
            try {
                CompanyCategories::insert($data);
            }catch (\Exception $exception){
                return $exception;
            }
        }
        return $data;
    }

    /**
     * @param int $companyId
     * @param array $categoryIds
     * @return array
     */
    public static function updateCategories(int $companyId, array $categoryIds): array
    {
		if($companyId <= 0){
			return [];
		}

        /** get all categories*/
        $catagories = Categories::getCategoryById($companyId);
        /** get categories Ids */
        $allCategoryIds = self::getCategoryIdsFromArray($catagories);
        $result = [];
        foreach ($allCategoryIds as $categoryId){
            if(in_array($categoryId, $categoryIds)){

                /** Check exits values */
                $where = [
                    'category_id' => $categoryId,
                    'company_id' => $companyId,
                    'active' => true
                ];
                if(CompanyCategories::where($where)->exists()){
                    continue;
                }
                /** check in the case add new or update */
                $result[] = CompanyCategories::updateOrCreate(
                    [
                        'category_id' => $categoryId,
                        'company_id' => $companyId,
                    ],
                    [
                        'category_id' => $categoryId,
                        'company_id' => $companyId,
                        'active' => true
                    ]
                );
            }else{
                $result[] = CompanyCategories::updateOrCreate(
                    [
                        'category_id' => $categoryId,
                        'company_id' => $companyId,
                    ],
                    [
                        'category_id' => $categoryId,
                        'company_id' => $companyId,
                        'active' => false
                    ]
                );
            }
        }

        return $result;
    }

    private static function getCategoryIdsFromArray($categories): array
    {
        if(is_array($categories)){
            return array_map(function ($categories) {
                return $categories['id'];
            }, $categories) ?? [];
        }
        return [];
    }

    /**
     * @param int $companyId
     * @param array $departmentIds
     * @return array
     */
    public static function updateDepartments(int $companyId, array $departmentIds): array
    {
	    if($companyId <= 0){
		    return [];
	    }

        /** get all categories*/
        $departments = Departments::getDepartmentById($companyId);
        /** get categories Ids */
        $allDepartmentIds = self::getDepartmentIdsFromArray($departments);
        $result = [];
        foreach ($allDepartmentIds as $departmentId){
            if(in_array($departmentId, $departmentIds)){

                /** Check exits values */
                $where = [
                    'department_id' => $departmentId,
                    'company_id' => $companyId,
                    'active' => true
                ];
                if(CompanyDepartments::where($where)->exists()){
                    continue;
                }
                /** check in the case add new or update */
                $result[] = CompanyDepartments::updateOrCreate(
                    [
                        'department_id' => $departmentId,
                        'company_id' => $companyId,
                    ],
                    [
                        'department_id' => $departmentId,
                        'company_id' => $companyId,
                        'active' => true
                    ]
                );
            }else{
                $result[] = CompanyDepartments::updateOrCreate(
                    [
                        'department_id' => $departmentId,
                        'company_id' => $companyId,
                    ],
                    [
                        'department_id' => $departmentId,
                        'company_id' => $companyId,
                        'active' => false
                    ]
                );
            }
        }

        return $result;
    }

    /**
     * @param array $departments
     * @return array
     */
    private static function getDepartmentIdsFromArray(array $departments): array
    {
        if(is_array($departments)){
            return array_map(function ($departments) {
                return $departments['id'];
            }, $departments) ?? [];
        }
        return [];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySettings extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'attribute_name',
        'attribute_value'
    ];


    public static function getAllLogoValues(): array
    {
        $values = self::where([
            'attribute_name' => 'logo'
        ])->get()->toArray();
        $logoKey = [];

        if($values){
            foreach ($values as $value){
                $logoKey[] = $value['attribute_value'];
            }

            return $logoKey;
        }
        return [];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Permissions\Permission as PermissionName;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
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
        'id'
    ];

    public static function disablePermissions()
    {
        return [
//            PermissionName::CAN_CREATE_NOTES,
//            PermissionName::CAN_UPDATE_NOTES,
        ];
    }
}

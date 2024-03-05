<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyDepartments extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'company_id',
        'department_id',
        'active'
    ];

    /**
     * @return BelongsTo
     */
    public function companies(): BelongsTo
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }

    /**
     * @return BelongsTo
     */
    public function departments(): BelongsTo
    {
        return $this->belongsTo(Departments::class, 'department_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyCategories extends Model
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
        'category_id',
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
    public function categories(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MediaOccurrence extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'occurrences_id',
        'id',
        'data_base64',
        'file_name',
        'mime_type',
        'size',
        'uuid',
        'user_id'
    ];

    public function __construct(array $attributes = [])
    {
        $this->setTable('media_occurrence');
        parent::__construct($attributes);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

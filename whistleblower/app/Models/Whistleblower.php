<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Whistleblower extends Model
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
        'whistleblower_private_key',
        'whistleblower_public_rsa_key',
        'company_public_key',
        'whistleblower_public_key',
        'uuid'
    ];

    public function __construct(array $attributes = [])
    {
        $this->setTable('whistleblower');
        parent::__construct($attributes);
    }

    public function Occurrences(): BelongsTo
    {
        return $this->belongsTo(Occurrences::class, 'occurrences_id', 'id');
    }
}

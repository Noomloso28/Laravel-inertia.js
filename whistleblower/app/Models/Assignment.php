<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'occurrence_id',
        'active'
    ];
    public function __construct(array $attributes = [])
    {
        $this->setTable('assignment');
        parent::__construct($attributes);
    }
}

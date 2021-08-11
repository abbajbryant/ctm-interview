<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'opt_in',
        'email',
    ];

    /**
     * Casting rules for model properties.
     *
     * @var string[]
     */
    protected $casts = [
        'opt_in' => 'bool',
    ];
}

<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'User_data';
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected static function newFactory()
    {
        return \Modules\Auth\Database\factories\LoginFactory::new ();
    }
}

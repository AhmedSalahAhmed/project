<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];
    protected $table = 'role_user';

    protected $fillable = [
        'role_id',
        'user_id',
        'user_type',
    ];

}

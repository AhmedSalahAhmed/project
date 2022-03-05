<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Manager extends Authenticatable
{
    use HasFactory;

    protected $table = 'managers';

    protected $fillable = [
        'manager_name',
        'email',
        'bank_id',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function bank()
    {
        return $this->belongsTo(Bank::class)->withDefault();
    }



}

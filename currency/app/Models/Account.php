<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = 'accounts';
    protected $primarykey = 'id';


    protected $fillable = [
        'balance',
    ];
    public function user()
    {
        return $this->hasOne(User::class);
        return $this->belongsTo(User::class);

    }

   
}

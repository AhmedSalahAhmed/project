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
        'bank_id',
        'currency_id',
    ];
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
   
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}

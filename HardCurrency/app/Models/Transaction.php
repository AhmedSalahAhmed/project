<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';

  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bank_id',
        'bank_currency_id',
        'type',
        'client_name',
        'client_phone',
        'id_number',
        'amount',
    ];

 
    public function bank()
    {
        return $this->hasOne(Bank::class);
    }

  
    public function bank_currency()
    {
        return $this->belongsTo(BankCurrency::class,);
    }


}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyPrice extends Model
{
    use HasFactory;
    protected $table = 'currency_prices';
    
    protected $primarykey = 'id';


    protected $fillable = [
        'buy_price',
        'sale_price',
        'currency_id',
        
    ];
    protected $dates = ['currency_date'];
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    public function bank_currency()
    {
        return $this->belongsTo(BankCurrency::class);
    }
}

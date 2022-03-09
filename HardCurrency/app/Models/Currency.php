<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'currency_name',
        'abbreviation',
        'symbol',
    ];

    /**
     * Get all of the bank_currencies for the Currency
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bank_currencies(): HasMany
    {
        return $this->hasMany(BankCurrency::class,);
    }
    public function currency_prices()
    {
        return $this->hasOne(CurrencyPrice::class,);
    }

   public function account()
   {
       return $this->hasOne(Account::class);
   }
}
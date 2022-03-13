<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bank extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bank_name',
        'logo',
        'state',
        'city',
        'district',
    ];

    protected $with = ['currencies'];


    /**
     * Get all of the currencies for the Bank
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currencies(): HasOne
    {
        return $this->hasOne(BankCurrency::class,);
    }


    /**
     * Get all of the employees for the Bank
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
    public function managers(): HasMany
    {
        return $this->hasMany(Manager::class);
    }

    /**
     * Get all of the employees for the Bank
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }

    /**
     * Get all of the transactions for the Bank
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    } /**
    * Get all of the transactions for the Bank
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function procceses()
   {
       return $this->hasMany(Process::class);
   }

   public function account()
   {
       return $this->hasOne(Account::class);
   }
    // /**
    //  * Get,Set the logo
    //  *
    //  * @param  string  $value
    //  * @return string logo_full_path
    //  */
    // public function logo() : Attribute
    // {
    //     return new Attribute(
    //         get: fn($value) => $value ? asset($value) : null,
    //         set: fn($value) => 'uploads/'.$value
    //     );
    // }
}

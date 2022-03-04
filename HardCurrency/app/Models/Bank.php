<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'email',
        'phone',
        'logo',
        'state',
        'city',
        'district',
    ];

    protected $with = ['currencies'];


    /**
     * Get all of the currencies for the Bank
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function currencies(): HasMany
    {
        return $this->hasMany(BankCurrency::class,);
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

    /**
     * Get all of the transactions for the Bank
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
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

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

    protected $with = ['transactional','bank_currency'];

    public static $operation_names = [
        'deposit' => 'إيداع',
        'withdraw' => 'سحب',
        'transfer' => 'تحويل بنكي'
    ];

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
        'price',
        'transactional_type',
        'transactional_id',
        'qte'
    ];

    /**
     * Get the bank that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class)->withDefault();
    }

    /**
     * Get the bank_currency that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank_currency(): BelongsTo
    {
        return $this->belongsTo(BankCurrency::class,)->select('id','currency_id')->with('currency');
    }


    public function transactional(){
        return $this->morphTo(__FUNCTION__,'transactional_type','transactional_id')->select('id','name','email');
    }

    public static function get_the_price($type, BankCurrency $bank_currency){
        return $type == 'deposit' ? $bank_currency->sale_price : $bank_currency->buy_price;
    }
}
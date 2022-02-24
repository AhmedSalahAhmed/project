<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';

    protected $primarykey = 'id';

    protected $fillable = ['client_name', 'client_phone',
    'id_type', 'id_number', 'amount', 'transaction_type', 'currency'];

}

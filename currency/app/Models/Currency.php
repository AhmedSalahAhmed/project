<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $table = 'currencies';

    protected $primarykey = 'id';

    protected $fillable = ['name', 'sell_price', 'buy_price'];

}

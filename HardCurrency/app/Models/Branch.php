<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
 /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'branches';
    
    protected $primarykey = 'id';


    protected $fillable = [
        'branch_name',
        'state',
        'city',
        'district',
        'phone_number'
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}

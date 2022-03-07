<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'bank_id',
        'phone_number'
    ];

     /**
     * Get the bank that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class)->withDefault();
    }
    
}

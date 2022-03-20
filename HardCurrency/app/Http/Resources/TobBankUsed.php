<?php

namespace App\Http\Resources;

use App\Models\Bank;
use Illuminate\Http\Resources\Json\JsonResource;

class TobBankUsed extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return (Object) [
            'bank' => Bank::find($this->first()->bank_id),
            'processes' => $this->count()
        ];
    }
}

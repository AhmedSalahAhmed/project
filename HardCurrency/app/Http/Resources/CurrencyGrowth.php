<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyGrowth extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'currency_id' => $this->first()->currency_id,
            'currency_name' => $this->first()->currency_name,
            "amount" => $this->sum("amount"),
            'processes' => $this->count(),
        ];
    }
}

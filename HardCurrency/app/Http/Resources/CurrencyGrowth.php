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
        $record = [
            'currency_id' => $this->first()->currency_id,
            'name' => $this->first()->currency_name,
            'total' => $this->first()->amount,
            'month' => $this->first()->month,
            'processes' => $this->count(),
        ];

        return collect($record);
    }
}

<?php

namespace App\Http\Resources\GasolineStation;

use Illuminate\Http\Resources\Json\JsonResource;

class GasolineStationResource extends JsonResource
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
            'id' => $this->id,
            'featured_photo' => $this->featured_photo,
            'name' => $this->name,
            'address' => $this->address,
            'municipality' => $this->municipality->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'time_schedule' => $this->time_started_at ? formatDate($this->time_started_at, 'time') . '-' . formatDate($this->ended_at, 'time') : '',
            'is_always_open' => $this->is_always_open,
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}
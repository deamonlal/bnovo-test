<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'phone' => $this->phone,
            'country' => $this->country,
        ];

        if (isset($this->email)) $data['email'] = $this->email;

        return [
            'status' => true,
            'data' => $data
        ];
    }
}

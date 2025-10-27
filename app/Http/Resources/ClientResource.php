<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id,
        'client_name' => $this->name, 
        'contact_email' => $this->email,
        'phone_number' => $this->phone,
        'logo_url' => $this->getFirstMediaUrl('logos'), 
        'registered_at' => $this->created_at->format('m/d/Y'),
    ];
    }
}

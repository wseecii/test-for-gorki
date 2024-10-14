<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            'firstName' => $this->first_name,
            'surname' => $this->surname,
            'lastName' => $this->last_name,
        ];
    }
}

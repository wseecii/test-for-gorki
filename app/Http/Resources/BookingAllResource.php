<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingAllResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'checkInDate' => Carbon::parse($this->checkin_date)->format('d.m.Y'),
            'status' => $this->status,
            'number' => $this->number,
            'user' => new UserShowResource($this->user),
            'createdAt' => Carbon::parse($this->created_at)->format('d.m.Y H:i:s'),
        ];
    }
}

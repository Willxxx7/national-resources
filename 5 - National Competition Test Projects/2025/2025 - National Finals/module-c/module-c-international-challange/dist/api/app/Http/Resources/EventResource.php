<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'eventId' => $this->event_id,
            'eventCategoryId' => $this->category->cat_id,
            'eventCategory' => $this->category->cat_name,
            'eventName' => $this->event_name,
            'eventCity' => $this->event_city,
            'eventDate' => $this->event_date,
            'eventTime' => $this->event_time,
            'eventNote' => $this->event_note,
            'eventFolder' => $this->event_folder_path,
            'pictures' => PictureResource::collection($this->whenLoaded('pictures'))
        ];
    }
}

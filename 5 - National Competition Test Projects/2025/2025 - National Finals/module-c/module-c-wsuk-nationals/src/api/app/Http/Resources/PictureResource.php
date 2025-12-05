<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PictureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'pictureId' => $this->pic_id,
            'pictureLocator' => $this->pic_locator,
            'eventId' => $this->event_id,
            'event' => $this->event->event_name,
            'categoryId' => $this->cat_id,
            'category' => $this->category->cat_name,
            'pictureName' => $this->pic_name,
            'pictureUploadDate' => $this->pic_upload_date,
            'pictureUploadNote' => $this->pic_upload_note,
            'pictureIsActive' => $this->pic_is_active,
            'picturePath' => $this->pic_path
        ];
    }
}

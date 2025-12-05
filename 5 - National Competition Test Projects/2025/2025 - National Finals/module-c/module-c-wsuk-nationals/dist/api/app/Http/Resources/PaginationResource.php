<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'currentPage' => $this->currentPage(),
            'lastPage' => $this->lastPage(),
            'perPage' => $this->perPage(),
            'total' => $this->total(),
            'nextPageUrl' => $this->nextPageUrl(),
            'prevPageUrl' => $this->previousPageUrl(),
            'onFirstPage' => $this->onFirstPage(),
            'hasNextPage' => (bool)$this->nextPageUrl(),
            'onLastPage' => $this->onLastPage(),
        ];
    }
}

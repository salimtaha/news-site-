<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'posts'=>PostResource::collection($this->collection),
            'count'=>$this->collection->count(),
            'desc'=>'this collection contain all posts',
        ];
    }
}

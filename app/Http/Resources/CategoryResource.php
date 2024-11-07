<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id'            =>$this->id,
            'category_name' =>$this->name,
            'category_slug' =>$this->slug,
            'status'=>$this->status(),
            'created_date'=>$this->created_at->format('y-m-d h:m'),
        ];
        if(!$request->is('api/posts/show/*') && $request->is('categories')){
            $data['posts']=  PostResource::collection($this->posts);
        }

        return $data;

    }
}

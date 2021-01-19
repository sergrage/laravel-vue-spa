<?php

namespace App\Http\Resources;
use Illuminate\Support\Str;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'category_id' => $this->category_id,
          'title' => $this->title,
          'text' => Str::limit($this->text, 50, '...'),
          'created_at' => $this->created_at->toDateString(),
        ];
    }
}

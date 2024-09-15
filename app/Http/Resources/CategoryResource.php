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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->when($request->is('categories*'), function () use ($request) {
                if ($request->is('categories')) {
                    return str($this->description)->limit(20);
                };
                return $this->description;}),
        ];
        //return parent::toArray($request);
    }
}

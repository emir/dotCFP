<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Talk extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'duration' => $this->duration,
            'speaker' => new User($this->user)
        ];
    }
}

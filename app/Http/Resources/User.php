<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class User extends Resource
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
            'name' => $this->name,
            'bio' => $this->bio,
            'avatar' => $this->avatar,
            'twitter' => 'https://twitter.com/' . $this->twitter_handle,
            'github' => 'https://github.com/' . $this->username,
            'url' => $this->url,
            'talks' => new TalkCollection($this->whenLoaded('talks'))
        ];
    }
}

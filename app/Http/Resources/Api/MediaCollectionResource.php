<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Permission\PermissionResource;
use App\Models\Permission;
use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\ResourceCollection;


class MediaCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        $data = MediaResource::collection($this->collection);

        return [
            'data' => $data,
        ];
    }
}

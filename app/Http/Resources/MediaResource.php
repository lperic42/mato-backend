<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Permission\PermissionResource;
use App\Models\Permission;
use Illuminate\Support\Arr;


class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $model_type = explode('\\', $this->model_type);

        return [
            "_MODEL_INSTANCE" => "MEDIA",
            "id" => $this->id,
            'url' => route('media.download', ['media' => $this->id]),
            'src' => route('media.download', ['media' => $this->id]),
            "date_created" => [
                "isoDate" => $this->created_at->format('c'),
                'date' => $this->created_at->format('Y-m-d H:i:s'),
                'timezone' => $this->created_at->timezone
            ],
            'modelExtras' => [
                "model_type" => array_pop($model_type),
                "size" => $this->size,
                'HR_size' => $this->human_readable_size,
                'modelId' => $this->model_id,
                'file_name' => $this->file_name,
                'name' => $this->name,
                'collection' => $this->collection_name,
                'mime_type' => $this->mime_type,
                'media_public_id' => $this->id,
                'description' => Arr::get($this->custom_properties, 'description')
            ],
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
			'id' => $this->id,
			'title' => $this->title,
			'status' => $this->status,
			'desc' => $this->desc,
			'due_date' => $this->due_date,
			'project' => $this->project,
			'completed_at' => $this->completed_at,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
    }
}

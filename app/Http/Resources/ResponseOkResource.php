<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Ramsey\Uuid\Uuid;

class ResponseOkResource extends JsonResource
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
            'success'   => true,
            'data'      => parent::toArray($request),
            'status'    => 200,
            'message'   => 'OK',
            'uuid'      => Uuid::uuid4()
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Observers\ParticipantObserver;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AppointmentResource.
 *
 * @package namespace App\Http\Resources;
 */
class AppointmentResource extends JsonResource
{
    /**
     *  Transform the Appointment to array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
    */
    public function toArray($request)
    {
        return [
            'id'         =>  $this->id,
            'identifier'         =>  IdentifierResource::collection($this->identifier),
            'participant'         =>  ParticipantResource::collection($this->participant),
            'status' => $this->status,
            'performer' => new PerformerResource($this->performer)
        ];
    }
}

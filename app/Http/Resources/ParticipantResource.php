<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ParticipantResource.
 *
 * @package namespace App\Http\Resources;
 */
class ParticipantResource extends JsonResource
{
    /**
     *  Transform the Participant to array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
    */
    public function toArray($request)
    {
        return [
            'actor'         => [
                'reference' => $this->reference
            ],
        ];
    }
}

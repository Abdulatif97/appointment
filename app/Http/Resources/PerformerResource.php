<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PerformerResource.
 *
 * @package namespace App\Http\Resources;
 */
class PerformerResource extends JsonResource
{
    /**
     *  Transform the Performer to array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
    */
    public function toArray($request)
    {
        return [
            'reference' => $this->reference
        ];
    }
}

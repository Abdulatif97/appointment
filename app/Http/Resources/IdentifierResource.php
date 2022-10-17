<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class IdentifierResource.
 *
 * @package namespace App\Http\Resources;
 */
class IdentifierResource extends JsonResource
{
    /**
     *  Transform the Identifier to array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
    */
    public function toArray($request)
    {
        return [
            'use' => $this->use,
            'type' => $this->type,
            'system' => $this->system,
            'value' => $this->value,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            //OR
            'period' => [
                'start' => $this->start_date,
                'end' => $this->end_date,
            ],
            'assigner' => $this->assigner,
        ];
    }
}

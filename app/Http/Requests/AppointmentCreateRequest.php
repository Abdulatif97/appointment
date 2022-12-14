<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identifier.*.use' => 'required',
            'identifier.*.type' => 'required',
            'identifier.*.value' => 'required|unique:identifiers',
            'participant.*.actor.reference' => 'required',
            'performer.reference' => 'required',
        ];
    }
}

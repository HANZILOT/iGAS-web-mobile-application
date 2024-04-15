<?php

namespace App\Http\Requests\GasolineStation;

use Illuminate\Foundation\Http\FormRequest;

class GasolineStationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return match($this->method()) {
            
            'POST' => [
                'name' => ['required'],
                'contact' => ['sometimes','nullable','digits:11'],
                'email' => ['sometimes','nullable','email'],
                'address' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
                'time_started_at' => ['required_if:is_always_open,0'],
                'time_ended_at' => ['required_if:is_always_open,0'],
                'is_always_open' => ['required', 'boolean'],
                'municipality_id' => ['required'],
                'image' => ['required'],
            ],
            'PUT' => [
                'name' => ['required'],
                'contact' => ['sometimes','nullable','digits:11'],
                'email' => ['sometimes','nullable','email'],
                'address' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
                'time_started_at' => ['required_if:is_always_open,0'],
                'time_ended_at' => ['required_if:is_always_open,0'],
                'is_always_open' => ['required', 'boolean'],
                'municipality_id' => ['required'],
                'image' => ['sometimes'],
            ],
        };
    }

    public function messages()
    {
        return [
            'time_started_at.required_if' => 'The time started at field is required when is always open is false',
            'time_ended_at.required_if' => 'The time ended at field is required when is always open is false',
            'municipality_id.required' => 'The municipality field is required',
            'image.required' => 'Please upload atleast one featured photo',
        ];
    }
}
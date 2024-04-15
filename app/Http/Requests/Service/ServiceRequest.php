<?php

namespace App\Http\Requests\Service;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
        $gasoline_station_id = request()->input('gasoline_station_id');

        return match ($this->method()) {
            'POST' => [
                'gasoline_station_id' => ['required'],
                'service' => ['required', Rule::unique('services', 'service')->where('gasoline_station_id', $gasoline_station_id)],
            ],
            'PUT' => [
                'gasoline_station_id' => ['required'],
                'service' => [
                    'required',
                    Rule::unique('services', 'service')
                        ->where('gasoline_station_id', $gasoline_station_id)
                        ->ignore($this->service), // Ignore the current record
                ],
            ],
        };
    }

    public function messages()
    {
        return [
            //'name.required' => 'The service field is required',
            'name.unique' => 'The gasoline service has already been exist',
            'gasoline_station_id.required' => 'The gasoline station field is required.',
        ];
    }
}
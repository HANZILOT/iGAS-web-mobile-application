<?php

namespace App\Http\Requests\GasolineFee;

use App\Models\GasolineFee;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GasolineFeeRequest extends FormRequest
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
        $gasoline_fee_id = $this->route('gasoline_fee');

        return match ($this->method()) {
            'POST' => [
                'gasoline_station_id' => ['required'],
                'type' => [
                    'required',
                    Rule::unique('gasoline_fees', 'type')->where('gasoline_station_id', $gasoline_station_id),
                ],
                'custom_gasoline_type' => [
                    'nullable',
                    'required_if:type,other',
                    function ($attribute, $value, $fail) use ($gasoline_station_id) {
                        // Add custom validation logic to check if custom type already exists
                        $existingCustomType = GasolineFee::where('type', $value)
                            ->where('gasoline_station_id', $gasoline_station_id)
                            ->exists();
    
                        if ($existingCustomType) {
                            $fail('The custom gasoline type already exists.');
                        }
                    },
                ],
                'price' => ['required'],
            ],
            'PUT' => [
                'gasoline_station_id' => ['required'],
                'type' => [
                    'required',
                    Rule::unique('gasoline_fees', 'type')
                        ->where('gasoline_station_id', $gasoline_station_id)
                        ->ignore($gasoline_fee_id), // Ignore the current record
                ],
                'custom_gasoline_type' => [
                    'nullable',
                    'required_if:type,other',
                    function ($attribute, $value, $fail) use ($gasoline_station_id, $gasoline_fee_id) {
                        // Add custom validation logic to check if custom type already exists
                        $existingCustomType = GasolineFee::where('type', $value)
                            ->where('gasoline_station_id', $gasoline_station_id)
                            ->where('id', '!=', $gasoline_fee_id) // Exclude the current record
                            ->exists();
    
                        if ($existingCustomType) {
                            $fail('The custom gasoline type already exists.');
                        }
                    },
                ],
                'price' => ['required'],
            ],
        };
    }

    public function messages()
    {
        return [
            'gasoline_station_id.required' => 'The gasoline station field is required.',
            'type.unique' => 'The gasoline type has already been exist',
            'custom_gasoline_type.required_if' => 'The custom gasoline type field is required when the type is "other".',
        ];
    }
}
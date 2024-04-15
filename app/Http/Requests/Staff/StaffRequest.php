<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
        return match ($this->method()) {
            'POST' => [
                'gasoline_station_id' => ['required'],
                'first_name' => ['required'],
                'middle_name' => ['sometimes'],
                'last_name' => ['required'],
                'sex' => ['required'],
                // 'birth_date' => ['required'],
                'address' => ['required'],
                'municipality_id' => ['required'],
                'contact' => ['required','regex:/^\d{11}$/'],
                'email' => ['required', 'email', 'unique:users,email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'],
            ], 
            'PUT' => [
                'gasoline_station_id' => ['required'],
                'first_name' => ['required'],
                'middle_name' => ['sometimes'],
                'last_name' => ['required'],
                'sex' => ['required'],
            // 'birth_date' => ['required'],
                'address' => ['required'],
                'municipality_id' => ['required'],
                'contact' => ['required', 'regex:/^\d{11}$/'],
                'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',\Illuminate\Validation\Rule::unique('users')->ignore($this->staff)],
            ]
        };
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email address has already been taken',
        ];
    }
}
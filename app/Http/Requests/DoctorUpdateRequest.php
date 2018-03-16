<?php

namespace App\Http\Requests;

use App\Models\Doctor;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DoctorUpdateRequest extends FormRequest
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
        $doctor = Doctor::find($this->route('doctor'));

        $this->redirect = route('doctor.edit', ['doctor' => $doctor->id]);

        return [
            'name'      => 'required',
            'specialty' => 'required',
            'registry'  => [
                'required',
                Rule::unique('doctor')->ignore($doctor->id)
            ]
        ];
    }
}

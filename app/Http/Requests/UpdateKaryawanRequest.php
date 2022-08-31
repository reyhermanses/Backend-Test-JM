<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateKaryawanRequest extends FormRequest
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
            //
            'unit_id' => 'required',
            'nik' => 'required|numeric',
            'name' => 'required|string',
            'position_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'unit_id.required' => 'Unit kerja harus di isi.',
            'nik.required' => 'Nik harus di isi',
            'name.required' => 'Nama harus di isi',
            'name.string' => 'Nama harus berupa huruf',
            'position_name.required' => 'Posisi harus di isi',
            'position_name' => 'Posisi yang di isi harus berupa huruf',
            'date_of_birth.required' => 'Tanggal lahir harus di isi',
            // 'date_of_birth.date' => 'Tanggal lahir harus berupa tanggal',
            'palce_of_birth.required' => 'Tempat lahir harus di isi',
            'place_of_birth.string' => 'Tempat lahir harus berupa string'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class NakesProfileRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        // $this->merge([
        //     'tanggallahir' => Carbon::createFromFormat('d/m/Y', $this->tanggallahir)->format('Y-m-d'),
        // ]);
    }

    public function withValidator($validator)
    {
        if($validator->fails()){
            flashError($validator->errors()->first());
            return back();
        }
        // $validator->after(function ($validator) {
            
        // });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'nullable|exists:mpegawai,id',
            'nomorregis' => 'nullable|integer',
            'nik' => 'string',
            'nama' => 'required|string',
            'tempatlahir' => 'nullable|string',
            'tanggallahir' => 'nullable|date',
            'jeniskelamin' => 'required|string',
            'alamatktp' => 'nullable|string',
            'alamat' => 'nullable|string',
            'nohp' => 'nullable|string',
            "provinsi" => 'nullable|string',
            "kabkota" => 'nullable|string',
            "kecamatan" => 'nullable|string',
            "kelurahan" => 'nullable|string',
            "perguruantinggi" => 'nullable|string',
            "tahunlulus" => 'nullable|integer',
            "idprofesi" => 'required_without:id|integer',
            "profesi" => 'string',
            "idspesialisasi" => 'nullable|integer',
            "spesialisasi" => 'string',
            'kodeprofesi' => 'string',
            "foto" => 'file|mimetypes:image/jpeg,image/png|max:512',
        ];
    }
}

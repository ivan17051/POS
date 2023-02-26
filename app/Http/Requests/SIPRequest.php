<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SIPRequest extends FormRequest
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
        //     'nomor' => implode(' / ', $this->nomor),
        // ]);
    }

    public function withValidator($validator)
    {
        if($validator->fails()){
            flashError($validator->errors()->first());
            return back();
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id"=> "nullable|string",
            "idstr" => "required_without:id|integer",
            "jenispermohonan" => "required_without:id|string",
            "instance" => "required_without:id|integer",
            "nomor" => "required_without:id|string",
            "nomorrekom" => "nullable|string",
            "nomoronline" => "nullable|string",
            "tglonline" => "required_without:id|date",
            "tglmasukdinas" => "required_without:id|date",
            "tglverif" => "required_without:id|date",
            "tglsurat" => "required_without:id|date",
            "idfaskes" => "required_without:ismandiri|integer",
            "ismandiri" => "nullable",
            "alamatfaskes" => "nullable",
            "idfaskes" => "nullable|integer",
            "idwilayahpkm" => "nullable|integer",
            "idptmou" => "nullable|integer",
            "nomormou" => "nullable|string",
            "masamou" => "nullable|date",
            "jadwalpraktik" => "nullable|string",
            "jabatan" => "nullable|string",
            "urlfoto" => "nullable|array",
            "captionfoto" => "nullable|array",
        ];
    }
}

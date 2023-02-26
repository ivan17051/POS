<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class STRRequest extends FormRequest
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
            "id"=> "nullable|string",
            "idpegawai"=> "required_without:id|exists:mpegawai,id",
            "nomor"=> "required_without:id|string",
            "since"=> "required_without:id|date",
            "expiry"=> "required_without:id|date",
            "isperpanjangsip"=>"nullable|integer",
            // "tanggal"=> "required_without:id|date",

        ];
    }
}

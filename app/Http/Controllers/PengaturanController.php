<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengaturan;

class PengaturanController extends Controller
{
    public function index(){
        $pengaturan['min_belanja'] = Pengaturan::where('key','min_belanja')->first();
        $pengaturan['gambar_1'] = Pengaturan::where('key','gambar_kasir_1')->first();
        $pengaturan['gambar_2'] = Pengaturan::where('key','gambar_kasir_2')->first();
        $pengaturan['gambar_3'] = Pengaturan::where('key','gambar_kasir_3')->first();
        
        return view('pengaturan', $pengaturan);
    }

    public function store(Request $request){
        
        try{
            $min_belanja = Pengaturan::where('key','min_belanja')->first();
            $min_belanja->value = $request->min_belanja;
            $min_belanja->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Minimal Pembelanjaan Berhasil Diubah');
        return back();
    }

    public function upload(Request $request){
        dd($request->all());
        $gambar = Pengaturan::firstOrNew([
            'id' => $request->idpegawai,
        ]);

        $validator = Validator::make($request->all(), [
            'file'  =>  'required|file|mimetypes:image/jpeg,image/png,application/pdf|max:512'
        ]);
        
        if ($validator->fails()) {
            throw new HttpResponseException(response()->json($validator->errors(), 422));
        }

        $mime = $request->file('file')->getMimeType();
        $pattern = '/[a-zA-Z]+$/' ;
        preg_match($pattern, $mime, $matches);
        $mime = $matches[0];

        $filename = $request->idpegawai.'.'.$mime;
        $path = Storage::putFileAs(
            'photos/',
            $request->file('file'),
            $filename
        );
        
        $url = url('/storage/app/photos/'.$filename);

        $profil->fill(['foto'=>$url]);

        $profil->save();

        $request->session()->forget('no-profil');

        return back()->with('success', 'Data Berhasil Diubah');
    }
}

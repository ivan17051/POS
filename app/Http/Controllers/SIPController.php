<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\SIP;
use App\STR;
use App\Faskes;
use App\BerkasSIP;
use App\Http\Requests\SIPRequest;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Str as FuncStr;
use Exception;
use Illuminate\Support\Facades\Storage;

class SIPController extends Controller
{
    public function show($id_str){
        try {
            $str =  STR::select('str.id','str.idpegawai','str.expiry', 'str.nomor')
                ->with('pegawai:id,nik,nama')
                ->find($id_str);
            $sip = SIP::select('id','idpegawai','nomor', 'namafaskes', 'alamatfaskes', 'since', 'ended')
                ->where('idstr',$id_str)->get();
        } catch (\Throwable $th) {
            return redirect('/');
        }
        return view('sip', ['str'=>$str, 'sip'=>$sip]);
    }

    /*
     * Store SIP
     */
    public function store(SIPRequest $request){
        $userId = Auth::id();
        $input = $request->validated();
        try{
            DB::beginTransaction();
            
            $str = STR::select('id','nomor','expiry','idpegawai','nomorregis','idprofesi','idspesialisasi')->find($input['idstr']);
            
            // Jika Faskes Mandiri
            if(isset($input['ismandiri']) AND $input['ismandiri']=='on'){
                $input['idfaskes'] =NULL;
                $input['saranapraktik'] = 'PRAKTIK MANDIRI';
                $input['namafaskes'] = 'PRAKTIK MANDIRI';
                // $faskes = new Faskes();
                // $faskes->fill([
                //     'alamat' => $request->alamatfaskes,
                //     'nama' => 'PRAKTIK MANDIRI',
                //     'idkategori' => 8,
                // ]);
                // $faskes->save();
            }
            // Jika profesi = dokter intern
            elseif($str->idprofesi==7){
                if($request->idfaskes1 != null){
                    $faskes1 = Faskes::findOrFail($request->idfaskes1);
                }
                if($request->idfaskes2 != null){
                    $faskes2 = Faskes::findOrFail($request->idfaskes2);
                }
                if($request->idfaskes3 != null){
                    $faskes3 = Faskes::findOrFail($request->idfaskes3);
                }
                $idfaskes = $faskes1->id.';'.$faskes2->id.';'.$faskes3->id;
                $namafaskes = $faskes1->nama.';'.$faskes2->nama.';'.$faskes3->nama;
                $alamatfaskes = $faskes1->alamat.';'.$faskes2->alamat.';'.$faskes3->alamat;
                
                $input['idfaskes'] = NULL;
                $input['faskes'] = $idfaskes;
                $input['saranapraktik'] = 'INTERNSHIP';
                $input['namafaskes'] = $namafaskes;
                $input['alamatfaskes'] = $alamatfaskes;
                // dd($input);
            }
            // Jika Faskes sudah ada
            else{
                $faskes = Faskes::where('id',$input['idfaskes'])->with('kategori')->first();
            }
            $latestsip = SIP::where('idstr', $input['idstr'])->where('instance', $input['instance'])
                ->with('profesirelation')->orderBy('iterator', 'DESC')->first();            
            $totalsip = SIP::where('idstr', $input['idstr'])->where('isactive', 1)->count();
            
            // Cegatan jika input SIP lbh dari makssip
            if(isset($latestsip->profesirelation)){
                if($totalsip > $latestsip->profesirelation->makssip){
                    throw new Exception("SIP lebih dari {$latestsip->profesirelation->makssip}");
                }
            }

            // UNTUK CABUT PINDAH
            if(isset($latestsip)){
                $latestsip->isactive = 0;
                $latestsip->tgldeactive = date('Y-m-d');
                $latestsip->idm = $userId;
                $latestsip->save();
            }
            
            $sip = new SIP($input);
            $sip->fill([
                'iterator' => isset($latestsip) ? $latestsip->iterator+1 : 1,
                'idpegawai' => $str['idpegawai'],
                'nomorregis' => sprintf("%04d", $str['nomorregis']),
                'idprofesi' => $str['idprofesi'],
                'idspesialisasi' => $str['idspesialisasi'],
                'nomorstr' => $str['nomor'],
                'expirystr' => $str['expiry'],
                
                'idc'=> $userId,
                'idm'=> $userId,
            ]);

            if((!isset($input['ismandiri']) OR $input['ismandiri']<>"on") AND $str->idprofesi!=7){
                $sip->fill([
                    'saranapraktik' => $faskes->kategori['nama'],
                    'namafaskes' => $faskes['nama'],
                    'alamatfaskes' => $faskes['alamat'],
                ]);
            }
            $sip->save();
            DB::commit();
            $this->flashSuccess('Data Berhasil Ditambahkan');
            return back();
        }catch(Exception $exception){
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }
    }

    /*
     * update SIP
     */
    public function update(SIPRequest $request){
        $userId = Auth::id();
        $input = $request->validated();
        
        try{
            DB::beginTransaction();
            $sip = SIP::find($input['id']);
            if(isset($input['idfaskes'])){
                $faskes = Faskes::where('id',$input['idfaskes'])->with('kategori')->first();
                $sip->fill([
                    'saranapraktik' => $faskes->kategori['nama'],
                    'namafaskes' => $faskes['nama'],
                    'alamatfaskes' => $faskes['alamat'],
                    'idm'=> $userId,
                ]);
            }
            $sip->fill($input);
            
            $sip->save();
            
            DB::commit();
            return response()->json(['message'=>'Berhasil Memperbarui Data'], 200);
        }catch(Exception $exception){
            DB::rollBack();
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try {
            $akun = SIP::findOrFail($id);
            if(!$akun->isactive) throw new Exception("Unauthorized");

            $akun->isactive = 0;
            $akun->tgldeactive = date('Y-m-d');
            $akun->save();
            DB::commit();
            $this->flashSuccess('SIP Berhasil Dicabut');
            return back();
        }catch (Exception $exception) {
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }
    }

    public function uploadFotoPendukung(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file'  =>  'required|file|mimetypes:image/jpeg,image/png|max:512'
        ]);
        
        if ($validator->fails()) {
            throw new HttpResponseException(response()->json($validator->errors(), 422));
        }

        $mime = $request->file('file')->getMimeType();
        $pattern = '/[a-zA-Z]+$/' ;
        preg_match($pattern, $mime, $matches);
        $mime = $matches[0];

        $filename = 'temp_'.FuncStr::random(5).'.'.$mime;
        $path = Storage::putFileAs(
            "fotopendukung/{$request->idpegawai}/",
            $request->file('file'),
            $filename
        );
        
        $url = url("/storage/app/fotopendukung/{$request->idpegawai}/".$filename);

        return response()->json(['message'=>'Berhasil menambah', 'url'=>$url], 200);
    }
}

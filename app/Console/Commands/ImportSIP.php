<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Profesi;
use App\Spesialisasi;
use App\Pegawai;
use App\Faskes;
use App\STR;
use App\SIP;
use App\Kategori;
use Illuminate\Support\Facades\DB;
use Exception;

class ImportSIP extends Command
{
    protected $filepath = 'E:\Ivan\Dinkes\Data Pendukung Aplikasi\SDMK SIP\template-sip.csv';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importsip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fungsi mengimport sip';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $row = 1;
        if (($handle = fopen($this->filepath, "r")) !== FALSE) {
            $headers = fgetcsv($handle, 1000, ';');

            try {
                DB::beginTransaction();
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    $num = count($data);

                    echo "\n$num fields in line $row:\n";

                    $data = array_combine($headers, $data);
    
                    removeNull($data, true);

                    // GET DATA NAKES TERKAIT
                    $nakes = Pegawai::where('kodeprofesi', $data['kodeprofesi'])->where('nomorregis', $data['nomorregis'])->first();
                    if(!isset($nakes)){
                        throw new Exception("Nakes tidak ditemukan");
                    }

                    //GET DATA STR AKTIF
                    $str = STR::where('isactive', 1)->where('idpegawai', $nakes->id)->first();
                    if(!isset($str)){
                        throw new Exception("Nakes belum memiliki STR aktif");
                    }

                    //GET DATA FASKES
                    if(!isset($data['idfaskes'])){
                        $faskes = Faskes::updateOrCreate(
                            [
                                "nama" => $data['namafaskes'],
                                "alamat" => $data['alamatfaskes'],
                                "kelurahan" => $data['kelurahan'],
                                "kecamatan" => $data['kecamatan'],
                            ],
                            [
                                "idkategori" => Kategori::where('nama', $data['kategori'])->first()->id,
                            ]
                        );
                    }else{
                        $faskes = Faskes::where('id', $data['idfaskes'])->with('kategori')->first();
                    }

                    // IMPORT SIP
                    $sip = SIP::updateOrCreate(
                        [
                            "idstr" => $str->id,
                            "idpegawai" => $str->idpegawai,
                            "instance" => $data['instance'],
                        ],
                        array_merge(
                            [
                                "nomorregis" => $str['nomorregis'],
                                "idprofesi" => $str['idprofesi'],
                                "idspesialisasi" => $str['idspesialisasi'],
                                "nomorstr" => $str['nomor'],
                                "expirystr" => $str['expiry'],

                                "idfaskes" => $faskes['id'],
                                "saranapraktik" => $faskes->kategori->nama,
                                "namafaskes" => $faskes['nama'],
                                "alamatfaskes" => $faskes['alamat'],

                                "iterator" => 1,
                                "idc" => 1,
                                "idm" => 1,
                            ],
                            $data
                        )
                    );
    
                    $row++;
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                echo $e->getMessage();
            }
            
            fclose($handle);
        }
    }
}

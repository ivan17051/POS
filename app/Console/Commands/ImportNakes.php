<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Profesi;
use App\Spesialisasi;
use App\Pegawai;
use App\STR;
use Illuminate\Support\Facades\DB;
use Exception;

class ImportNakes extends Command
{
    protected $filepath = 'E:\Ivan\Dinkes\Data Pendukung Aplikasi\SDMK SIP\template-nakes-str.csv';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importnakes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fungsi mengimport nakes';

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
        $profesis = Profesi::all()->keyBy('kode');

        $row = 1;
        if (($handle = fopen($this->filepath, "r")) !== FALSE) {
            $headers = fgetcsv($handle, 1000, ';');

            try {
                DB::beginTransaction();
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    $num = count($data);

                    echo "\n$num fields in line $row:\n";

                    $data = array_combine($headers, $data);
    
                    $profesi = $profesis[$data['kodeprofesi']];
    
                    removeNull($data, true);

                    if(isset($data['idspesialisasi'])){
                        $data['spesialisasi'] = Spesialisasi::find($data['idspesialisasi'])->nama;
                    }

                    // IMPORT NAKES
                    $nakes = Pegawai::updateOrCreate(
                        [
                            "nomorregis" => $data['nomorregis'],
                            "idprofesi" => $profesi['id'],
                        ],
                        array_merge(
                            [
                                "kodeprofesi" => $profesi['kode'],
                                "profesi" => $profesi['nama'],
                                "idc" => 1,
                                "idm" => 1,
                            ],
                            $data
                        )
                    );

                    // IMPORT STR
                    $str = STR::updateOrCreate(
                        [
                            "idpegawai" => $nakes->id,
                            "isactive" => 1,
                        ],
                        array_merge(
                            [
                                "nomorregis" => $nakes['nomorregis'],
                                "idprofesi" => $nakes['idprofesi'],
                                "idspesialisasi" => $nakes['idspesialisasi'],
                                "nomor" => $data['nomorstr'],
                                "since" => $data['tglmulai'],
                                "expiry" => $data['tglberakhir'],
                                "idc" => 1,
                                "idm" => 1,
                                "isactive" => 1,
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

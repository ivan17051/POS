<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\STR;
use App\Pegawai;
use Illuminate\Support\Facades\DB;
use Datatables;
use Auth;
use App\BarangMasuk;
use App\BarangKeluar;

class DashboardController extends Controller
{
    public function index(){
        $jum['brg_msk'] = BarangMasuk::count();
        $jum['brg_kel'] = BarangKeluar::count();
        
        return view('dashboard', $jum);
    }
}

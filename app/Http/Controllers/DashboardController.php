<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\STR;
use App\Pegawai;
use Illuminate\Support\Facades\DB;
use Datatables;
use Auth;

class DashboardController extends Controller
{
    public function awal(){
        $role = Auth::user()->role;
        if($role=='Bidang') return redirect('data/laporan');
        elseif($role=='Saralkes') return redirect('faskes');
        else return redirect('bio');
    }
    
    public function index(){
        $d['stats'] = DB::table('vw_agregatnakesbystatussip')->get()->keyBy('status');
        return view('dashboard', $d);
    }
}

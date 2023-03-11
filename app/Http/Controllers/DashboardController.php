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
    public function index(){
        return view('dashboard');
    }
}

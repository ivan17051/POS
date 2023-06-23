<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Kategori;
use Exception;
use Datatables;

class BarangController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('master.barang', ['kategori' => $kategori]);
    }

    public function data()
    {
        // Lebih cepet pake raw() src: https://geekflare.com/laravel-optimization/
        // $data = Barang::raw('SELECT * FROM mbarang A JOIN mkategori B ON A.idkategori = B.id');
        $data = Barang::with('getKategori');
        $datatable = Datatables::of($data);
        $datatable->rawColumns(['action']);

        $datatable->addColumn('action', function ($t) {
            return '<a href="" class="btn btn-info btn-link" style="padding:5px;" target="_blank" rel="noreferrer noopener"><i class="material-icons">launch</i></a>&nbsp' .
                '<button type="button" class="btn btn-warning btn-link" style="padding:5px;" onclick="edit(this)"><i class="material-icons">edit</i></button>&nbsp' .
                '<button type="button" class="btn btn-danger btn-link" style="padding:5px;" onclick="hapus(this)"><i class="material-icons">close</i></button>';
        });

        return $datatable->make(true);
    }

    public function checkKode($kode)
    {
        $data = Barang::where('kodebarang', $kode)->count();
        return $data;
    }

    public function store(Request $request)
    {
        try {
            $barang_baru = new Barang($request->all());
            isset($request->istitipan) ? $barang_baru->istitipan = 1 : $barang_baru->istitipan = 0;
            $barang_baru->save();
        } catch (Exception $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Barang Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id)
    {
        try {
            $barang = Barang::findOrFail($id);
            $barang->fill($request->all());
            isset($request->istitipan) ? $barang->istitipan = 1 : $barang->istitipan = 0;
            $barang->save();
        } catch (Exception $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Barang Berhasil Diubah');
        return back();
    }

    public function destroy(Request $request, $id)
    {
        try {
            $barang = Barang::findOrFail($id);
            $barang->delete();
        } catch (Exception $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Barang Berhasil Dihapus');
        return back();
    }
}
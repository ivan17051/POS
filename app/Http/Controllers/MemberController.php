<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;

class MemberController extends Controller
{
    public function index(){
        $member = Member::all();
        return view('master.member', ['member'=>$member]);
    }

    public function store(Request $request){
        try{
            $member_baru = new Member($request->all());
            $member_baru->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Member Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        try{
            $member = Member::findOrFail($id);
            $member->fill($request->all());
            $member->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Member Berhasil Diubah');
        return back();
    }

    public function destroy(Request $request, $id){
        try {
            $member = Member::findOrFail($id);
            $member->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Member Berhasil Dihapus');
        return back();
    }
}

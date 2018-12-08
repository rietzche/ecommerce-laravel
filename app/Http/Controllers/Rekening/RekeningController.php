<?php

namespace App\Http\Controllers\Rekening;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Controllers\RekeningService;
use Alert;

class RekeningController extends BaseController
{
    public function __construct()
    {
        $this->rekening = new RekeningService;
    }

    public function index()
    {
        $rekenings = $this->rekening->browse();
        return view('views_admin.rekening_tabel')->with('rekenings', $rekenings);
    }

    public function create(Request $req)
    {
        $this->rekening->create([
            'nama_bank'=> $req->nama_bank,
	        'nama_rekening'=> $req->nama_rekening,
	        'cabang'=> $req->cabang,
	        'no_rekening'=> $req->no_rekening,
        ]);
        Alert::success('Menambahkan Rekening baru!', 'Berhasil');
        return redirect()->back();
    }

    public function update(Request $req, $id)
    {
        $rekening = $this->rekening->find($id);
        $rekening->update([
            'nama_bank'=> $req->nama_bank,
	        'nama_rekening'=> $req->nama_rekening,
	        'cabang'=> $req->cabang,
	        'no_rekening'=> $req->no_rekening,
        ]);
     
        Alert::success('Merubah rekening!', 'Berhasil');
        return redirect()->back();
    }

    public function delete($id)
    {
        $rekening = $this->rekening->find($id);
        $rekening->delete();
        Alert::success('Menghapus '.$rekening->name.' dari daftar!', 'Berhasil');
        return redirect()->back();
    }
}

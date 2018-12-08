<?php

namespace App\Http\Controllers\Pesanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Controllers\PesananService;
use App\Http\Controllers\TransactionService;
use Alert;
use PDF;
use App\Order;

class PesananController extends BaseController
{
    public function __construct()
    {
        $this->pesanan = new PesananService;
        $this->transaction = new TransactionService;
    }
    
    public function cancelPesanan($code)
    {
        $pesanan = $this->pesanan->where('code',$code);
        $pesanan->update([
            'status'=> -1,
        ]);
     
        Alert::success('Merubah status!', 'Berhasil');
        return redirect()->back();
    }

    public function tolakBukti($code)
    {
        $pesanan = $this->pesanan->where('code',$code);
        $pesanan->update([
            'status'=> 2,
        ]);
        $transaction = $this->transaction->where('order_code', $code);
        $transaction->delete();
     
        Alert::success('Merubah status!', 'Berhasil');
        return redirect()->back();
    }

    public function verifBukti($code)
    {
        $pesanan = $this->pesanan->where('code',$code);
        $pesanan->update([
            'status'=> 3,
        ]);
     
        Alert::success('Merubah status!', 'Berhasil');
        return redirect()->back();
    }

    public function dikirimPesanan($code)
    {
        $pesanan = $this->pesanan->where('code',$code);
        $pesanan->update([
            'status'=> 4,
        ]);

        Alert::success('Merubah status!', 'Berhasil');
        return redirect()->back();
    }

    public function terkirimPesanan($code)
    {
        $pesanan = $this->pesanan->where('code',$code);
        $pesanan->update([
            'status'=> 5,
        ]);
     
        Alert::success('Merubah status!', 'Berhasil');
        return redirect()->back();
    }


    public function invoicePesanan($code) 
    {
        // $data = Order::where('code', $code)->get();
        // def("DOMPDF_ENABLE_REMOTE", false);
        $pdf = PDF::loadView('report.invoice', compact('code'));
        $pdf->setPaper('A5', 'portrait');
        return $pdf->download('invoice-pesanan(order-code'.$code.').'.'pdf');
    }

}

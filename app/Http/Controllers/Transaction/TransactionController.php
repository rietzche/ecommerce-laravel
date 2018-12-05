<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller as BaseController;

use Illuminate\Http\Request;

use App\Http\Controllers\TransactionService;

use App\Http\Controllers\OrderService;

class TransactionController extends BaseController
{
    public function __construct()
    {
        $this->transaction = new TransactionService;
        $this->order = new OrderService;
    }

    public function index($code)
    {
        $orders = $this->order->code($code);
        
        return view('transaction.index')->with('orders', $orders)
                                        ->with('code', $code);
    }

    public function create(Request $req, $code)
    {
        $orders = $this->order->code($code);
        $status = 1;
        $this->transaction->create([
            'code_order' => $code,
            'id_user' => Auth::user()->id,
            'proof' => $req->file('proof'),
            'sender_name' => $req->sender_name,
            'bank_from' => $req->bank_from,
            'bank_for' => App\Rekening::find($orders->first()->bank)->nama_bank,
            'method' => $req->method,
            'price_total' => sum($orders->price_total),
            'transfer_date' => $req->transfer_date,
        ]);
        foreach($this->order->code($req->code) as $order){
            $this->order->update([
                'status' => $status,
            ]);
        }

        Alert::success('Melakukan transaksi pesanan, terimakasih telah belanja :)', 'Berhasil');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller as BaseController;

use Illuminate\Http\Request;

use App\Http\Controllers\TransactionService;

use App\Http\Controllers\OrderService;

use Alert;

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
        
        if($orders->first()->status == 0 || $orders->first()->status == 2)
        {
            return view('transaction.index')->with('orders', $orders)
                                        ->with('code', $code);
        }
        else
        {
            Alert::error('Something went wrong!', 'Ummmmm.. :(');
            return view('home');
        }
    }

    public function create(Request $req, $code)
    {
        $orders = $this->order->code($code);
            $status = 1;
            $file = $req->file('proof');
            $ext  = $file->getClientOriginalExtension();
            $newName = rand(100000,1001238912).".".$ext;
            $file->move('uploads/bukti_pembayaran',$newName);

            $this->transaction->create([
                'order_code' => $code,
                'id_user' => Auth::user()->id,
                'proof' => $newName,
                'sender_name' => $req->sender_name,
                'bank_from' => $req->bank_from,
                'bank_for' => \App\Rekening::find($orders->first()->bank)->nama_bank,
                'method' => $req->method,
                'price_total' => $orders->sum('price_total'),
                'transfer_date' => $req->transfer_date,
            ]);
            foreach($this->order->code($req->code)->get() as $order){
                $order->update([
                    'status' => $status,
                ]);
            }

            Alert::success('Melakukan transaksi pesanan, terimakasih telah belanja :)', 'Berhasil');
            return redirect('/belanjaanku');
        
    }
}

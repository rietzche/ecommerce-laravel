<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Http\Controllers\CartService;
use App\Http\Controllers\AddressService;
use App\Http\Controllers\OrderService;

use Alert;
use App\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->cart = new CartService;
        $this->address = new AddressService;
        $this->order = new OrderService;
    }
    
    public function index()
    {
        $carts = $this->cart->where(Auth::user()->id)->get();
        $addresses = $this->address->where(Auth::user()->id);
        $rekening = \App\Rekening::all();
        return view('order.index')->with('carts', $carts)
                                ->with('addresses', $addresses)
                                ->with('resp', '')
                                ->with('banks', $rekening);
    }

    public function create(Request $req)
    {
        $carts = $this->cart->where(Auth::user()->id)->get();
        $code = rand(213908, 837129);

        foreach($carts as $cart)
        {
            Order::create([
                'code' => $code,
                'id_user' => $cart->id_user,
                'id_product' => $cart->id_product,
                'id_address' => $req->address,
                'bank' => $req->bank,
                'courier' => $req->courier,
                'msg' => $req->msg,
                'quantity' => $cart->quantity,
                'status' => 0,
                'price_total' => $cart->quantity * \App\Product::find($cart->id_product)->price,
            ]);
        }
        $this->cart->where(Auth::user()->id)->delete();

        return redirect('/pembayaran/'.$code);
    }

    public function pembayaran($code)
    {
        $order = $this->order->code($code)->get();

        if($order->first()->status == 0)
        {
            if(count($order) != 0)
            {
                return view('order.pembayaran')->with('order', $order)
                                                ->with('code', $code);
            }
            else
            {
                Alert::error('Something gonna bad!', 'Ummm... :(');
                return view('order.pembayaran')->with('order', $order);
            }
        }
        else
        {
            Alert::error('Something went wrong!', 'Ummmmm.. :(');
            return view('home');
        }
    }
}

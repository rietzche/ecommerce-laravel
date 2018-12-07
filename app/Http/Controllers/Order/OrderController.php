<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Http\Controllers\CartService;
use App\Http\Controllers\AddressService;
use App\Http\Controllers\OrderService;

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
        return view('order.index')->with('carts', $carts)
                                ->with('addresses', $addresses)
                                ->with('resp', '');
    }

    public function create(Request $req)
    {
        $carts = $this->cart->where(Auth::user()->id);
        
        foreach($carts as $cart)
        {
            $this->order->create([
                'code' => rand(213908, 837129),
                'id_user' => $cart->id_user,
                'id_product' => $cart->id_product,
                'id_address' => $req->address,
                'bank' => $req->bank,
                'quantity' => $cart->quantity,
                'status' => 0,
                'price_total' => $cart->quantity * App\Product::find($cart->id_product)->price,
            ]);
            $this->cart->where(Auth::user()->id)->delete();

            return redirect('/pembayaran');
        }
    }

    public function pembayaran()
    {
        return view('order.pembayaran');
    }
}

<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Http\Controllers\CartService;
use App\Http\Controllers\AddressService;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->cart = new CartService;
        $this->address = new AddressService;
    }
    
    public function index()
    {
        $carts = $this->cart->where(Auth::user()->id);
        $addresses = $this->address->where(Auth::user()->id);
        return view('order.index')->with('carts', $carts)
                                ->with('addresses', $addresses);
    }

    public function pembayaran()
    {
        return view('order.pembayaran');
    }
}

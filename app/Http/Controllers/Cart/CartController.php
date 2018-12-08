<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller as BaseController;

use App\Http\Controllers\CartService;

use Alert;
use Illuminate\Support\Facades\Session;

use App\Cart;

use Illuminate\Http\Request;

class CartController extends BaseController
{
    public function __construct()
    {
        $this->cart = new CartService;
    }

    public function index()
    {
        $carts = $this->cart->browse()->where('id_user', Auth::user()->id);
        return view('cart.index')->with('carts', $carts);
    }

    public function create(Request $req)
    {
        $products = Cart::select('id_product')->where('id_user', Auth::user()->id)->get();
        $condition = true;

        foreach($products as $product)
        {
            if($req->product == $product->id_product)
            {
                $condition = false;
            }
        }

        if( $condition == true )
        {
            $this->cart->create([
                'id_product' => $req->product,
                'id_user' => Auth::user()->id,
                'quantity' => $req->quantity,
            ]);
    
            Session::flash('success', 'Menambahkan ke keranjang!');
            return redirect()->back()->with('success', 'Menambahkan ke keranjang!');
        }
        elseif( $condition == false )
        {
            alert()->warning('Barang sudah ada di keranjang!', 'Warning');
            $condition = true;
            return redirect()->back();
        }
    }

    public function buyNow(Request $req)
    {
        $products = Cart::select('id_product')->where('id_user', Auth::user()->id)->get();
        $condition = true;

        foreach($products as $product)
        {
            if($req->product == $product->id_product)
            {
                $condition = false;
            }
        }

        if( $condition == true )
        {
            $this->cart->create([
                'id_product' => $req->product,
                'id_user' => Auth::user()->id,
                'quantity' => $req->quantity,
            ]);
    
            alert()->success('Menambahkan ke keranjang!', 'Berhasil');
            return redirect('carts');
        }
        elseif( $condition == false )
        {
            alert()->warning('Barang sudah ada di keranjang!', 'Warning');
            $condition = true;
            return redirect()->back();
        }
    }

    public function update(Request $req)
    {
        $jum = $req->jum;

        foreach($jum as $key => $q)
        {
            $cart = $this->cart->find($key);
            $cart->update([
                'quantity' => $q,
            ]);
        }

        return redirect('/checkout');
    }

    public function delete($id)
    {
        $cart = $this->cart->find($id);
        $cart->delete();

        Alert::success('Menghapus barang dari keranjang!', 'Berhasil');
        return redirect('carts');
    }
}

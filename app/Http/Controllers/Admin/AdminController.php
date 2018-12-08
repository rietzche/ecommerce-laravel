<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Alert;
use App\Order;
use App\Rating;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $orders = Order::select('code', DB::raw('count(*) as product_count'))
            ->groupBy('code')->get();

        return view('views_admin.dashboard')
        ->with('orders', $orders);
    }

    public function order($status)
    {
        if ($status=='pending') {
            $orders = Order::select('code', DB::raw('count(*) as product_count'))
                    ->where('status' , 0)
                    ->groupBy('code')->get();
        }
        else if ($status=='terbaru') {
            $orders = Order::select('code', DB::raw('count(*) as product_count'))
                    ->where('status' , 1)
                    ->orWhere('status', 2)
                    ->orWhere('status', 3)
                    ->groupBy('code')->get();
        }else if($status=='dikirim'){
            $orders = Order::select('code', DB::raw('count(*) as product_count'))
                    ->where('status' , 4)
                    ->groupBy('code')->get();
        }else if($status=='terkirim'){
            $orders = Order::select('code', DB::raw('count(*) as product_count'))
                    ->where('status' , 5)
                    ->groupBy('code')->get();
        }else if($status=='dibatalkan'){
            $orders = Order::select('code', DB::raw('count(*) as product_count'))
                    ->where('status' ,-1)
                    ->groupBy('code')->get();
        }

        return view('views_admin.pesanan_tabel')->with('orders', $orders);
    }
   
    public function penilaian()
    {

        $ratings = Rating::all();

        return view('views_admin.penilaian_tabel')
        ->with('ratings', $ratings);

    }

    public function pelanggan()
    {

        $members = User::all();

        return view('views_admin.pelanggan_tabel')
        ->with('members', $members);

    }
    
    public function deletePelanggan($id)
    {
        User::find($id)->delete();

        Alert::success('Menghapus '.$category->name.' dari daftar!', 'Berhasil');
        return redirect()->back();
    }

    
    public function penjualan() 
    {       
        $orders = Order::select('id_product', DB::raw('count(*) as product_count'))
            ->groupBy('id_product')->get();

        return view('views_admin.penjualan_tabel')
        ->with('orders', $orders);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Order;

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
        return view('views_admin.dashboard');
    }

    public function order()
    {
        $orders = Order::select('code', DB::raw('count(*) as product_count'))
                    ->where('status' , 1)
                    ->groupBy('code')->get();

        return view('views_admin.pesanan_tabel')->with('orders', $orders);
    }
}

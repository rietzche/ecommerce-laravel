<?php

namespace App\Http\Controllers\Belanjaan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;

use App\Http\Controllers\OrderService;

class BelanjaanController extends BaseController
{
    public function __construct()
    {
        $this->order = new OrderService;
    }

    public function index()
    {
        $orders = \App\Order::select('code', DB::raw('count(*) as product_count'))
                    ->where([['id_user', Auth::user()->id],['status' , 0]])
                    ->groupBy('code')->get();
        $orderx = \App\Order::select('code', DB::raw('count(*) as product_count'))
                    ->where([['id_user', Auth::user()->id],['status' , 1]])
                    ->groupBy('code')->get();

        return view('belanjaan')->with('orders', $orders)
                                ->with('orderx', $orderx);
    }
}

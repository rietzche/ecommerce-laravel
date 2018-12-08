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
                    ->orWhere([['id_user', Auth::user()->id],['status' , 2]])
                    ->groupBy('code')->get();
        $orderx = \App\Order::select('code', DB::raw('count(*) as product_count'))
                    ->where([['id_user', Auth::user()->id],['status' , 1]])
                    ->orWhere([['id_user', Auth::user()->id],['status' , 3]])
                    ->groupBy('code')->get();

        $orderD = \App\Order::select('code', DB::raw('count(*) as product_count'))
                    ->where([['id_user', Auth::user()->id],['status' , 4]])
                    ->groupBy('code')->get();
        $orderT = \App\Order::select('code', DB::raw('count(*) as product_count'))
                    ->where([['id_user', Auth::user()->id],['status' , 5]])
                    ->groupBy('code')->get();

        $orderCancel = \App\Order::select('code', DB::raw('count(*) as product_count'))
                    ->where([['id_user', Auth::user()->id],['status' , -1]])
                    ->groupBy('code')->get();

        return view('belanjaan')->with('orders', $orders)
                                ->with('orderx', $orderx)
                                ->with('orderD', $orderD)
                                ->with('orderT', $orderT)
                                ->with('orderCancel', $orderCancel);
    }
}

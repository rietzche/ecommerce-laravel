<?php

namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;

class OrderService extends Controller
{
    public function newOrder()
    {
        return new Order;
    }

    public function browse()
    {
        return $this->newOrder()->all();
    }

    public function where($key, $req)
    {
        return $this->newOrder()->where($key, $req);
    }

    public function find($id)
    {
        return $this->newOrder()->find($id);
    }

    public function create($req)
    {
        return $this->newOrder()->create($req);
    }

    public function update($id, $req)
    {
        return $this->find($id)->update($req);
    }

    public function code($req)
    {
        return $this->newOrder()->where('code', $req);
    }
}

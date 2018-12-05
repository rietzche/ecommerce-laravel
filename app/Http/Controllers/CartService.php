<?php

namespace App\Http\Controllers;
use App\Cart;
use Illuminate\Http\Request;

class CartService extends Controller
{
    public function newCart()
    {
        return new Cart;
    }

    public function browse()
    {
        return $this->newCart()->all();
    }

    public function where($id)
    {
        return $this->newCart()->where('id_user', $id);
    }

    public function find($id)
    {
        return $this->newCart()->find($id);
    }

    public function create($req)
    {
        return $this->newCart()->create($req);
    }

    public function update($id, $req)
    {
        return $this->find($id)->update($req);
    }
}

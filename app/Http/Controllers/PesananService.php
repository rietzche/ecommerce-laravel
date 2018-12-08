<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class PesananService extends Controller
{
    public function newPesanan()
    {
        return new Order;
    }

    public function browse()
    {
        return $this->newPesanan()->all();
    }

    public function where($key, $req)
    {
        return $this->newPesanan()->where($key, $req);
    }

    public function find($id)
    {
        return $this->newPesanan()->find($id);
    }

    public function create($req)
    {
        return $this->newPesanan()->create($req);
    }

    public function update($id, $req)
    {
        return $this->find($id)->update($req);
    }

    public function code($req)
    {
        return $this->newPesanan()->where('code', $req);
    }
}

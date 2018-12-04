<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;

class AddressService extends Controller
{
    public function newAddress()
    {
        return new Address;
    }

    public function browse()
    {
        return $this->newAddress()->all();
    }

    public function where($id)
    {
        return $this->newAddress()->where('id_user', $id)->get();
    }

    public function find($id)
    {
        return $this->newAddress()->find($id);
    }

    public function create($req)
    {
        return $this->newAddress()->create($req);
    }

    public function update($id, $req)
    {
        return $this->find($id)->update($req);
    }
}

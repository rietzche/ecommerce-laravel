<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekening;

class RekeningService extends Controller
{
    public function newRekening()
    {
        return new Rekening;
    }

    public function browse()
    {
        return $this->newRekening()->all();
    }

    public function find($id)
    {
        return $this->newRekening()->find($id);
    }

    public function create($req)
    {
        return $this->newRekening()->create($req);
    }

    public function update($id, $req)
    {
        return $this->find($id)->update($req);
    }
}

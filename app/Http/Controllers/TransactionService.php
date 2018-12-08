<?php

namespace App\Http\Controllers;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionService extends Controller
{
    public function newTransaction()
    {
        return new Transaction;
    }

    public function browse()
    {
        return $this->newTransaction()->all();
    }

    public function find($id)
    {
        return $this->newTransaction()->find($id);
    }
    
    public function where($key, $req)
    {
        return $this->newTransaction()->where($key, $req);
    }

    public function create($req)
    {
        return $this->newTransaction()->create($req);
    }
}

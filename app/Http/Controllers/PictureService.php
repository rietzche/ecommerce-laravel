<?php

namespace App\Http\Controllers;
use App\Picture;
use Illuminate\Http\Request;

class PictureService extends Controller
{
    public function newPicture()
    {
        return new Picture;
    }

    public function find($id)
    {
        return $this->newPicture()->find($id);
    }

    public function create($req)
    {
        return $this->newPicture()->create($req);
    }

    public function where($id)
    {
        return $this->newPicture()->where('id_product', $id)->first(); //find($id)->update($req);
    }

    public function whereAll($id)
    {
        return $this->newPicture()->where('id_product', $id); //find($id)->update($req);
    }
}

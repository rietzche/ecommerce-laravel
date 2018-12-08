<?php

namespace App\Http\Controllers\Product;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller as BaseController;

use App\Http\Controllers\RatingService;

use Illuminate\Http\Request;

class RatingController extends BaseController
{
    public function __construct()
    {
        $this->rating = new RatingService;
    }

    public function create(Request $req)
    {
        $rt = $req->rating;
        foreach ($rt as $r) {
            if ($r!=0) {
                $this->rating->create([
                    'id_product' => $req->id_product,
                    'id_user' => Auth::user()->id,
                    'rate' => $r,
                    'review' => $req->review,
                ]);
            }
        }    
        return redirect()->back();
    }

    public function update(Request $req, $id)
    {
        $rt = $req->rating;
        foreach ($rt as $r) {
            if ($r!=0) {
                $rating = $this->rating->find($id);
                $rating->update([
                    'id_product' => $req->id_product,
                    'id_user' => Auth::user()->id,
                    'rate' => $r,
                    'review' => $req->review,
                ]);
            }
        }    
        return redirect()->back();
    }

    public function delete($id)
    {
        $rating = $this->rating->find($id);
        $rating->delete();

        return redirect()->back();
    }
}

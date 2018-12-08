<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Alert;
use App\User;

class UserController extends Controller
{
    public function update(Request $req, $id) {
    	$user = User::find($id);
    	$user->name   = $req->name;
    	$user->no_tlp = $req->no_tlp;
    	$user->email  = $req->email;
        if ($req->password!='') {
            $user->password = Hash::make($req->password);
        }
        $user->save();

		Alert::success('Memperbarui data profile!', 'Berhasil');
        return redirect()->back();
    }
}

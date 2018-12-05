<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller as BaseController;

use App\Http\Controllers\ProductService;

use App\Http\Controllers\PictureService;

use App\Http\Controllers\StockService;

use App\Http\Controllers\OrderService;

use App\Http\Controllers\CategoryService;

use Illuminate\Http\Request;

use Alert;

class ProductController extends BaseController
{
    public function __construct()
    {
        $this->product = new ProductService;
        $this->picture = new PictureService;
        $this->stock   = new StockService;
        $this->order   = new OrderService;
        $this->category   = new CategoryService;
    }

    public function index()
    {
        $products = $this->product->browse();
        $categories = $this->category->browse();
        return view('product.index')->with('products', $products)
                                    ->with('categories', $categories);
    }

    public function indexadmin()
    {
        $products = $this->product->browse();
        return view('views_admin.barang_tabel')->with('products', $products);
    }

    // public function latest()
    // {
    //     $products = $this->product->browse()->orderBy('created_at', 'asc');
    //     return view('product.index')->with('products', $products);
    // }

    // public function bestSelling()
    // {
    //     $products = [];
    //     $orders = $this->order->select('id_product', DB::raw('count(*) as total'))
    //                 ->groupBy('id_product')
    //                 ->orderBy('id_product', 'desc')
    //                 ->get();
    //     foreach($orders as $order){
    //         array_push($this->product->find($order->id_product));
    //     }

    //     return view('product.index')->with('products', $products);
    // }

    public function detail($id)
    {
        $product = $this->product->find($id);
        return view('product.detail')->with('product', $product);
    }

    public function new()
    {
        $categories = $this->category->browse();
        return view('views_admin.barang_tambah')->with('categories', $categories);
    }

    public function create(Request $req)
    {
        $pict = $req->pictures;
        $product = $this->product->create([
            'name' => $req->name,
            'id_category' => $req->category,
            'description' => $req->description,
            'price' => $req->price,
        ]);

        $files = $req->file('pictures');

        foreach ($files as $file) {
            $ext  = $file->getClientOriginalExtension();
            $newName = rand(100000,1001238912).".".$ext;
            $file->move('uploads/foto-produk',$newName);
            
            $this->picture->create([
                'id_product'=> $product->id,
                'picture' => $newName,
            ]);
        }

        $this->stock->create([
            'id_product' => $product->id,
            'stock' => $req->stock,
        ]);

        Alert::success('Menambahkan '.$product->name.' pada daftar', 'Berhasil');
        return redirect()->back();
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $categories = $this->category->browse();

        return view('views_admin.barang_edit')
        ->with('categories', $categories)
        ->with('product', $product);
    }

    public function update(Request $req, $id)
    {
        $product = $this->product->find($id);
        $product->update([
            'name' => $req->name,
            'id_category' => $req->category,
            'description' => $req->description,
            'price' => $req->price,
        ]);

        $this->stock->where($product->id)->update([
            'stock' => $req->stock,
        ]);

        $files = $req->file('pictures');
        if ($files) {
            $this->picture->whereAll($product->id)->delete();
            foreach ($files as $file) {
                $ext  = $file->getClientOriginalExtension();
                $newName = rand(100000,1001238912).".".$ext;
                $file->move('uploads/foto-produk',$newName);
                
                $this->picture->create([
                    'id_product'=> $product->id,
                    'picture' => $newName,
                ]);
            }   # code...
        }

        Alert::success('Merubah '.$product->name.'!', 'Berhasil');
        return redirect()->back();
    }

    public function delete($id)
    {
        $product = $this->product->find($id);
        $product->delete();
        Alert::success('Menghapus '.$product->name.' dari daftar!', 'Berhasil');
        return redirect()->back();
    }
}

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

        $file = $req->file('pictures');
        $ext  = $file->getClientOriginalExtension();
        $newName = rand(100000,1001238912).".".$ext;
        $file->move('uploads/foto-produk',$newName);

        $this->picture->create([
            'id_product' => $product->id,
            'picture' => $newName, //base64_encode(file_get_contents($p)),

        ]);

        // if (is_array($pict) || is_object($pict))
        // {
        //     foreach ($pict as $p)
        //     {
        //         $this->picture->create([
        //             'id_product' => $product->id,
        //             'picture' => $newName, //base64_encode(file_get_contents($p)),

        //         ]);
        //     }
        // }
        // else
        // {
        //     $this->picture->create([
        //         'id_product' => $product->id,
                
        //         'picture' => $newName, //base64_encode(file_get_contents($pict)),

        //     ]);
        // }

        $this->stock->create([
            'id_product' => $product->id,
            'stock' => $req->stock,
        ]);

        Alert::success('Menambahkan '.$product->name.' pada daftar', 'Berhasil');
        return redirect()->back();
    }

    public function edit()
    {
        $product = $this->product->find($id);
        return view('product.edit', $product);
    }

    public function update(Request $req, $id)
{
        $file = $req->file('pictures');
        $ext  = $file->getClientOriginalExtension();
        $newName = rand(100000,1001238912).".".$ext;
        $file->move('uploads/foto-produk',$newName);

        $product = $this->product->find($id);
        $product->update([
            'name' => $req->name,
            'id_category' => $req->category,
            
            // 'pictures' => $picts,

            'picture' => $newName, //base64_encode(file_get_contents($p)),
        
            'description' => $req->description,
            'price' => $req->price,
        ]);

        return redirect('products');
    }

    public function delete($id)
    {
        $product = $this->product->find($id);
        $product->delete();
        Alert::success('Menghapus '.$product->name.' dari daftar!', 'Berhasil');
        return redirect()->back();
    }
}

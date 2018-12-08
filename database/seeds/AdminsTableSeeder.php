<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Admin::insert([
          [
            'name'		  => 'Febri Ardi Saputra',
            'email'		  => 'febri@gmail.com',
            'password'    => bcrypt('febri1234'),
            'created_at'  => \Carbon\Carbon::now('Asia/Jakarta'),
            'updated_at'  => \Carbon\Carbon::now('Asia/Jakarta')
          ],
          ]);
          
        App\Category::insert([
            [
                'name'    => 'Organizer',
            ],
        ]);

        App\Product::insert([
            [
                'name'        => 'Lemari Baju',
                'description' => 'Lemari ini merupakan lemari terunik yang ada di toko ini.',
                'id_category' => 1,
                'price'       => 283000,
                'weight'      => 500,
            ],
        ]);

        App\Stock::insert([
            [
                'id_product' => 1,
                'stock'      => 200,
            ],
        ]);

        App\Picture::insert([
            [
                'id_product' => 1,
                'picture'    => 'thumbnail.png',
            ],
        ]);

        App\Rekening::insert([
            [
                'nama_bank' => 'Bank BCA',
                'nama_rekening' => 'Shabby Organizer',
                'cabang'        => 'Tangerang',
                'no_rekening'   => '0068649676100',
            ],
        ]);
    }
}

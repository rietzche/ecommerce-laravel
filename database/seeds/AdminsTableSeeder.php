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
            'no_rekening' => '4213102392312',
            'email'		  => 'febri@gmail.com',
            'password'    => bcrypt('febri1234'),
            'created_at'  => \Carbon\Carbon::now('Asia/Jakarta'),
            'updated_at'  => \Carbon\Carbon::now('Asia/Jakarta')
          ],
      	]);
    }
}

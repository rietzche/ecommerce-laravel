<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    public function cekCity(Request $req)
    {
        $kab_id = 284;

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/city?id=".$kab_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 5b3064c12abedc8e773ee938e0aa11a0"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        //echo $response;
        }

        $data = json_decode($response, true);
        
        return $data;
    }

    public function cekKabupaten(Request $req)
    {
        $provinsi_id = $req->prov_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$provinsi_id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 5b3064c12abedc8e773ee938e0aa11a0"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        //echo $response;
        }

        $data = json_decode($response, true);
        for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
            echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
        }
    }

    public function cekOngkir(Request $req)
    {
        $respon = [];
        $services = [
            'jne', 'tiki', 'pos',
        ];

        $alamat = $req->kab_id;
        $weight = $req->berat;

        foreach($services as $serv)
        {
            $asal = 1;
            $id_kabupaten = $alamat;
            $kurir = $serv;
            $berat = $weight;

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$id_kabupaten."&weight=".$berat."&courier=".$kurir."",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key:  5b3064c12abedc8e773ee938e0aa11a0 "
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $data = json_decode($response, true);
            }

            foreach($data['rajaongkir']['results'][0]['costs'] as $dat)
            {
                array_push($respon, [
                    'service' => strtoupper($serv).' '.$dat['service'],
                    'etd' =>  $dat['cost'][0]['etd'],
                    'cost' => number_format($dat['cost'][0]['value'], 0, ",", ".")
                ]);
            }
        }

        return $respon;
    }
}

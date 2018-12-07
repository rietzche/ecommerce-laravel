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
            "key: 4289bb176b07351df63fc435affaa4e6"
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
            "key: 4289bb176b07351df63fc435affaa4e6"
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
        $asal = 1;
        $id_kabupaten = $req->kab_id;
        $kurir = 'jne';
        $berat = 20;

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
            "key: 4289bb176b07351df63fc435affaa4e6"
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

        $i = 0;
        foreach($data['rajaongkir']['results'][0]['costs'] as $dat)
        {
            echo '<tr style="border-bottom: 1px solid #cccccc"><td><input type="radio" name="courier" value="POS '.$dat['service'].'"></td>';
            echo '<td><img src="/assets/images/jne1.jpg" style="width: 100px; height: 60px; margin: 0px 20px 0px 10px"></td>"';
            echo '<td><div style="margin: 5px 150px 5px 5px">';
            echo '<h6><b>JNE '.$dat['service'].'</b></h6>';
            echo '<p class="text-muted">Diterima dalam '.$dat['cost'][0]['etd'].' hari</p>';
            echo '</div>';
            echo '</td>';
            echo '<td>';
            echo '<div style="margin: 5px; width: 100px;">';
            echo '    <h6>Rp. '.number_format($dat['cost'][0]['value'], 0, ",", ".").'</h6>';
            echo '</div>';
            echo '</td>';
            echo '</tr>';

            $i++;
        }


        $asal = 1;
        $id_kabupaten = $req->kab_id;
        $kurir = 'tiki';
        $berat = 20;

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
            "key: 4289bb176b07351df63fc435affaa4e6"
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

        $i = 0;
        foreach($data['rajaongkir']['results'][0]['costs'] as $dat)
        {
            echo '<tr style="border-bottom: 1px solid #cccccc"><td><input type="radio" name="courier" value="POS '.$dat['service'].'"></td>';
            echo '<td><img src="/assets/images/tiki1.jpg" style="width: 100px; height: 60px; margin: 0px 20px 0px 10px"></td>"';
            echo '<td><div style="margin: 5px 150px 5px 5px">';
            echo '<h6><b>TIKI '.$dat['service'].'</b></h6>';
            echo '<p class="text-muted">Diterima dalam '.$dat['cost'][0]['etd'].' hari</p>';
            echo '</div>';
            echo '</td>';
            echo '<td>';
            echo '<div style="margin: 5px; width: 100px;">';
            echo '    <h6>Rp. '.number_format($dat['cost'][0]['value'], 0, ",", ".").'</h6>';
            echo '</div>';
            echo '</td>';
            echo '</tr>';

            $i++;
        }


        $asal = 1;
        $id_kabupaten = $req->kab_id;
        $kurir = 'pos';
        $berat = 20;

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
            "key: 4289bb176b07351df63fc435affaa4e6"
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

        $i = 0;
        foreach($data['rajaongkir']['results'][0]['costs'] as $dat)
        {
            echo '<tr style="border-bottom: 1px solid #cccccc"><td><input type="radio" name="courier" value="POS '.$dat['service'].'"></td>';
            echo '<td><img src="/assets/images/pos1.png" style="width: 100px; height: 60px; margin: 0px 20px 0px 10px"></td>"';
            echo '<td><div style="margin: 5px 150px 5px 5px">';
            echo '<h6><b>POS '.$dat['service'].'</b></h6>';
            echo '<p class="text-muted">Diterima dalam '.$dat['cost'][0]['etd'].'</p>';
            echo '</div>';
            echo '</td>';
            echo '<td>';
            echo '<div style="margin: 5px; width: 100px;">';
            echo '    <h6>Rp. '.number_format($dat['cost'][0]['value'], 0, ",", ".").'</h6>';
            echo '</div>';
            echo '</td>';
            echo '</tr>';

            $i++;
        }
    }
}

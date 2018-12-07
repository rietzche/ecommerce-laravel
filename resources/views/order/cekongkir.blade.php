@extends('layouts.layout')

@section('content')

<div class="container">
    <?php
        //Get Data Kabupaten
        $curl = curl_init();    
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: c7bcc0c5a39119bf4dd8a2a5b084dd1c"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
    ?>

    <div style="display: none;">
        <label>Kota Asal</label>
        <select name='asal' class='form-control' id='asal'>
            {{! $data = json_decode($response, true) }}
            @for ($i=0; $i < count($data['rajaongkir']['results']); $i++)
                <option {{{ ($data['rajaongkir']['results'][$i]['city_name'] == 'Tangerang' ? 'selected' : '') }}} value="{{$data['rajaongkir']['results'][$i]['city_id']}}">{{ $data['rajaongkir']['results'][$i]['city_name'] }}</option>
            @endfor
        </select>
    </div>
        <!-- //Get Data Kabupaten -->


    <?php 
        //Get Data Provinsi
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: c7bcc0c5a39119bf4dd8a2a5b084dd1c"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
    ?>
    <div class='form-group'>
        <label>Provinsi Tujuan</labe>
        <select class='form-control' name='provinsi' id='provinsi'>
        <option>Pilih Provinsi Tujuan</option>
        {{! $data = json_decode($response, true) }}
        @for ($i=0; $i < count($data['rajaongkir']['results']); $i++)
            <option value="{{ $data['rajaongkir']['results'][$i]['province_id'] }}">{{ $data['rajaongkir']['results'][$i]['province'] }}</option>
        @endfor
        </select>
    </div>
        <!-- //Get Data Provinsi -->
    
    <div id="main"></div>
    <div id="a" class="form-group">
        <label>Pilih Kabupaten</label>
        <select id="kabupaten" class="form-control" name="kab">
        </select>
    </div>

    <script type="text/javascript">
        
        $(document).ready(function() {
            $("#provinsi").change(function(){
                // CREATE A "DIV" ELEMENT.
                var container = document.createElement("div");  
                container.className = "form-group";
                container.id = "a";

                @for($i=0; $i < count($data['rajaongkir']['results']); $i++)
                    if ($(this).val() == "{{$data['rajaongkir']['results'][$i]['province_id']}}"){

                        <?php 
                            $id = $data['rajaongkir']['results'][$i]['province_id'];
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$id",
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => "",
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 30,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => "GET",
                              CURLOPT_HTTPHEADER => array(
                                "key: c7bcc0c5a39119bf4dd8a2a5b084dd1c"
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

                            $dataK = json_decode($response, true);
                        ?>

                        // ADD TEXTBOX.
                        $('#a').remove(); 
                        $(container).append('<label>Kabupaten Tujuan</label>'+
                            '<select style="font-size:14px" class="form-control" name="kab" id="kabupaten" required="">'+
                            '<option hidden>Pilih Kabupaten</option>'+
                            @for($j=0; $j < count($dataK['rajaongkir']['results']); $j++)
                            '<option value="{{$dataK['rajaongkir']['results'][$j]['city_id']}}">{{$dataK['rajaongkir']['results'][$j]['city_name']}}</option>'+
                            @endfor
                            '</select>'
                        );
                        $('#main').after(container);
                    }
                @endfor

            });
        });
    </script>

    <div class="form-group">
        <label>Kurir</label>
        <select id="kurir" class="form-control" name="kurir">
            <option value="jne">JNE</option>
            <option value="tiki">TIKI</option>
            <option value="pos">POS INDONESIA</option>
        </select>
    </div>

    <div class="form-group">
        <label>Berat (gram)</label>
        <input id="berat" type="text" class="form-control" name="berat" value="500" />
    </div>

    <div class="form-group">
        <button id="cek" type="button" class="btn btn-info">Cek</button>
        <!-- <input id="cek" type="submit" class="btn btn-info" value="Cek"/> -->
    </div>
</div>

<script type="text/javascript">
var p1 = "success";

var asal  = $('#asal').val();
var kab   = $('#kabupaten').val();
var kurir = $('#kurir').val();
var berat = $('#berat').val();

</script>


<?php
  $d = "<script>document.writeln(berat);</script>";
?>  


{!! $asl = "<script>document.write(asal);</script>" !!}

{!! $idK = "<script>document.write(kab);</script>" !!}
{!! $kur = "<script>document.writeln(kurir);</script>" !!}
{!! $ber = "<script>document.writeln(berat);</script>" !!}


<input type="text" value="{{ $asl }}" name="">

<div id="ongkir"></div>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#cek").click(function(){
                var container = document.createElement("div");  
                container.className = "form-group";
                container.id = "a";
                //Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax 

                <?php  
                    $asal = $asl;
                    $id_kabupaten = $idK;
                    $kurir = $kur;
                    $berat = intval($d);

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
                        "key: c7bcc0c5a39119bf4dd8a2a5b084dd1c",
                      ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                      return "cURL Error #:" . $err;
                    } else {
                    }
                ?>

                // ADD TEXTBOX.
                $('#a').remove(); 
                $(container).append('<label>{{ $response }}</label>'
                );
                $('#main').after(container);
            });
        });
    </script>

        
@endsection
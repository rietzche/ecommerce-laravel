@extends('layouts.layout')

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title bold">Checkout</h5>
    </div>
</div>


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

<div class="container" style="margin-bottom: 100px">
    <!-- panel alamat -->
    <div style="border: 1px solid #cccccc; background-color: #ffffff; padding: 0px 20px">
        <h6 style="float: left;">Pilih alamat pengiriman</h6>
        <select id="addrs" style="float: left; margin: 10px">
            <option hidden="">Pilih</option>
            @foreach($addresses as $address)
            <option value="{{ $address->id }}">{{ $address->receiver_name }}</option>
            @endforeach
        </select>
        <div class="clear"></div>
    </div>
    <!-- panel alamat -->

  <script type="text/javascript">
  $(document).ready(function() {
      $("#addrs").change(function(){
        // CREATE A "DIV" ELEMENT.
      var container = document.createElement("div");
          container.id="a";

          @foreach($addresses as $d)
          if ($(this).val() == "{{$d->id}}"){
                // ADD TEXTBOX.
              $('#a').remove();
                $(container).append('<div class="col-sm-10">'+ 
                  '<input type="hidden" name="address" value="{{ $d->id }}" readonly="" required="">'+
                  '<h6><b>{{$d->receiver_name }} ({{$d->number_tlp }})</b></h6> '+
                  '<h6>{{ $d->others }}, {{ $d->region }}, '+
                  '<input type="text" id="kab" value="{{ $d->city }}" style="display:none">'+
                    {{! $data = json_decode($response, true) }}
                    @for ($i=0; $i < count($data['rajaongkir']['results']); $i++)
                        '{{{ ($data['rajaongkir']['results'][$i]['city_id'] == $d->city ? $data['rajaongkir']['results'][$i]['city_name'].", " : '') }}}'+
                        '{{{ ($data['rajaongkir']['results'][$i]['city_id'] == $d->city ? $data['rajaongkir']['results'][$i]['province']." - " : '') }}}'+
                    @endfor  
                  '{{ $d->zip_code }}</h6>'+
                  '</div>'+
                  '<div id="col-sm-2">'+
                  '<a href="/edit address/{{ $d->id }}" style="float: right; margin-top: 30px">UBAH</a>'+
                  '</div>'
                );
                // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
                $('#main').after(container);
            }
            @endforeach
      });
  });
  </script>

<form action="{{ route('order.create') }}" method="post">
    @csrf
    <!-- panel alamat -->
    <div class="panel panel-flat">
        <div class="panel-heading">     
            @if(count($addresses)!=0)
            <div class="row">
                <div class="col-sm-12">
                    <span style="color: #ff6600;font-size: 1.4em"><i class="glyphicon glyphicon-map-marker"></i>&nbsp;Alamat Pengiriman</span>
                </div>
                <div id="main"></div>
                <div id="a">
                    <div class="col-sm-10">
                        <input type="hidden" name="address" value="{{ $address->id }}" readonly="" required="">
                        <h6><b>{{ $address->receiver_name }} ({{$address->number_tlp}})</b></h6>
                        <h6>{{ $address->others }}, {{ $address->region }}, 
                        <input type="text" id="kab" value="{{ $d->city }}" style="display:none">
                        @for($i=0; $i < count($data['rajaongkir']['results']); $i++)
                            {{{ ($data['rajaongkir']['results'][$i]['city_id'] == $address->city ? $data['rajaongkir']['results'][$i]['city_name'].", " : '') }}}
                            {{{ ($data['rajaongkir']['results'][$i]['city_id'] == $address->city ? $data['rajaongkir']['results'][$i]['province']." - " : '') }}}
                        @endfor
                        {{ $address->zip_code }}</h6>
                    </div>
                    <div class="col-sm-2">
                        <a href="/edit address/{{ $address->id }}" style="float: right; margin-top: 30px">UBAH</a>
                    </div>
                </div>
            </div>
            @else
                <h5 class="text-center text-muted">Alamat Kosong</h5>
            @endif
        </div>
        <div class="panel-body" style="border-top: 1px solid #cccccc; padding-top: 10px">
            <a href="" data-toggle="modal" data-target="#modal_tambah_alamat"><i class="icon-add-to-list"></i>&nbsp;Tambah Alamat</a>
        </div>
    </div>
    <!-- panel alamat -->

    <!-- panel produk dibeli -->
    <div class="panel panel-flat">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><h6>Produk Dipesan</h6></th>
                        <th class="text-muted">Harga Satuan</th>
                        <th class="text-muted">Jumlah</th>
                        <th class="text-muted">Subtotal Produk</th>
                    </tr>
                </thead>
                <tbody>
                    {{!! $tmp = 0 }}
                    {{!! $jum = 0 }}
                    @foreach($carts as $cart)
                    {{! $product = App\Product::find($cart->id_product) }}
                    <tr>
                        <td style="width: 600px">
                            <div class="detail-cart">
                                <img src="/uploads/foto-produk/{{ App\Picture::where('id_product', $product->id)->first()->picture }}" style="width: 50px; height: 50px">
                                <p>{{ $product->name }} <!-- (<b>Ukuran : 210x100</b> ) (<b>warna : merah</b>) --></p>
                                <div class="clear"></div>
                            </div>
                        </td>
                        <td>Rp. {{ $product->price }}</td>
                        <td>
                            <p>{{ $cart->quantity }}</p>
                        </td>
                        <td>Rp. {{ number_format($tmp = $product->price * $cart->quantity, 0, ",", ".") }}</td>
                        {{! $jum = $jum + $tmp }}
                        {{!! $tmp = 0 }}
                    </tr>
                    @endforeach
                    <tr id="maink"></tr>
                        <tr id="m" style="background-color: #fafdff;">
                                    <td><h6 style="float: right;color:#269900">Opsi Pengiriman :</h6></td>
                                    <td>
                                        <h6>Pilih opsi..</h6>
                                        <p></p>
                                    </td>
                                    <td><a id="cek" data-toggle="modal" data-target="#modal_default">UBAH</a>
                                    </td>
                                    <td></td>
                        </tr>
                    <tr style="background-color: #fafdff;">
                        <td></td>
                        <td></td>
                        <td><p style="color: #999999"><b>Total Pesanan ({{ count($carts) }} Produk)</b><p></td>
                        <td><h5 style="color: #ff6600; margin-top:-2px;">Rp. {{ number_format($jum, 0, ",", ".") }}</h5></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- panel produk dibeli -->

    <!-- modal pengiriman-->
    <div id="modal_default" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Opsi Pengiriman</h5>
                </div>

                <div class="modal-body">
                    <table>
                        <tbody>
                        <div id="mainc">
                        <div id="k">
                        </div>
                        </div>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button id="pilih" type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal pengiriman -->

    <!-- panel opsi pengiriman -->
    <div class="delivery-option">   
        <div>
            <div class="head-del-option">
                <h6 class="metode-p">Metode Pembayaran</h6>
                <h6 class="trf-bank">Transfer Bank</h6>     
                <div class="clear"></div>   
            </div>
            <div class="body-del-option">
                <h6>Pilih Bank</h6>
                <div style="float: left;">
                    @foreach($banks as $bank)
                    <div class="radio">
                        <label style="font-size: 14px">
                            <input type="radio" name="bank" required="" class="styled" value="{{$bank->id}}">{{ $bank->nama_bank }}
                        </label>
                    </div>
                    @endforeach
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="foot-pesanan">
            <div class="left-pesanan">
                <h6 class="text-muted">Pesan : </h6>
                <textarea name="msg" style="height: 100px; width:500px; resize: none;" placeholder="(Opsional) Tinggalkan pesan ke penjual"></textarea>
            </div>
            <div class="right-pesanan">
                <table style="width: 100%">
                    <tbody>
                        <tr>
                            <td><h6>Subtotal untuk Produk</h6></td>
                            <td><h6>Rp. {{ number_format($jum, 0, ",", ".") }}</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Total Ongkos Kirim</h6></td>
                            
                            <input type="hidden" name="ongkir" value="2000">

                            <td><h6>Rp. <span id="ong">{{ number_format(0, 0, ",", ".") }}</span></h6></td>
                        </tr>
                        <tr>
                            <td><h6>Total Pembayaran</h6></td>
                            <td><h4 style="font-weight: bold; color:#ff6600;">Rp. <span id="jujum">{{ number_format($jum+0, 0, ",", ".") }}</span></h4></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="submit" class="btn-buat-pesanan">Buat Pesanan</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- panel opsi pengiriman -->
</form>

<!-- -------------------------------------------------------------  -->
    <!-- modal tambah alamat-->
    <div id="modal_tambah_alamat" class="modal fade" role="dialog">
        <form action="{{ route('address.create') }}" method="post">
        @csrf
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Alamat</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="receiver_name" placeholder="Nama Penerima" required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="number_tlp" placeholder="Nomor Telepon" required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="zip_code" placeholder="Kode Pos" required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <?php 
                        
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
                            "key:  c7bcc0c5a39119bf4dd8a2a5b084dd1c "
                          ),
                        ));
            
                        $response = curl_exec($curl);
                        $err = curl_error($curl);

                        $data = json_decode($response, true);

                        ?>
                        <select id="provinsi" class="form-control" name="province" required="">
                        @for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
                            <option value='{{$data['rajaongkir']['results'][$i]['province_id']}}'>{{$data['rajaongkir']['results'][$i]['province']}}</option>
                        @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="kabupaten" class="form-control" name="city" required="">
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="region" required="" class="form-control" placeholder="Kecamatan">
                    </div>
                    <div class="form-group">
                        <input type="text" name="others" placeholder="Nama gedung, jalan dan lainnya..." required="" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ok</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- /modal tambah alamat -->
</div>

@if(count($addresses)==0)
<script type="text/javascript">
    $('#modal_tambah_alamat').modal('show');
</script>
@endif

<script type="text/javascript">
$(document).ready(function(){
    $('#provinsi').change(function(){

        //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
        var prov = $('#provinsi').val();

          $.ajax({
            type : 'GET',
               url : 'http://localhost:8000/cek_kabupaten',
            data :  'prov_id=' + prov,
                success: function (data) {

                //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                $("#kabupaten").html(data);
            }
          });
    });

    $("#cek").click(function(){
        //Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax 
        
        var kab = $('#kab').val();
        var container = document.createElement("div");
            container.id="k";
        var i = 0;
          $.ajax({
            type : 'GET',
               url : 'http://localhost:8000/cek_ongkir',
               data :  {'kab_id' : kab},
                    success: function (data) {
                        data.forEach(function(){
                            $('#k').remove();
                            $(container).append( 
                            '<tr style="border-bottom: 1px solid #cccccc">'+
                                    '<td>'+
                                        '<input type="radio" name="courier" value="'+data[i].service+'">'+
                                    '</td>'+
                                    '<td>'+
                                        '<img src="/assets/images/jne1.jpg" style="width: 100px; height: 60px; margin: 0px 20px 0px 10px">'+
                                    '</td>'+
                                    '<td>'+
                                        '<div style="margin: 5px 150px 5px 5px">'+
                                            '<h6><b>'+data[i].service+'</b></h6>'+
                                            '<p class="text-muted">Diterima dalam '+data[i].etd+' hari</p>'+
                                        '</div>'+
                                    '</td>'+
                                    '<td>'+
                                        '<div style="margin: 5px; width: 100px;">'+
                                            '<h6>Rp. '+data[i].cost+'</h6>'+
                                        '</div>'+
                                    '</td>'+
                                '</tr>'
                            );
                            // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
                            $('#mainc').after(container);

                            i++;
                        });
                    }    
                    //jika data berhasil didapatkan, tampilkan ke dalam element div ongkir
          });
    });

    $('#pilih').click(function(){

    //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
        var checkval = $("input[name='courier']:checked").val();
        var kab = $('#kab').val();
        var container = document.createElement("tr");
            container.id="m";
        var i = 0;
        var jum = 0;
        if(checkval){
            $.ajax({
            type : 'GET',
                url : 'http://localhost:8000/cek_ongkir',
                data :  {'kab_id' : kab},
                    success: function (data) {
                        data.forEach(function(){
                            if(data[i].service == checkval)
                            {
                                $('#m').remove();
                                $(container).append(
                                    '<td><h6 style="float: right;color:#269900;margin-top: -20px">Opsi Pengiriman :</h6></td>'+
                                    '<td>'+
                                        '<h6><b>'+checkval+'</b></h6>'+
                                        '<p>Diterima dalam '+data[i].etd+' hari</p>'+
                                    '</td>'+
                                    '<input type="hidden" name="courier" value="'+checkval+'">'+
                                    '<td><a id="cek" data-toggle="modal" data-target="#modal_default">UBAH</a>'+
                                    '</td>'+
                                    '<td>Rp. '+data[i].cost+'</td>'
                                );
                                
                                $('#maink').after(container);
                                $('#ong').text(data[i].cost);
                                jum = (parseInt(data[i].cost) * 1000) + {{ $jum }};

                                var reverse = jum.toString().split('').reverse().join(''),
                                ribuan  = reverse.match(/\d{1,3}/g);
                                ribuan  = ribuan.join('.').split('').reverse().join('');
                                $('#jujum').text(ribuan);
                            }
                            i++;
                        });
                    }
            });
        }
    });
});
</script>

@endsection
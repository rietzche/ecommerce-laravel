@extends('layouts.layout')

@section('content')
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Alamat</h5>
                <div class="right">
	            	<a onclick="deleteAddress({{ $address->id }})">Hapus Alamat</a>
                </div>
            </div>

            <form action="{{ route('address.update', $address->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="receiver_name" placeholder="Nama Penerima" required="" class="form-control" value="{{ $address->receiver_name }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="number_tlp" placeholder="Nomor Telepon" required="" class="form-control" value="{{ $address->number_tlp }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="zip_code" placeholder="Kode Pos" required="" class="form-control" value="{{ $address->zip_code }}">
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
                            "key: 4289bb176b07351df63fc435affaa4e6"
                          ),
                        ));
            
                        $response = curl_exec($curl);
                        $err = curl_error($curl);

			            $data = json_decode($response, true);

                        ?>
                        <select id="provinsi" class="form-control" name="province" required="">
                        @for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
				            <option {{{ ($data['rajaongkir']['results'][$i]['province_id'] == $address->province ? 'selected' : '') }}} value='{{$data['rajaongkir']['results'][$i]['province_id']}}'>{{$data['rajaongkir']['results'][$i]['province']}}</option>
                        @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="kabupaten" class="form-control" name="city" required="">
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="region" required="" class="form-control" placeholder="Kecamatan" value="{{ $address->region }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="others" placeholder="Nama gedung, jalan dan lainnya..." required="" class="form-control" value="{{ $address->others }}">
                    </div>
                </div>

                <div class="modal-footer">
                	<a href="{{ URL::Previous() }}" class="btn btn-link">Batal</a>
                	<input type="submit" class="btn btn-primary" value="Ok">
                </div>
            </form>
        </div>
    </div>

<script>
    function deleteAddress(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Yakin akan menghapus?",
            text: "Tidak akan dapat mengembalikan lagi!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then((value) => {
            if(value){
                fetch("/address delete/"+id,{
                    method: "DELETE",
                    headers: {
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    }
                })
                .then(res => {
                    location.assign('/checkout'); //reload();
                })
                .catch(err => {
                    swal("Oops..", "Something went wrong", "error");
                })
            }
        })
    }
</script>

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
          $.ajax({
            type : 'GET',
               url : 'http://localhost:8000/cek_ongkir',
               data :  {'kab_id' : kab},
                    success: function (data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam element div ongkir
                    $("#ongkir").html(data);
            }
          });
    });
});
</script>
@endsection
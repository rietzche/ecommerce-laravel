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
                        <input type="text" name="receiver_name" value="{{ $address->receiver_name }}" placeholder="Nama Penerima" required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="number_tlp" value="{{ $address->number_tlp }}" placeholder="Nomor Telepon" required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="zip_code" placeholder="Kode Pos" value="{{ $address->zip_code }}" required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="province" required="">
                            <option hidden="">Provinsi</option>
                            <option value="AZ" selected="">Arizona</option>
                            <option value="CO">Colorado</option>
                            <option value="ID">Idaho</option>
                            <option value="WY">Wyoming</option>
                            <option value="AL">Alabama</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="CT">Connecticut</option>
                            <option value="FL">Florida</option>
                            <option value="MA">Massachusetts</option>
                            <option value="WV">West Virginia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="city" required="">
                            <option hidden="">Kota</option>
                            <option value="AZ" selected="">Arizona</option>
                            <option value="CO">Colorado</option>
                            <option value="ID">Idaho</option>
                            <option value="WY">Wyoming</option>
                            <option value="AL">Alabama</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="CT">Connecticut</option>
                            <option value="FL">Florida</option>
                            <option value="MA">Massachusetts</option>
                            <option value="WV">West Virginia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="region" required="">
                            <option hidden="">Kecamatan</option>
                            <option value="AZ" selected="">Arizona</option>
                            <option value="CO">Colorado</option>
                            <option value="ID">Idaho</option>
                            <option value="WY">Wyoming</option>
                            <option value="AL">Alabama</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="CT">Connecticut</option>
                            <option value="FL">Florida</option>
                            <option value="MA">Massachusetts</option>
                            <option value="WV">West Virginia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="others" value="{{ $address->others }}" placeholder="Nama gedung, jalan dan lainnya..." required="" class="form-control">
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
@endsection
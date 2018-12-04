@extends('layouts.layout')

@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title bold">Checkout</h5>
	</div>
</div>

<div class="container" style="margin-bottom: 100px">
	<!-- panel alamat -->
	<div style="border: 1px solid #cccccc; background-color: #ffffff; padding: 0px 20px">
		<h6 style="float: left;">Pilih alamat pengiriman</h6>
		<select style="float: left; margin: 10px">
			<option hidden="">Pilih</option>
			<option>Alamat 1</option>
			<option>Alamat 2</option>
		</select>
		<div class="clear"></div>
	</div>
	<!-- panel alamat -->

<form action="/pembayaran" method="GET">
	<!-- panel alamat -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<table>
				<thead>
					<tr>
						<td><h5 class="panel-title" style="color: #ff6600"><i class="glyphicon glyphicon-map-marker"></i>&nbsp;Alamat Pengiriman</h5></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<h6><b>Febri Ardi Saputra (082281059671)</b></h6>
							<h6>Asrama Granada Kamar 7, jln. Lio Utara, No.25, Rt.001, Rw.010, Sebrang Pangkalan Bus Damri Cibiru, KOTA BANDUNG - CIBIRU, JAWA BARAT, ID 40614</h6>
						</td>
						<td width="120"><a href="" style="float: right; margin-top: 30px">UBAH</a></td>
					</tr>
				</tbody>
			</table>
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
								<p>{{ $product->name }} (<b>Ukuran : 210x100</b> ) (<b>warna : merah</b>)</p>
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
					<tr style="background-color: #fafdff;">
						<td><h6 style="float: right;color:#269900;margin-top: -20px">Opsi Pengiriman :</h6></td>
						<td>
							<h6><b>JNE REG</b></h6>
							<p>Diterima dalam 2-4 hari</p>
						</td>
						<td><a href="" data-toggle="modal" data-target="#modal_default">UBAH</a>
						</td>
						<td>Rp. 2.000</td>
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
					<div>
						
					<table>
						<tbody>
							@for($i=0; $i<=1; $i++)
							<tr style="border-bottom: 1px solid #cccccc">
								<td>
									<input type="radio" name="opsi1">
								</td>
								<td>
									<img src="/assets/images/jne{{$i+1}}.jpg" style="width: 100px; height: 60px; margin: 0px 20px 0px 10px">
								</td>
								<td>
									<div style="margin: 5px 150px 5px 5px">
										<h6><b>JNE OKE</b></h6>
										<p class="text-muted">Diterima dalam 2-4 hari</p>
									</div>
								</td>
								<td>
									<div style="margin: 5px; width: 100px;">
										<h6>Rp. 11.000</h6>
									</div>
								</td>
							</tr>
							@endfor
						</tbody>
					</table>

					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Ok</button>
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
					@for($i=0;$i<=3;$i++)
					<div class="radio">
						<label style="font-size: 14px">
							<input type="radio" name="warna" class="styled">Bank BCA
						</label>
					</div>
					@endfor
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		
		<div class="foot-pesanan">
			<div class="left-pesanan">
				<h6 class="text-muted">Pesan : </h6>
				<textarea style="height: 100px; width:500px; resize: none;" placeholder="(Opsional) Tinggalkan pesan ke penjual"></textarea>
			</div>
			<div class="right-pesanan">
				<table style="width: 100%">
					<tr>
						<td><h6>Subtotal untuk Produk</h6></td>
						<td><h6>Rp. {{ number_format($jum, 0, ",", ".") }}</h6></td>
					</tr>
					<tr>
						<td><h6>Total Ongkos Kirim</h6></td>
						<td><h6>Rp. 2000</h6></td>
					</tr>
					<tr>
						<td><h6>Total Pembayaran</h6></td>
						<td><h4 style="font-weight: bold; color:#ff6600;">Rp. {{ number_format($jum+2000, 0, ",", ".") }}</h4></td>
					</tr>
					<tr>
						<td></td>
						<td><button type="submit" class="btn-buat-pesanan">Buat Pesanan</button></td>
					</tr>
				</table>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<!-- panel opsi pengiriman -->
</form>

<!-- -------------------------------------------------------------  -->

	<!-- modal tambah alamat-->
	<div id="modal_tambah_alamat" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Alamat</h5>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<input type="text" name="nm_penerima" placeholder="Nama Penerima" required="" class="form-control">
					</div>
					<div class="form-group">
						<input type="text" name="no_telp" placeholder="Nomor Telepon" required="" class="form-control">
					</div>
					<div class="form-group">
						<input type="text" name="no_telp" placeholder="Kode Pos" required="" class="form-control">
					</div>
					<div class="form-group">
						<select class="form-control" name="provinsi" required="">
							<option hidden="">Provinsi</option>
							<option value="AZ">Arizona</option>
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
						<select class="form-control" name="kota" required="">
							<option hidden="">Kota</option>
							<option value="AZ">Arizona</option>
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
						<select class="form-control" class="kecamatan" required="">
							<option hidden="">Kecamatan</option>
							<option value="AZ">Arizona</option>
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
						<input type="text" name="detail_alamat" placeholder="Nama gedung, jalan dan lainnya..." required="" class="form-control">
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Ok</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /modal tambah alamat -->
</div>
	
@endsection
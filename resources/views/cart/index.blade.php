@extends('layouts.layout')

@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title bold">Keranjang Belanja</h5>
	</div>
</div>

<form action="{{ route('cart.update') }}" method="post">
	@csrf
	@method('PUT')
	<div class="container" style="min-height:300px">
		<!-- Basic table -->
		<div class="panel panel-flat">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Produk</th>
							<th>Harga Satuan</th>
							<th>Kuantitas</th>
							<th>Total harga</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						{{!! $jum = 0 }}
						{{!! $tmp = 0 }}
						@foreach($carts as $cart)
						<tr>
							<td style="width: 600px">
								<div class="detail-cart">
									<img src="/uploads/foto-produk/{{ App\Picture::where('id_product', $cart->id_product)->value('picture') }}">
									<h6>{{ App\Product::find($cart->id_product)->name }}</h6>
									<p class="text-muted">Ukuran : </p>
									<p class="text-muted">Warna : </p>
									<div class="clear"></div>
								</div>
							</td>
							<td>Rp. {{ $price = App\Product::find($cart->id_product)->price }}</td>
							<td>				
								<script type="text/javascript">

								function btKurang{{$cart->id}}() {
									n = 0;
									n1 = eval(document.getElementById('jumlah{{$cart->id}}').value);
									pprice = eval(document.getElementById('pprice').value);
									if (n1>1) {
										n = n1-1;
										tp = n * parseInt({{$price}});
										document.getElementById('jumlah{{$cart->id}}').value = n;
										document.getElementById('totprice{{$cart->id}}').value = tp;

										pprice = pprice - parseInt({{$price}});
										document.getElementById('pprice').value = pprice;
									}
								}
								function btTambah{{$cart->id}}() {
									n = 0;
									{{! $stock = App\Stock::where('id_product', $cart->id_product)->first() }}
									n2 = parseInt({{ $stock->stock }});
									n1 = eval(document.getElementById('jumlah{{$cart->id}}').value);
									pprice = eval(document.getElementById('pprice').value);
									if (n1 < n2) {
										n = n1+1;
										tp = n * parseInt({{$price}});
										document.getElementById('jumlah{{$cart->id}}').value = n;
										document.getElementById('totprice{{$cart->id}}').value = tp;
										
										pprice = pprice + parseInt({{$price}});
										document.getElementById('pprice').value = pprice;
									}
								}												
								</script>
								<div>
									<button type="button" onclick="btKurang{{$cart->id}}()" class="btJum"><i class="icon-minus3"></i></button>
									<input type="text" autocomplete="off" id="jumlah{{$cart->id}}" class="inJum" value="{{ $cart->quantity }}" name="jum[{{$cart->id}}]">
									<button type="button" onclick="btTambah{{$cart->id}}()" class="btJum"><i class="icon-plus3"></i></button>
								</div>
							</td>
							<td style="color: #ff6600;">Rp. <input type="text" id="totprice{{$cart->id}}" readonly value="{{ $tmp = $price * $cart->quantity }}" style="border:none"></td>
							<td>
								<a class="text-info"
									onclick="deleteCart({{ $cart->id }})">
									Hapus
								</a>
							</td>
						</tr>
						{{! $jum = $jum + $tmp }}
						{{!! $tmp = 0 }}
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<!-- /basic table -->
	</div>
		
	<div class="footer-cart">
		<div style="float: right;">
			<h6>Subtotal untuk ({{count($carts)}}) Produk :</h6>	
			<h2 style="margin-right:-180px">Rp. <input id="pprice" type="text" value="{{ $jum }}" style="border:none" readonly></h2>
			<button type="submit">Checkout</button>
		</div>
		<div class="clear"></div>
	</div>
</form>
	<script>
		function deleteCart(id){
			var csrf_token = $('meta[name="csrf-token"]').attr('content');
			swal({
				title: "Yakin akan menghapus?",
				text: "Anda dapat memilih lagi untuk membeli!",
				icon: "warning",
				buttons: true,
				dangerMode: true
			}).then((value) => {
				if(value){
					fetch("/cart/"+id,{
						method: "DELETE",
						headers: {
							"X-CSRF-Token": $('input[name="_token"]').val()
						}
					})
					.then(res => {
						location.reload();
					})
					.catch(err => {
						swal("Oops..", "Something went wrong", "error");
					})
				}
			})
		}
	</script>

@endsection
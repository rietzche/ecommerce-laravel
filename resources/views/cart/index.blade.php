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
						<div style="display: none;">
							{{!! $jum = 0 }}
							{{!! $tmp = 0 }}
						</div>
						@foreach($carts as $cart)
						<tr>
							<td style="width: 600px">
								<div class="detail-cart">
									<img src="/uploads/foto-produk/{{ App\Picture::where('id_product', $cart->id_product)->value('picture') }}">
									<h6>{{ App\Product::find($cart->id_product)->name }}</h6>
									<!-- <p class="text-muted">Ukuran : </p>
									<p class="text-muted">Warna : </p> -->
									<div class="clear"></div>
								</div>
							</td>
							{{! $price = App\Product::find($cart->id_product)->price }}
							<td>Rp. {{ number_format($price, '0',',','.') }}</td>
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

										var reverse = pprice.toString().split('').reverse().join(''),
										ribuan = reverse.match(/\d{1,3}/g);
										ribuan = ribuan.join('.').split('').reverse().join('');
										$('#ppk').text(ribuan);
									}
								}

								function limit{{$cart->id}}(){
									{{! $stock = App\Stock::where('id_product', $cart->id_product)->first() }}
									n2 = parseInt({{ $stock->stock }});
									n1 = eval(document.getElementById('jumlah{{$cart->id}}').value);
									pprice = eval(document.getElementById('pprice').value);
									if ( n1 > n2 )
									{
										document.getElementById('jumlah{{$cart->id}}').value = n2;
										
										pprice = n1 * parseInt({{$price}});
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
										
										var reverse = tp.toString().split('').reverse().join(''),
										ribuan = reverse.match(/\d{1,3}/g);
										ribuan = ribuan.join('.').split('').reverse().join('');
										$('#totP').text(ribuan);

										pprice = pprice + parseInt({{$price}});
										document.getElementById('pprice').value = pprice;
										var reverse = pprice.toString().split('').reverse().join(''),
										ribuan = reverse.match(/\d{1,3}/g);
										ribuan = ribuan.join('.').split('').reverse().join('');
										$('#ppk').text(ribuan);
									}
								}												
								</script>
								<div>
									<button type="button" onclick="btKurang{{$cart->id}}()" class="btJum"><i class="icon-minus3"></i></button>
									<input type="text" autocomplete="off" readonly="" onkeyup="limit{{$cart->id}}()" id="jumlah{{$cart->id}}" class="inJum" value="{{ $cart->quantity }}" name="jum[{{$cart->id}}]">
									<button type="button" onclick="btTambah{{$cart->id}}()" class="btJum"><i class="icon-plus3"></i></button>
								</div>
							</td>
							<td style="color: #ff6600;">Rp. 
								<input type="hidden" id="totprice{{$cart->id}}" readonly value="{{ $tmp = $price * $cart->quantity }}" style="border:none">
								<span id="totP">{{ number_format($tmp, '0',',','.') }}</span>
							</td>
							<td>
								<a class="text-info"
									onclick="deleteCart({{ $cart->id }})">
									Hapus
								</a>
							</td>
						</tr>

						<div style="display: none;">
							{{! $jum = $jum + $tmp }}
							{{!! $tmp = 0 }}
						</div>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<!-- /basic table -->
	</div>
	@if(count($carts) != 0)
	<div class="footer-cart">
		<div style="float: right;">
			<h6>Subtotal untuk ({{count($carts)}}) Produk :</h6>	
			<h2>Rp. 
				<span id="ppk">{{ number_format($jum, '0',',','.')  }}</span>
				<input id="pprice" type="hidden" value="{{ $jum }}" style="border:none" readonly>
			</h2>
			<button type="submit">Checkout</button>
		</div>
		<div class="clear"></div>
	</div>
	@endif
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
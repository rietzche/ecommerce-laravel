@extends('layouts.layout')

@section('content')
<div class="container">
	<div class="bg-detail">
		<!-- foto detail produk -->
		<div class="detail-gambar">
			<div class="gambar-utama">
				<img src="/uploads/foto-produk/{{(App\Picture::where('id_product', '=', $product->id))->value('picture')}}">
			</div>
			<div class="gambar-kecil">
				{{! $pict = (App\Picture::where('id_product', '=', $product->id))->get() }}
				@foreach($pict as $p)
				<img src="/uploads/foto-produk/{{ $p->picture }}">
				@endforeach
				<div class="clear"></div>
			</div>
		</div>
		<!-- foto detail produk -->

		<!-- form action produk -->
		<div class="form-action-produk">
			<h4>{{ $product->name }}</h4>
			<div style="float: right;">
				<p style="margin-bottom: -5px">Penilaian produk</p>
				<div class="text-nowrap" style="float:left; margin-top: 5px">
					<fieldset class="rating-sm">
						<p class="text-muted text-star">(30)</p>
					    <input type="radio" id="star5" name="rating" disabled="" value="5" /><label class = "full" for="star5" title="Sangat Baik"></label>
					    <input type="radio" id="star4" name="rating" disabled="" value="4" /><label class = "full" for="star4" title="Baik"></label>
					    <input type="radio" id="star3" name="rating" disabled="" value="3" checked="" /><label class = "full" for="star3" title="Standar"></label>
					    <input type="radio" id="star2" name="rating" disabled="" value="2" /><label class = "full" for="star2" title="Kurang Baik"></label>
					    <input type="radio" id="star1" name="rating" disabled="" value="1" /><label class = "full" for="star1" title="Tidak Baik"></label>
					</fieldset>
				</div>
			</div>
			<div class="clear"></div>
			<div class="bar-harga">
				<h4 style="font-weight: bold;">Rp. {{ number_format($product->price,0 , "," , ".") }}</h4>
			</div>

			<div class="actgroup">
				<h6 class="text-muted">Pilihan warna :</h6>
				@for($i=1;$i<=3;$i++)
				<div class="radio">
					<label>
						<input type="radio" name="warna" class="styled">
						Warna&nbsp;{{$i}}
					</label>
				</div>
				@endfor
			</div>
			<div class="clear"></div>
		
			<div class="actgroup">
				<h6 class="text-muted">Ukuran :</h6>
				@for($i=1;$i<=3;$i++)
				<div class="radio">
					<label>
						<input type="radio" name="ukuran" class="styled">
						Ukuran&nbsp;{{$i}}
					</label>
				</div>
				@endfor
			</div>
			<div class="clear"></div>
			<form action="/cart" method="post" style="float: left; margin-right: -40px">
			@csrf
				<div style="margin-top: 20px;">
					<h6 class="text-muted" style="float: left;">Kuantitas : </h6>
					<div class="btnGroup">
						<button type="button" onclick="btKurang()" class="btJum"><i class="icon-minus3"></i></button>
						<input type="text" autocomplete="off" id="jumlah" class="inJum" value="1" name="quantity">
						<button type="button" onclick="btTambah()" class="btJum"><i class="icon-plus3"></i></button>
						{{! $stock = App\Stock::where('id_product', $product->id)->first() }}
						<p class="text-muted">Tersisa {{ $stock->stock }} buah</p>
					</div>
					<script>
						function btKurang() {
							n = 0;
							n1 = eval(document.getElementById('jumlah').value);
							if (n1>1) {
								n = n1-1;
								document.getElementById('jumlah').value = n;
								document.getElementById('jumlahN').value = n;
							}
						}
						function btTambah() {
							n = 0;
							n2 = parseInt({{ $stock->stock }});
							n1 = eval(document.getElementById('jumlah').value);
							if ( n1 < n2 )
							{
								n = n1+1;
								document.getElementById('jumlah').value = n;
								document.getElementById('jumlahN').value = n;
							}
						}
					</script>
				</div>

				<input type="hidden" name="product" value="{{ $product->id }}">

				<div class="clear"></div>
				<button type="submit" class="btnCart"><i class="icon-cart-add" style="font-size: 18px"></i> Masukkan Keranjang</button>
			</form>

			<form action="/buy now" method="POST" style="float: left;margin-top: 97px">
				@csrf
				<input type="hidden" name="product" value="{{ $product->id }}">
				<input type="hidden" autocomplete="off" id="jumlahN" class="inJum" value="1" name="quantity">
				<input type="submit" class="btnBuy" value="Beli Sekarang">
			</form>

			<div class="clear"></div>
				<hr>
				<div style="">
					<h6 class="text-muted">Deskripsi Produk : </h6>
					<p>{!! $product->description !!}</p>
				</div>
			</div>
		<!-- deskripsi produk -->
		<div class="clear"></div>
	</div>

	<div class="bg-detail">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Penilaian Produk</h5>
			</div>
		</div>
		@for($i=0;$i<=2;$i++)
		<div class="review-panel">
			<img src="/assets/images/placeholder.jpg">		
			<div class="review-coment">			
				<p>Febri Ardi Saputra</p>
				<div class="text-nowrap" style="margin-top: -10px">
					<fieldset class="rating-sm">
					    <input type="radio" id="star5" name="rating" disabled="" value="5" /><label class = "full" for="star5" title="Sangat Baik"></label>
					    <input type="radio" id="star4" name="rating" disabled="" value="4" /><label class = "full" for="star4" title="Baik"></label>
					    <input type="radio" id="star3" name="rating" disabled="" value="3" checked="" /><label class = "full" for="star3" title="Standar"></label>
					    <input type="radio" id="star2" name="rating" disabled="" value="2" /><label class = "full" for="star2" title="Kurang Baik"></label>
					    <input type="radio" id="star1" name="rating" disabled="" value="1" /><label class = "full" for="star1" title="Tidak Baik"></label>
					</fieldset>
					<div class="clear"></div>
				</div>
				<p style="margin-top: 5px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. </p>
				<p class="text-muted">{{date('Y-m-d G:i')}}</p>
			</div>
			<div class="clear"></div>
			<hr>
		</div>
		@endfor
	</div>
</div>
@endsection
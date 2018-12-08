@extends('layouts.layout')

@section('content')
<div class="container">
	<div class="bg-detail">
		<!-- foto detail produk -->
		<div class="detail-gambar">
			<div class="gambar-utama">
				<img src="/uploads/foto-produk/{{(App\Picture::where('id_product', '=', $product->id))->value('picture')}}" id="myImg">
			</div>
			<div class="gambar-kecil">
				{{! $pict = (App\Picture::where('id_product', '=', $product->id))->get() }}
				@foreach($pict as $p)
				<img onclick="myFunct{{$p->id}}()" src="/uploads/foto-produk/{{ $p->picture }}">
				<script>
					function myFunct{{$p->id}}() {
					    document.getElementById("myImg").src = "/uploads/foto-produk/{{ $p->picture }}";
					}
				</script>
				@endforeach
				<div class="clear"></div>
			</div>
		</div>
		<!-- foto detail produk -->
		{{! $Ratings = App\Rating::where('id_product', $product->id)->get() }}
		{{! $rt = App\Rating::where('id_product', $product->id)->value('rate') }}
		<!-- form action produk -->
		<div class="form-action-produk">
			<h4>{{ $product->name }}</h4>
			<div style="float: right;">
				<p style="margin-bottom: -5px">Penilaian produk</p>
				<div class="text-nowrap" style="float:left; margin-top: 5px">
					<fieldset class="rating-sm">
						<p class="text-muted text-star">({{ count($Ratings) }})</p>
					    <input type="radio" id="star5" value="5" disabled="" {{{ ($rt == 5 ? 'checked' : '') }}}/><label class = "full" for="star5" title="Sangat Baik"></label>
					    <input type="radio" id="star4" value="4" disabled="" {{{ ($rt == 4 ? 'checked' : '') }}}/><label class = "full" for="star4" title="Baik"></label>
					    <input type="radio" id="star3" value="3" disabled="" {{{ ($rt == 3 ? 'checked' : '') }}}/><label class = "full" for="star3" title="Standar"></label>
					    <input type="radio" id="star2" value="2" disabled="" {{{ ($rt == 2 ? 'checked' : '') }}}/><label class = "full" for="star2" title="Kurang Baik"></label>
					    <input type="radio" id="star1" value="1" disabled="" {{{ ($rt == 1 ? 'checked' : '') }}}/><label class = "full" for="star1" title="Tidak Baik"></label>
					</fieldset>
				</div>
			</div>
			<div class="clear"></div>
			<div class="bar-harga">
				<h4 style="font-weight: bold;">Rp. {{ number_format($product->price, 0, "," , ".") }}</h4>
			</div>

			<!-- <div class="actgroup">
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
			</div> -->
			
			<div class="clear"></div>
			<form action="/cart" method="post" style="float: left; margin-right: -40px">
			@csrf
				<div style="margin-top: 20px;">
					<h6 class="text-muted" style="float: left;">Kuantitas : </h6>
					<div class="btnGroup">
						<button type="button" onclick="btKurang()" class="btJum"><i class="icon-minus3"></i></button>
						<input type="text" autocomplete="off" onkeyup="limit()" id="jumlah" class="inJum" value="1" name="quantity">
						<button type="button" onclick="btTambah()" class="btJum"><i class="icon-plus3"></i></button>
						{{! $stock = App\Stock::where('id_product', $product->id)->first() }}
						<p class="text-muted">Tersisa {{ $stock->stock }} buah</p>
					</div>
					<script>
						@if($stock->stock==0)
						document.getElementById('jumlah').value = 0;
						@endif
						function btKurang() {
							n = 0;
							n1 = eval(document.getElementById('jumlah').value);
							if (n1>1) {
								n = n1-1;
								document.getElementById('jumlah').value = n;
								document.getElementById('jumlahN').value = n;
							}
						}

						function limit(){
							n2 = parseInt({{ $stock->stock }});
							n1 = eval(document.getElementById('jumlah').value);
							if ( n1 > n2 )
							{
								document.getElementById('jumlah').value = n2;
								document.getElementById('jumlahN').value = n2;
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
				@if($stock->stock > 0)
				<button type="submit" class="btnCart"><i class="icon-cart-add" style="font-size: 18px"></i> Masukkan Keranjang</button>
				@else
				<a class="btnCart"><i class="icon-cart-add" style="font-size: 18px"></i> Masukkan Keranjang</a>
				@endif
			</form>

			@if($stock->stock > 0)
			<form action="/buy now" method="POST" style="float: left;margin-top: 97px">
				@csrf
				<input type="hidden" name="product" value="{{ $product->id }}">
				<input type="hidden" autocomplete="off" onkeyup="limit()" id="jumlahN" class="inJum" value="1" name="quantity">
				<input type="submit" class="btnBuy" value="Beli Sekarang">
			</form>
			@else
			<div style="float: left;margin-top: 98px">
				<a type="submit" class="btnBuy">Beli Sekarang</a>
			</div>
			@endif

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
		@foreach($Ratings as $rt)
		<div class="review-panel">
			<img src="/assets/images/placeholder.jpg">		
			<div class="review-coment">			
				<p>{{ App\User::find($rt->id_user)->name }}</p>
				<div class="text-nowrap" style="margin-top: -10px">
					<fieldset class="rating-sm">
					    <input type="radio" id="star5" value="5" disabled="" {{{ ($rt->rate == 5 ? 'checked' : '') }}}/><label class = "full" for="star5" title="Sangat Baik"></label>
					    <input type="radio" id="star4" value="4" disabled="" {{{ ($rt->rate == 4 ? 'checked' : '') }}}/><label class = "full" for="star4" title="Baik"></label>
					    <input type="radio" id="star3" value="3" disabled="" {{{ ($rt->rate == 3 ? 'checked' : '') }}}/><label class = "full" for="star3" title="Standar"></label>
					    <input type="radio" id="star2" value="2" disabled="" {{{ ($rt->rate == 2 ? 'checked' : '') }}}/><label class = "full" for="star2" title="Kurang Baik"></label>
					    <input type="radio" id="star1" value="1" disabled="" {{{ ($rt->rate == 1 ? 'checked' : '') }}}/><label class = "full" for="star1" title="Tidak Baik"></label>
					</fieldset>
					<div class="clear"></div>
				</div>
				<p style="margin-top: 5px">{{ $rt->review }} </p>
				<p class="text-muted">{{ date('Y-m-d G:i', strtotime($rt->created_at)) }}</p>
			</div>
			<div class="clear"></div>
			<hr>
		</div>
		@endforeach
	</div>
</div>
@endsection
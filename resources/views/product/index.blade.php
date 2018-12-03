@extends('layouts.layout')

@section('content')
<!-- Grid -->
<div class="content">
	<div class="row">	
		<div class="col-sm-3">
			<!-- Detached sidebar -->
			<div class="sidebar-detached">
				<div class="sidebar sidebar-default">
					<div class="sidebar-content">

						<!-- Sidebar -->
						<div class="sidebar-category">
							<div class="category-title">
								<h5><i class="icon-filter4"></i> SARING FILTER</h5>
								<h6><b>Berdasarkan Kategori</b></h6>
							</div>

							<div class="category-content no-padding">
								<ul class="navigation navigation-alt navigation-accordion">
									@foreach($categories as $category)
									<li><a href="" class="text-info">{{ $category->name }}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
						<!-- /sidebar -->
					</div>
				</div>
			</div>
	        <!-- /detached sidebar -->
		</div>

		<div class="col-sm-9">
			<div class="bar-action">
				<h6>Urutkan</h6>
				<a href="">Terbaru</a>
				<a href="">Terlaris</a>
				<select class="dropdown-harga">
					<option>Harga</option>
					<option>Harga Tertinggi</option>
					<option>Harga Terendah</option>
				</select>

				<div class="clear"></div>
			</div>
			@foreach($products as $product)
			<a href="/product/{{ $product->id }}" class="panel-produk">
				<div class="panel-img">
					<img src="/uploads/foto-produk/{{ App\Picture::where('id_product', $product->id)->value('picture') }}" style="padding: 5px">
				</div>
				<div class="body-panel-produk">
					<p class="p-produk">{{ $product->name }} </p>
					<p class="p-harga">Rp. {{ $product->price }}</p>
					<div style="float: right;">
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
			</a>
			@endforeach
		</div>
	</div>
</div>
@endsection
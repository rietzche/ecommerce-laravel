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
									<li><a href="/products/{{ $category->id }}" class="text-info">{{ $category->name }}</a></li>
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
				<a href="/products terbaru">Terbaru</a>
				<a href="/products terlaris">Terlaris</a>
				
				<select id="hargaDropdown" class="dropdown-harga">
					<option hidden>Harga</option>
					<option value="1">Harga Tertinggi</option>
					<option value="2">Harga Terendah</option>
				</select>

				<div class="clear"></div>
			</div>

			<div id="main"></div>
			<div id="a">
				{{! $prod = $products }}
			</div>

			<script type="text/javascript">
				$(document).ready(function() {
				    $("#hargaDropdown").change(function(){
				    	// CREATE A "DIV" ELEMENT.
			        	var container = document.createElement("div");
			        	
				       	if ($(this).val() == "1"){
			                // ADD TEXTBOX.
			            	$('#a').remove(); 
			                $(container).append('<div id="a"></div>'
			                );
			                // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
			                $('#main').after(container);
			            }

						else if ($(this).val() == "2"){
			                // ADD TEXTBOX.
			            	$('#a').remove(); 
			                $(container).append('<div id="a"></div>'
			                );
			                // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
			                $('#main').after(container);
			            }
						// location.reload();
				    });
				});
			</script>

			@foreach($prod as $product)
			<div style="display: none;">
				{{! $jumRt = App\Rating::where('id_product', $product->id)->get() }}
				{{! $rt = App\Rating::where('id_product', $product->id)->value('rate') }}
			</div>
			<a href="/product/{{ $product->id }}" class="panel-produk">
				<div class="panel-img">
					<img src="/uploads/foto-produk/{{ App\Picture::where('id_product', $product->id)->value('picture') }}" style="padding: 5px">
				</div>
				<div class="body-panel-produk">
					<p class="p-produk">{{ $product->name }} </p>
					<p class="p-harga">Rp. {{ number_format($product->price,0 , "," , ".") }}</p>
					<div style="float: right;">
						<fieldset class="rating-sm">
							<p class="text-muted text-star">({{ count($jumRt) }})</p>
						    <input type="radio" id="star5" disabled="" value="5" {{{ ($rt == 5 ? 'checked' : '') }}}/><label class = "full" for="star5" title="Sangat Baik"></label>
						    <input type="radio" id="star4" disabled="" value="4" {{{ ($rt == 4 ? 'checked' : '') }}}/><label class = "full" for="star4" title="Baik"></label>
						    <input type="radio" id="star3" disabled="" value="3" {{{ ($rt == 3 ? 'checked' : '') }}}/><label class = "full" for="star3" title="Standar"></label>
						    <input type="radio" id="star2" disabled="" value="2" {{{ ($rt == 2 ? 'checked' : '') }}}/><label class = "full" for="star2" title="Kurang Baik"></label>
						    <input type="radio" id="star1" disabled="" value="1" {{{ ($rt == 1 ? 'checked' : '') }}}/><label class = "full" for="star1" title="Tidak Baik"></label>
						</fieldset>
					</div>
				</div>
			</a>
			@endforeach
		</div>
	</div>
</div>
@endsection
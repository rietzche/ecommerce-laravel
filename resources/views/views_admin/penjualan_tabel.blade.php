@extends('layouts.layout_admin')

@section('content')
	<!-- Marketing campaigns -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h6 class="panel-title">Daftar Penjualan</h6>
		</div>

		<div class="table-responsive">
			<table class="table datatable-button-print-basic">
				<thead>
					<tr>
						<th>No</th>
						<th class="col-md-2">Barang</th>
						<th class="col-md-2">Kategori</th>
						<th class="col-md-2">Jumlah Terjual</th>
						<th class="col-md-2">Penilaian</th>
						<th class="col-md-2">Sisa Stok</th>
						<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
					</tr>
				</thead>
				<tbody>
					{{! $no = 1 }}
					@foreach($orders as $order)
					<div style="display: none;">
						{{! $product = App\Product::find($order->id_product) }}
						{{! $jumRt = App\Rating::where('id_product', $product->id)->get() }}
						{{! $rt = App\Rating::where('id_product', $product->id)->value('rate') }}
					</div>
					<tr>
						<td>{{$no++}}</td>
						<td>{{ $product->name }}</td>
						<td>{{ App\Category::find($product->id_category)->name }}</td>
						<td>{{ App\Stock::where('id_product', $product->id)->value('terjual') }}</td>
						<td>
							<fieldset class="rating-sm">
								<p class="text-muted text-star">({{ count($jumRt) }})</p>
							    <input type="radio" id="star5" disabled="" value="5" {{{ ($rt == 5 ? 'checked' : '') }}}/><label class = "full" for="star5" title="Sangat Baik"></label>
							    <input type="radio" id="star4" disabled="" value="4" {{{ ($rt == 4 ? 'checked' : '') }}}/><label class = "full" for="star4" title="Baik"></label>
							    <input type="radio" id="star3" disabled="" value="3" {{{ ($rt == 3 ? 'checked' : '') }}}/><label class = "full" for="star3" title="Standar"></label>
							    <input type="radio" id="star2" disabled="" value="2" {{{ ($rt == 2 ? 'checked' : '') }}}/><label class = "full" for="star2" title="Kurang Baik"></label>
							    <input type="radio" id="star1" disabled="" value="1" {{{ ($rt == 1 ? 'checked' : '') }}}/><label class = "full" for="star1" title="Tidak Baik"></label>
							</fieldset>
						</td>
						<td>{{ App\Stock::where('id_product', $product->id)->value('stock') }}</td>
						<td class="text-center">
							<!-- <ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="#"><i class="icon-eye"></i> Lihat detail</a></li>
										<li><a href="#"><i class="icon-pencil7"></i> Update</a></li>
									</ul>
								</li>
							</ul> -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- /marketing campaigns -->
@endsection
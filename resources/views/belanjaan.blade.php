@extends('layouts.layout')

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="panel panel-flat">
			<div class="panel-body">
				<div class="tabbable">
					<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
						<li class="active">
							<a href="#highlighted-justified-tab1" style="font-size: 16px;" data-toggle="tab">Belum Bayar <span class="pop-up">({{ count($orders) }})</span></a>
						</li>
						<li>
							<a href="#highlighted-justified-tab2" style="font-size: 16px;" data-toggle="tab">Belum Dikirimkan <span class="pop-up">({{ count($orderx) }})</span></a>
						</li>
						<li>
							<a href="#highlighted-justified-tab3" style="font-size: 16px;" data-toggle="tab">Belum Diterima <span class="pop-up">(1)</span></a>
						</li>
						<li>
							<a href="#highlighted-justified-tab4" style="font-size: 16px;" data-toggle="tab">Selesai <span class="pop-up">(1)</span></a>
						</li>
						<li>
							<a href="#highlighted-justified-tab5" style="font-size: 16px;" data-toggle="tab">Batal <span class="pop-up">(1)</span></a>
						</li>
					</ul>
					
					<div class="tab-content">			
						<!-- Belum Bayar -->
						<div class="tab-pane active" id="highlighted-justified-tab1">
							@if(count($orders) == 0)
							<div class="panel-no-orders">
								<img src="/assets/images/icon_list.png" >
								<p class="text-muted">Belum ada pesanan</p>
							</div>
							@else
							@foreach($orders as $order)
								<table class="table">
									<thead>
										<tr>
											<th><h6>Produk</h6></th>
											<th class="text-muted">Harga Satuan</th>
											<th class="text-muted">Jumlah</th>
											<th class="text-muted">Subtotal Produk</th>
										</tr>
									</thead>
									<tbody>
										{{! $od = \App\Order::where('code', $order->code)->get() }}
										@foreach($od as $o)
										{{! $product = \App\Product::find($o->id_product) }}
										<tr>
											<td style="width: 50%">
												<div class="detail-cart">
													<img src="/assets/images/1.jpg" style="width: 50px; height: 50px">
													<p>{{ $product->name }} (<b>Ukuran : 210x100</b> ) (<b>warna : merah</b>)</p>
													<div class="clear"></div>
												</div>
											</td>
											<td>Rp. {{ number_format($product->price, 0, ",", ".") }}</td>
											<td>
												<p>{{ $o->quantity }}</p>
											</td>
											<td>Rp. {{ number_format($o->price_total, 0, ",", ".") }}</td>
										</tr>
										@endforeach
									</tbody>
								</table>

								<div class="foot-table">
									<div class="header">
										<h1>Rp {{ number_format($od->sum('price_total'), 0, ",", ".") }}</h1>
										<h6>Jumlah Harus Dibayar :</h6>
									</div>
									<div class="clear"></div>

									<div class="footer-table">
										<a href="/pembayaran/{{ $order->code }}" class="btn btn-info">Transfer Sekarang</a>
										<a href="" onclick="ConfirmDelete()" style="margin:0px 3px" class="btn btn-default">Batalkan Pesanan</a>
									</div>
									
									<div class="clear"></div>
								</div>
							@endforeach
							@endif
						</div>
						<!-- /Belum Bayar -->
						
						<!-- Belum Dikirimkan -->
						<div class="tab-pane" id="highlighted-justified-tab2">
							@if(count($orderx) == 0)
							<!-- jika tidak ada orderan -->
							<div class="panel-no-orders">
								<img src="/assets/images/icon_list.png" >
								<p class="text-muted">Belum ada pesanan</p>
							</div>
							<!-- jika ada orderan -->
							@else
							@foreach($orderx as $order)
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th><h6>Produk</h6></th>
											<th class="text-muted">Harga Satuan</th>
											<th class="text-muted">Jumlah</th>
											<th class="text-muted">Subtotal Produk</th>
											<th class="text-muted">Keterangan</th>
										</tr>
									</thead>
									<tbody>
										{{! $od = \App\Order::where('code', $order->code)->get() }}
										@foreach($od as $o)
										{{! $product = \App\Product::find($o->id_product) }}
										<tr>
											<td style="width: 50%">
												<div class="detail-cart">
													<img src="/assets/images/1.jpg" style="width: 50px; height: 50px">
													<p>{{ $product->name }} (<b>Ukuran : 210x100</b> ) (<b>warna : merah</b>)</p>
													<div class="clear"></div>
												</div>
											</td>
											<td>Rp. {{ number_format($product->price, 0, ",", ".") }}</td>
											<td>
												<p>{{ $o->quantity }}</p>
											</td>
											<td>Rp. {{ number_format($od->sum('price_total'), 0, ",", ".") }}</td>
											<td>
												<span class="label label-info">sedang dikemas</span>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<br>
							@endforeach
							@endif
						</div>
						<!-- /Belum Dikirimkan -->

						<!-- Belum Diterima -->
						<div class="tab-pane" id="highlighted-justified-tab3">
							<!-- jika tidak ada orderan -->
							<div class="panel-no-orders">
								<img src="/assets/images/icon_list.png" >
								<p class="text-muted">Belum ada pesanan</p>
							</div>
							<!-- jika ada orderan -->
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th><h6>Produk</h6></th>
											<th class="text-muted">Harga Satuan</th>
											<th class="text-muted">Jumlah</th>
											<th class="text-muted">Subtotal Produk</th>
											<th class="text-muted">Keterangan</th>
										</tr>
									</thead>
									<tbody>
										@for($i=0; $i<=1; $i++)
										<tr>
											<td style="width: 50%">
												<div class="detail-cart">
													<img src="/assets/images/1.jpg" style="width: 50px; height: 50px">
													<p>SWEATER SUPREME VM Sweater Cardigan Polos Rajut ZIpper Hoodie Long Knitt Abu Muda X7O6Z (<b>Ukuran : 210x100</b> ) (<b>warna : merah</b>)</p>
													<div class="clear"></div>
												</div>
											</td>
											<td>Rp. 150.000</td>
											<td>
												<p>1</p>
											</td>
											<td>Rp. 120.000</td>
											<td>
												<span class="label label-info">sedang dikirim</span>
											</td>
										</tr>
										@endfor
									</tbody>
								</table>
							</div>
						</div>
						<!-- /Belum Diterima -->

						<!-- Selesai -->
						<div class="tab-pane" id="highlighted-justified-tab4">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th><h6>Produk</h6></th>
											<th class="text-muted">Harga Satuan</th>
											<th class="text-muted">Jumlah</th>
											<th class="text-muted">Subtotal Produk</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@for($i=1; $i<=3; $i++)
										<tr>
											<td style="width: 600px">
												<div class="detail-cart">
													<img src="/assets/images/1.jpg" style="width: 50px; height: 50px">
													<p>SWEATER SUPREME VM Sweater Cardigan Polos Rajut ZIpper Hoodie Long Knitt Abu Muda X7O6Z (<b>Ukuran : 210x100</b> ) (<b>warna : merah</b>)</p>
													<div class="clear"></div>
												</div>
											</td>
											<td>Rp. 150.000</td>
											<td>
												<p>1</p>
											</td>
											<td>Rp. 120.000</td>
											<td>
												<a href="javascript::void(0)" data-toggle="modal" data-target="#modalNilai{{$i}}" class="btn btn-info btn-sm">Nilai Produk</a>
												
												<div id="modalNilai{{$i}}" class="modal fade">
													<div class="modal-dialog modal-sm">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h5 class="modal-title">Nama Produk {{$i}}</h5>
															</div>

															<form action="" method="">
																<div class="modal-body">
																	<label>Berikan Penilaian:</label><br>
																	<fieldset class="rating">
																	    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Sangat Baik"></label>
																	    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Baik"></label>
																	    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Standar"></label>
																	    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kurang Baik"></label>
																	    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Tidak Baik"></label>
																	</fieldset>
																	<div class="clear"></div>
																	<hr>
																	<textarea class="form-control" rows="4" placeholder="Tinggalkan pesan"></textarea>
																</div>

																<div class="modal-footer">
																	<button type="button" style="width: 100%" class="btn btn-primary">Kirim</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<!-- /small modal -->
											</td>
										</tr>
										@endfor
									</tbody>
								</table>
							</div>
						</div>
						<!-- /Selesai -->
						
						<!-- Batal -->
						<div class="tab-pane" id="highlighted-justified-tab5">
							<div class="panel-no-orders">
								<img src="/assets/images/icon_list.png" >
								<p class="text-muted">Belum ada pesanan</p>
							</div>
						</div>
						<!-- Batal -->
					</div>
				</div>
			</div>
		</div>							
	</div>
</div>

<script>
    function ConfirmDelete() {
      var x = confirm("Yakin Akan Membatalkan?");
      if (x)
        return true;
      else
        return false;}
</script> 
@endsection
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
							<a href="#highlighted-justified-tab3" style="font-size: 16px;" data-toggle="tab">Belum Diterima <span class="pop-up">({{ count($orderD) }})</span></a>
						</li>
						<li>
							<a href="#highlighted-justified-tab4" style="font-size: 16px;" data-toggle="tab">Selesai <span class="pop-up">({{ count($orderT) }})</span></a>
						</li>
						<li>
							<a href="#highlighted-justified-tab5" style="font-size: 16px;" data-toggle="tab">Batal <span class="pop-up">({{ count($orderCancel) }})</span></a>
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
							<div style="display: none;">
							{{!! $st = App\Order::where('code', $order->code)->value('status') }}
							</div>
							@if($st == 0)
								<h4 style="color: #ff6600">Menunggu Pembayaran</h4>
							@elseif($st == 2)
								<h4 style="color: #ff6600">Pembayaran Tidak Diterima</h4>
							@endif
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
													<img src="/uploads/foto-produk/{{ App\Picture::where('id_product', $product->id)->value('picture') }}" style="width: 50px; height: 50px">
													<p>{{ $product->name }} <br></p>
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
									<div class="msg">
										<h6 class="text-muted">Pesan : </h6>
										<span>{{ $o->msg }}</span>
									</div>

									<div class="foot-action">
										<div class="header">
											<h1>Rp {{ number_format($od->sum('price_total') + $od->first()->ongkir, 0, ",", ".") }}</h1>
											<h6>Jumlah Harus Dibayar :</h6>
										</div>
										<div class="clear"></div>

										<div class="footer-table">
											<a href="/pembayaran/{{ $order->code }}" class="btn btn-info">Transfer Sekarang</a>
											<a onclick="batalPesanan({{$order->code}})" style="margin:0px 3px" class="btn btn-default">Batalkan Pesanan</a>
										</div>					
									</div>
									<div class="clear"></div>
								</div>
							<hr style="border:5px solid #cccccc">
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
							<div style="display: none;">
								{{ $st = App\Order::where('code', $order->code)->value('status') }}
							</div>
							@if($st == 1)
							<h4 style="color: #ff6600">Sedang Diproses</h4>
							@elseif($st == 3)
							<h4 style="color: #ff6600">Sedang Dikemas</h4>
							@endif
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
										<div style="display: none;">
											{{! $od = \App\Order::where('code', $order->code)->get() }}
										</div>
										@foreach($od as $o)
										{{! $product = \App\Product::find($o->id_product) }}
										<tr>
											<td style="width: 50%">
												<div class="detail-cart">
													<img src="/uploads/foto-produk/{{ App\Picture::where('id_product', $product->id)->value('picture') }}" style="width: 50px; height: 50px">
													<p>{{ $product->name }} <br></p>
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
									<div class="msg">
										<h6 class="text-muted">Pesan : </h6>
										<span>{{ $o->msg }}</span>
									</div>

									<div class="foot-action">
										<div class="header">
											<h1>Rp {{ number_format($od->sum('price_total') + $od->first()->ongkir, 0, ",", ".") }}</h1>
											<h6>Total Belanja :</h6>
										</div>
										<div class="clear"></div>

										<div class="footer-table">
											<a onclick="batalPesanan({{$order->code}})" style="margin:0px 3px" class="btn btn-default">Batalkan Pesanan</a>
										</div>					
									</div>
									<div class="clear"></div>
								</div>
							<hr style="border:5px solid #cccccc">
							@endforeach
							@endif
						</div>
						<!-- /Belum Dikirimkan -->

						<script>
							function batalPesanan(code){
								var csrf_token = $('meta[name="csrf-token"]').attr('content');
								swal({
									title: "Yakin akan membatalkan?",
									text: "Silahkan order kembali jika ingin membeli barang!",
									icon: "warning",
									buttons: true,
									dangerMode: true
								}).then((value) => {
									if(value){
										fetch("/cancel pesanan/"+code,{
											method: "PUT",
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

						<!-- Belum Diterima -->
						<div class="tab-pane" id="highlighted-justified-tab3">
							@if(count($orderD) == 0)
							<!-- jika tidak ada orderan -->
							<div class="panel-no-orders">
								<img src="/assets/images/icon_list.png" >
								<p class="text-muted">Belum ada pesanan</p>
							</div>
							<!-- jika ada orderan -->
							@else
							@foreach($orderD as $order)
							<h4 style="color: #ff6600">Sedang Dikirim</h4>
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
										<div style="display: none;">
											{{! $od = \App\Order::where('code', $order->code)->get() }}
										</div>
										@foreach($od as $o)
										{{! $product = \App\Product::find($o->id_product) }}
										<tr>
											<td style="width: 50%">
												<div class="detail-cart">
													<img src="/uploads/foto-produk/{{ App\Picture::where('id_product', $product->id)->value('picture') }}" style="width: 50px; height: 50px">
													<p>{{ $product->name }} <br></p>
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
									<div class="msg">
										<h6 class="text-muted">Pesan : </h6>
										<span>{{ $o->msg }}</span>
									</div>

									<div class="foot-action">
										<div class="header">
											<h1>Rp {{ number_format($od->sum('price_total') + $od->first()->ongkir, 0, ",", ".") }}</h1>
											<h6>Total Belanja :</h6>
										</div>
										<div class="clear"></div>
										<div class="footer-table">
											<form action="{{ route('pesanan.diterima', $order->code) }}" method="POST">
												@csrf
												@method('PUT')
												<input type="submit" class="btn btn-info" value="Konfirmasi Diterima">
											</form>
										</div>					
									</div>
									<div class="clear"></div>
								</div>
							<hr style="border:5px solid #cccccc">
							@endforeach
							@endif
						</div>
						<!-- /Belum Diterima -->

						<!-- Selesai -->
						<div class="tab-pane" id="highlighted-justified-tab4">
							@if(count($orderT) == 0)
							<!-- jika tidak ada orderan -->
							<div class="panel-no-orders">
								<img src="/assets/images/icon_list.png" >
								<p class="text-muted">Belum ada pesanan</p>
							</div>
							<!-- jika ada orderan -->
							@else

							{{! $d = 1 }}
							@foreach($orderT as $order)
								{{! $n = $d++ }}
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
										<div style="display: none;">
											{{! $od = \App\Order::where('code', $order->code)->get() }}
											{{! $i=1 }}
										</div>
										@foreach($od as $o)
										{{! $product = \App\Product::find($o->id_product) }}
										{{! $d = $i++ }}
										<tr>
											<td style="width: 50%">
												<div class="detail-cart">
													<img src="/uploads/foto-produk/{{ App\Picture::where('id_product', $product->id)->value('picture') }}" style="width: 50px; height: 50px">
													<p>{{ $product->name }} <br></p>
													<div class="clear"></div>
												</div>
											</td>
											<td>Rp. {{ number_format($product->price, 0, ",", ".") }}</td>
											<td>
												<p>{{ $o->quantity }}</p>
											</td>
											<td>Rp. {{ number_format($o->price_total, 0, ",", ".") }}</td>
											<td>
												<div style="display: none;">
													{{! $ratings = App\Rating::where([['id_product', $o->id_product],['id_user', Auth::user()->id]])->get() }}
												</div>
												@if(count($ratings)==0)
												<a href="javascript::void(0)" data-toggle="modal" data-target="#modalNilai{{$o->id}}" class="btn btn-info btn-sm">Nilai Produk</a>
												<div id="modalNilai{{$o->id}}" class="modal fade">
													<div class="modal-dialog modal-sm">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<form action="{{ route('rating.create') }}" method="POST">
																@csrf
																<input type="hidden" name="id_product" value="{{ $o->id_product }}" readonly="" required="">
																<div class="modal-body">
																	<label>Berikan Penilaian:</label><br>
																	<fieldset class="rating">
																	    <input type="radio" id="star5[{{$n}}{{$d}}]" name="rating[{{$o->id_product}}]" value="5" />
																	    <label class = "full" for="star5[{{$n}}{{$d}}]" title="Sangat Baik"></label>
																	    <input type="radio" id="star4[{{$n}}{{$d}}]" name="rating[{{$o->id_product}}]" value="4" />
																	    <label class = "full" for="star4[{{$n}}{{$d}}]" title="Baik"></label>
																	    <input type="radio" id="star3[{{$n}}{{$d}}]" name="rating[{{$o->id_product}}]" value="3" />
																	    <label class = "full" for="star3[{{$n}}{{$d}}]" title="Standar"></label>
																	    <input type="radio" id="star2[{{$n}}{{$d}}]" name="rating[{{$o->id_product}}]" value="2" />
																	    <label class = "full" for="star2[{{$n}}{{$d}}]" title="Kurang Baik"></label>
																	    <input type="radio" id="star1[{{$n}}{{$d}}]" name="rating[{{$o->id_product}}]" value="1" />
																	    <label class = "full" for="star1[{{$n}}{{$d}}]" title="Tidak Baik"></label>
																	</fieldset>
																	<div class="clear"></div>
																	<hr>
																	<textarea class="form-control" name="review" rows="4" placeholder="Tinggalkan pesan"></textarea>
																</div>

																<div class="modal-footer">
																	<input type="submit" value="Kirim" style="width: 100%" class="btn btn-primary">
																</div>
															</form>
														</div>
													</div>
												</div>
												<!-- /small modal -->
												@else
												@foreach($ratings as $rt)
												<a href="javascript::void(0)" data-toggle="modal" data-target="#modalLihat{{$o->id}}" class="btn btn-info btn-sm">Lihat Penilaian</a>
												<div id="modalLihat{{$o->id}}" class="modal fade">
													<div class="modal-dialog modal-sm">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<form action="{{ route('rating.update', $rt->id) }}" method="POST">
																@csrf
																@method('PUT')
																<input type="hidden" name="id_product" value="{{ $o->id_product }}" readonly="" required="">
																<div class="modal-body">
																	<label>Penilaian Produk:</label><br>
																	<fieldset class="rating">
																	    <input type="radio" id="star5[{{$n}}{{$d}}]" name="rating[{{$o->id_product}}]" value="5" {{{ ($rt->rate == 5 ? 'checked' : '') }}} />
																	    <label class = "full" for="star5[{{$n}}{{$d}}]" title="Sangat Baik"></label>
																	    <input type="radio" id="star4[{{$n}}{{$d}}]" name="rating[{{$o->id_product}}]" value="4" {{{ ($rt->rate == 4 ? 'checked' : '') }}}/>
																	    <label class = "full" for="star4[{{$n}}{{$d}}]" title="Baik"></label>
																	    <input type="radio" id="star3[{{$n}}{{$d}}]" name="rating[{{$o->id_product}}]" value="3" {{{ ($rt->rate == 3 ? 'checked' : '') }}}/>
																	    <label class = "full" for="star3[{{$n}}{{$d}}]" title="Standar"></label>
																	    <input type="radio" id="star2[{{$n}}{{$d}}]" name="rating[{{$o->id_product}}]" value="2" {{{ ($rt->rate == 2 ? 'checked' : '') }}}/>
																	    <label class = "full" for="star2[{{$n}}{{$d}}]" title="Kurang Baik"></label>
																	    <input type="radio" id="star1[{{$n}}{{$d}}]" name="rating[{{$o->id_product}}]" value="1" {{{ ($rt->rate == 1 ? 'checked' : '') }}}/>
																	    <label class = "full" for="star1[{{$n}}{{$d}}]" title="Tidak Baik"></label>
																	</fieldset>
																	<div class="clear"></div>
																	<hr>
																	<textarea class="form-control" name="review" rows="4" placeholder="Tinggalkan pesan"> {{$rt->review}} </textarea>
																</div>

																<div class="modal-footer">
																	<input type="submit" value="Ubah" style="width: 100%" class="btn btn-primary">
																</div>
															</form>
														</div>
													</div>
												</div>
												<!-- /small modal -->
												@endforeach
												@endif
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>

								<div class="foot-table">
									<div class="msg">
										<h6 class="text-muted">Pesan : </h6>
										<span>{{ $o->msg }}</span>
									</div>

									<div class="foot-action">
										<div class="header">
											<h1>Rp {{ number_format($od->sum('price_total'), 0, ",", ".") }}</h1>
											<h6>Total Belanja :</h6>
										</div>
										<div class="clear"></div>
									</div>
									<div class="clear"></div>
								</div>
							<hr style="border:5px solid #cccccc">
							@endforeach
							@endif
						</div>
						<!-- /Selesai -->
						
						<!-- Batal -->
						<div class="tab-pane" id="highlighted-justified-tab5">
							@if(count($orderCancel) == 0)
							<div class="panel-no-orders">
								<img src="/assets/images/icon_list.png" >
								<p class="text-muted">Belum ada pesanan</p>
							</div>
							@else
							@foreach($orderCancel as $order)
								<h4 style="color: #ff6600">Dibatalkan</h4>
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
													<img src="/uploads/foto-produk/{{ App\Picture::where('id_product', $product->id)->value('picture') }}" style="width: 50px; height: 50px">
													<p>{{ $product->name }} <br></p>
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
									<div class="msg">
										<h6 class="text-muted">Pesan : </h6>
										<span>{{ $o->msg }}</span>
									</div>

									<div class="foot-action">
										<div class="header">
											<h1>Rp {{ number_format($od->sum('price_total'), 0, ",", ".") }}</h1>
											<h6>Total Belanja :</h6>
										</div>
										<div class="clear"></div>

										<div class="footer-table">
											<a href=" {{ route('product', $product->id) }} " style="margin:0px 3px; padding: 10px 50px" class="btn btn-default">Beli Lagi</a>
										</div>					
									</div>
									<div class="clear"></div>
								</div>
							<hr style="border:5px solid #cccccc">
							@endforeach
							@endif
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
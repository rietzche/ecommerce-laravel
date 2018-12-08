@extends('layouts.layout_admin')

@section('content')
{{! $month = date('m') }}
<!-- Dashboard Content-->
<div class="row">
	<div class="col-lg-9">
		<div class="col-lg-4">
			<!-- Members online -->
			<div class="panel bg-blue-300">
				<div class="panel-body">
					<div class="heading-elements">
						<ul class="icons-list">
	                		<li><a data-action="reload"></a></li>
	                	</ul>
                	</div>
                	<div style="float: left;width: 70px; height:70px; margin-right: 10px">
                		<img src="/assets/images/members-icon.png" width="100%" height="100%">
                	</div>
					<h3 class="no-margin">{{ number_format(count(App\User::all()),'0',',','.') }}</h3>
					Pelanggan
				</div>
			</div>
			<!-- /members online -->
		</div>

		<div class="col-lg-4">
			<!-- Members online -->
			<div class="panel bg-teal-300">
				<div class="panel-body">
					<div class="heading-elements">
						<ul class="icons-list">
	                		<li><a data-action="reload"></a></li>
	                	</ul>
                	</div>
                	<div style="float: left;width: 90px; height:70px; margin-right: 10px">
                		<img src="/assets/images/product-icon.png" width="100%" height="100%">
                	</div>
					<h3 class="no-margin">{{ number_format(count(App\Product::all()),'0',',','.') }}</h3>
					Produk
				</div>
			</div>
			<!-- /members online -->
		</div>

		<div class="col-lg-4">
			<!-- Members online -->
			<div class="panel bg-orange-300">
				<div class="panel-body">
					<div class="heading-elements">
						<ul class="icons-list">
	                		<li><a data-action="reload"></a></li>
	                	</ul>
                	</div>
                	<div style="float: left;width: 70px; height:70px; margin-right: 10px">
                		<img src="/assets/images/cart.png" width="100%" height="100%">
                	</div>
					<h3 class="no-margin">{{ App\Stock::sum('terjual') }}</h3>
					Penjualan
				</div>
			</div>
			<!-- /members online -->
		</div>
	</div>


	<div class="col-lg-3">
		<!-- Sales stats -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">Sales statistics</h6>
			</div>
			<div class="container-fluid">
				<div class="row text-center">
					<div class="col-md-6">
						<div class="content-group">
							<h5 class="text-semibold no-margin"><i class="icon-calendar5 position-left text-slate"></i>
								{{ App\Stock::sum('terjual') }}

								{{! App\Stock::select('terjual')->groupBy(function($date) {return \Carbon\Carbon::parse($date->created_at)->format('W');}) }}

							</h5>
							<span class="text-muted text-size-small">orders weekly</span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="content-group">
							<h5 class="text-semibold no-margin"><i class="icon-calendar52 position-left text-slate"></i> 
								{{ App\Stock::whereMonth('created_at', $month)->sum('terjual') }}
							</h5>
							<span class="text-muted text-size-small">orders monthly</span>
						</div>
					</div>

				</div>
			</div>

			<div class="content-group-sm" id="app_sales"></div>
			<div id="monthly-sales-stats"></div>
		</div>
		<!-- /sales stats -->
	</div>
	
	<!-- sales stats -->
	<div class="col-lg-12">
		<!-- Marketing campaigns -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">Pesanan Baru</h6>
			</div>

			<div class="table-responsive">
				<table class="table text-nowrap">
					<thead>
						<tr>
							<th class="col-md-2">Order ID</th>
							<th class="col-md-2">Pelanggan</th>
							<th class="col-md-2">Tgl Order</th>
							<th class="col-md-2">Bukti Transfer</th>
							<th class="col-md-2">Total</th>
							<th class="col-md-2">Status</th>
							<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
						</tr>
					</thead>
					<tbody>
						<tr class="active border-double">
							<td colspan="6">Hari ini</td>
							<td class="text-right">
								<span class="progress-meter" id="today-progress" data-progress="30"></span>
							</td>
						</tr>
						@foreach($orders as $order)
						<div style="display: none;">
							{{!! $o = \App\Order::where('code', $order->code)->first() }}
							{{ $tgl = date('d/m/Y') }}
							{{ $tglOrd = date('d/m/Y', strtotime($o->created_at))}}
						</div>
						@if($tgl==$tglOrd)
						<tr>
							<td>{{$order->code}}</td>
							<td><span class="text-muted">{{ App\user::find($o->id_user)->name }}</span></td>
							<td>{{ $tglOrd }}</td>
							<td>
								<a href="javascript::void(0)" data-toggle="modal" data-target="#myModal{{ $order->id }}"><i class="icon-eye"></i> Lihat</a>
								<!-- The Modal -->
								<div class="modal" id="myModal{{ $order->id }}" role="dialog">
								    <div class="modal-dialog modal-xs">
								    	<div class="modal-content">
									        <!-- Modal Header -->
									        <div class="modal-header">
									        	<h6 class="modal-title">Bukti Transfer :</h6>
									        </div>
									        <div style="display: none;">
									        	{{! $gmbr = \App\Transaction::where('order_code', $order->code)->first() }}
									        </div>
									        <div class="prev-buktiTransf">
										        @if($gmbr!='')
										        	<img src="/uploads/bukti_pembayaran/{{$gmbr->proof }}">
										        @endif
									        </div>
								    	</div>
								    </div>
								</div>
								<!--End The Modal-->
							</td>
							<td><h6 class="text-semibold">Rp. {{ number_format($o->price_total, '0',',','.') }}</h6></td>
							<td>
								@if($o->status==0)
								<span class="label bg-success-400">Belum Bayar</span>
								@elseif($o->status==1)
								<span class="label bg-info-400">Sudah Bayar</span>
								@elseif($o->status==2)
								<span class="label bg-danger-400">Pembayaran Ditolak</span>
								@elseif($o->status==3)
								<span class="label bg-info-400">Sedang Dikemas</span>
								@elseif($o->status==4)
								<span class="label bg-info-400">Sedang Dikirim</span>
								@elseif($o->status==5)
								<span class="label bg-success-400">Terkirim</span>
								@elseif($o->status==-1)
								<span class="label bg-danger-400">Dibatalkan</span>
								@endif
							</td>
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
						@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<!-- /marketing campaigns -->
	</div>
	<!-- /sales stats -->
</div>
<!-- /Dashboard content -->
@endsection
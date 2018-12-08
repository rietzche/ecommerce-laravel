@extends('layouts.layout_admin')

@section('content')
	<!-- Basic initialization -->
<div class="panel panel-flat">
	<div class="panel-heading">
		<h6 class="panel-title">Daftar Pesanan Pelanggan</h6>
	</div>

	<table class="table datatable-button-print-basic">
		<thead>
			<tr>
				<th>Order Code</th>
				<th>Pelanggan</th>
				<th>Tgl Order</th>
				<th>Bukti Transfer</th>
				<th>Total</th>
				<th>Status</th>
				<th class="text-center">Aksi</th>
				<th class="text-center"><i class="icon-arrow-down12"></i></th>
			</tr>
		</thead>
		<tbody>
			<div style="display: none;">
						{{! $i = 0 }}
			</div>
			@foreach($orders as $order)
			<div style="display: none;">
			{{!! $o = \App\Order::where('code', $order->code)->first() }}
			</div>
			<tr>
				<td>{{$order->code}}</td>
				<td><span class="text-muted">{{ \App\User::find($o->id_user)->name }}</span></td>
				<td>{{ $o->created_at->format('d-m-Y') }}</td>
				<td>
					<a href="javascript::void(0)" data-toggle="modal" data-target="#myModalTerms{{$i}}"><i class="icon-eye"></i> Lihat</a>
					<!-- The Modal -->
					<div class="modal" id="myModalTerms{{$i}}" role="dialog">
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
				<td><h6 class="text-semibold">Rp. {{ number_format(\App\Order::where('code', $order->code)->sum('price_total'), 0, ",", ".") }}</h6></td>
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
					@if($o->status==0)
						<form action="{{ route('pesanan.batal', $order->code) }}" method="POST">
							@csrf
							@method('PUT')
							<input type="submit" class="btn btn-danger btn-sm" value="Batalkan">
						</form>
					@elseif($o->status==1 || $o->status==2)
						<a href="javascript::void(0)" data-toggle="modal" data-target="#Verifikasi{{$i}}" class="btn btn-info btn-sm">Verifikasi</a>
						<!-- The Modal -->
						<div class="modal" id="Verifikasi{{$i}}" role="dialog">
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
							        <div style="margin: 10px">
										<form action="{{ route('pesanan.verif', $order->code) }}" method="POST" class="right">
											@csrf
											@method('PUT')
											<input type="submit" class="btn btn-info btn-sm" value="Terima Pembayaran">
										</form>
										<form action="{{ route('pesanan.tolak', $order->code) }}" method="POST" class="left">
											@csrf
											@method('PUT')
											<input type="submit" class="btn btn-danger btn-sm" value="Tolak Pembayaran">
										</form>
										<div class="clear"></div>
							        </div>
						    	</div>
						    </div>
						</div>
						<!--End The Modal-->
					@elseif($o->status==3)
						<form action="{{ route('pesanan.dikirim', $order->code) }}" method="POST">
							@csrf
							@method('PUT')
							<input type="submit" class="btn btn-info btn-sm" value="Siap Dikirim">
						</form>

					@elseif($o->status==4)
						<form action="{{ route('pesanan.terkirim', $order->code) }}" method="POST">
							@csrf
							@method('PUT')
							<input type="submit" class="btn btn-info btn-sm" value="Terkirim">
						</form>

					@elseif($o->status==5)
						<a href="javascript:void(0)">No action</a>
					@elseif($o->status==-1)
						<a href="javascript:void(0)">No action</a>
					@endif

				</td>
				<td class="text-center">
					@if($o->status!=0 && $o->status!=-1 && $o->status!=1 && $o->status!=2)
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{ route('pesanan.invoice', $order->code) }}"><i class="icon-file-download"></i> Download invoice</a></li>
							</ul>
						</li>
					</ul>
					@endif
				</td>
			</tr>
			<div style="display: none;">
				{{!! $i++ }}
			</div>
			@endforeach
		</tbody>
	</table>
</div>
<!-- /basic initialization -->
@endsection
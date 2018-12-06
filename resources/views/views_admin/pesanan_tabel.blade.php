@extends('layouts.layout_admin')

@section('content')
	<!-- Marketing campaigns -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h6 class="panel-title">Daftar Pesanan Pelanggan</h6>
		</div>

		<div class="table-responsive">
			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>Order ID</th>
						<th>Pelanggan</th>
						<th>Tgl Order</th>
						<th>Bukti Transfer</th>
						<th>Total</th>
						<th>Status</th>
						<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
					</tr>
				</thead>
				<tbody>
					@for($i=1;$i<=3;$i++)
					<tr>
						<td>ORD{{$i}}</td>
						<td><span class="text-muted">Muhammad Yusuf</span></td>
						<td>{{date('d/m/Y')}}</td>
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
								        <div class="prev-buktiTransf">
								        	<img src="/assets/images/placeholder.jpg">
								        </div>
							    	</div>
							    </div>
							</div>
							<!--End The Modal-->
						</td>
						<td><h6 class="text-semibold">Rp. 123.000</h6></td>
						<td><span class="label bg-success-400">Belum Bayar</span></td>
						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="#"><i class="icon-eye"></i> Lihat detail</a></li>
										<li><a href="#"><i class="icon-pencil7"></i> Update</a></li>
									</ul>
								</li>
							</ul>
						</td>
					</tr>
					@endfor
				</tbody>
			</table>
		</div>
	</div>
	<!-- /marketing campaigns -->
@endsection
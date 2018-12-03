@extends('layouts.layout_admin')

@section('content')
	<!-- Marketing campaigns -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h6 class="panel-title">Daftar Penilaian Produk</h6>
		</div>

		<div class="table-responsive">
			<table class="table datatable-basic text-nowrap">
				<thead>
					<tr>
						<th>No</th>
						<th>ID Pelanggan</th>
						<th>ID Barang</th>
						<th>Nilai</th>
						<th>Pesan</th>
						<th>Waktu</th>
						<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
					</tr>
				</thead>
				<tbody>
					@for($i=1;$i<=3;$i++)
					<tr>
						<td>{{$i}}</td>
						<td>CSO{{$i}}</td>
						<td>PSO{{$i}}</td>
						<td>
							<fieldset class="rating-sm">
						       	<input type="radio" id="star5" name="rating" disabled="" value="5" /><label class = "full" for="star5" title="Sangat Baik"></label>
							    <input type="radio" id="star4" name="rating" disabled="" value="4" /><label class = "full" for="star4" title="Baik"></label>
							    <input type="radio" id="star3" name="rating" disabled="" value="3" checked="" /><label class = "full" for="star3" title="Standar"></label>
							    <input type="radio" id="star2" name="rating" disabled="" value="2" /><label class = "full" for="star2" title="Kurang Baik"></label>
							    <input type="radio" id="star1" name="rating" disabled="" value="1" /><label class = "full" for="star1" title="Tidak Baik"></label>
							</fieldset>
							<div class="clear"></div>
							<div class="text-muted">85 reviews</div>
						</td>
						<td>
							<textarea cols="34" rows="3" readonly="">pesan dari customers</textarea>
						</td>
						<td>
							{{date('G:i:s')}}<br>
							{{date('d/m/Y')}}
						</td>
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
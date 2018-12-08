@extends('layouts.layout_admin')

@section('content')
	<!-- Marketing campaigns -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h6 class="panel-title">Daftar Penilaian Produk</h6>
		</div>

		<div class="table-responsive">
			<table class="table datatable-button-print-basic text-nowrap">
				<thead>
					<tr>
						<th>No</th>
						<th>ID Pelanggan</th>
						<th>ID Produk</th>
						<th>Nilai</th>
						<th>Pesan</th>
						<th>Waktu</th>
						<!-- <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th> -->
					</tr>
				</thead>
				<tbody>
					{{! $i=1 }}
					@foreach($ratings as $rating)
					<tr>
						<td>{{$i++}}</td>
						<td>{{$rating->id_user }}</td>
						<td>{{$rating->id_product }}</td>
						<td>
							<fieldset class="rating-sm">
							    <input type="radio" id="star5" value="5" disabled="" {{{ ($rating->rate == 5 ? 'checked' : '') }}}/><label class = "full" for="star5" title="Sangat Baik"></label>
							    <input type="radio" id="star4" value="4" disabled="" {{{ ($rating->rate == 4 ? 'checked' : '') }}}/><label class = "full" for="star4" title="Baik"></label>
							    <input type="radio" id="star3" value="3" disabled="" {{{ ($rating->rate == 3 ? 'checked' : '') }}}/><label class = "full" for="star3" title="Standar"></label>
							    <input type="radio" id="star2" value="2" disabled="" {{{ ($rating->rate == 2 ? 'checked' : '') }}}/><label class = "full" for="star2" title="Kurang Baik"></label>
							    <input type="radio" id="star1" value="1" disabled="" {{{ ($rating->rate == 1 ? 'checked' : '') }}}/><label class = "full" for="star1" title="Tidak Baik"></label>
							</fieldset>
							<div class="clear"></div>
						</td>
						<td>
							<textarea cols="34" rows="3" readonly="">{{ $rating->review }}</textarea>
						</td>
						<td>
							{{ date('G:i:s', strtotime($rating->created_at)) }}<br>
							{{date('d/m/Y', strtotime($rating->created_at))}}
						</td>
						<!-- <td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="#"><i class="icon-eye"></i> Lihat detail</a></li>
										<li><a href="#"><i class="icon-pencil7"></i> Update</a></li>
									</ul>
								</li>
							</ul>
						</td> -->
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- /marketing campaigns -->
@endsection
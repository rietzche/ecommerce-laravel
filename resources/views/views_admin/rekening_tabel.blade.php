@extends('layouts.layout_admin')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<form action="{{ route('rekening.create') }}" method="post">
			@csrf
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Tambah Data Rekening</h5>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="form-group col-sm-6">
							<input type="text" name="nama_bank" required="" placeholder="masukan nama bank" class="form-control">
						</div>
						<div class="form-group col-sm-6">
							<input type="text" name="nama_rekening" required="" placeholder="masukan nama rekening" class="form-control">
						</div>
						<div class="form-group col-sm-6">
							<input type="text" name="cabang" required="" placeholder="masukan cabang" class="form-control">
						</div>
						<div class="form-group col-sm-6">
							<input type="text" name="no_rekening" required="" placeholder="masukan no rekening" class="form-control">
						</div>
						<div class="form-group col-sm-12">
							<input type="submit" value="Tambahkan" class="btn btn-info right">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="col-sm-12">
		<!-- Basic initialization -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Daftar Rekening</h5>
				<div class="heading-elements">
					<ul class="icons-list">
		        		<li><a data-action="reload"></a></li>
		        	</ul>
		    	</div>
			</div>

			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Bank</th>
							<th>Nama Rekening</th>
							<th>Cabang</th>
							<th>No Rekening</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					@if(count($rekenings) != 0)
						{{! $i = 1 }}
						@foreach($rekenings as $rekening)
						<tr>
							<form action="{{ route('rekening.update', $rekening->id) }}" method="post">
								@csrf
								@method('PUT')
								<td>{{$i}}</td>
								<td>
									<input type="text" value="{{ $rekening->nama_bank }}" required="" name="nama_bank" class="form-control">
								</td>
								<td>
									<input type="text" value="{{ $rekening->nama_rekening }}" required="" name="nama_rekening" class="form-control">
								</td>
								<td>
									<input type="text" value="{{ $rekening->cabang }}" required="" name="cabang" class="form-control">
								</td>
								<td>
									<input type="text" value="{{ $rekening->no_rekening }}" required="" name="no_rekening" class="form-control">
								</td>
								<td class="text-center">
									<button type="submit" class="btn btn-info btn-sm"><i class="icon-pencil7"></i> Update</button>
									<a class="btn btn-danger btn-sm"
										onclick="deleteRekening({{ $rekening->id }})">
										<i class="icon-trash"></i> Hapus
									</a>
								</td>
							</form>
						</tr>
						{{! $i++ }}
						@endforeach
					@else
						<tr>
							<td>Not found!</td>
						</tr>
					@endif
					</tbody>
				</table>
			</div>
		</div>
		<!-- /basic initialization -->	
	</div>

	<script>
		function deleteRekening(id){
			var csrf_token = $('meta[name="csrf-token"]').attr('content');
			swal({
				title: "Yakin akan menghapus?",
				text: "Tidak akan dapat mengembalikan lagi!",
				icon: "warning",
				buttons: true,
				dangerMode: true
			}).then((value) => {
				if(value){
					fetch("/admin/rekening/"+id,{
						method: "DELETE",
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
	
</div>

@endsection
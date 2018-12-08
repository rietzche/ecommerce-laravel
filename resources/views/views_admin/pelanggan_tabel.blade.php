@extends('layouts.layout_admin')

@section('content')
	<!-- Marketing campaigns -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h6 class="panel-title">Daftar Pelanggan</h6>
		</div>

		<div class="table-responsive">
			<table class="table datatable-button-print-basic text-nowrap">
				<thead>
					<tr>
						<th>No</th>
						<th class="col-md-2">ID Pelanggan</th>
						<th class="col-md-2">Nama</th>
						<th class="col-md-2">Terdaftar</th>
						<th class="col-md-2">E-mail</th>
						<th class="col-md-2">Riwayat Belanja</th>
						<th class="text-center"><i class="icon-arrow-down12"></i></th>
					</tr>
				</thead>
				<tbody>
					{{!$no=1}}
					@foreach($members as $member)
					<tr>
						<td>{{$no++}}</td>
						<td>CSO{{ $member->id }}</td>
						<td><span class="text-muted">{{ $member->name }}</span></td>
						<td>{{date('d/m/Y', strtotime( $member->created_at ))}}</td>
						<td>{{ $member->email }}</td>
						<td>
							<div style="display: none;">
								{{! $pending = App\Order::where([['id_user', $member->id],['status', 0]])->orWhere([['id_user', $member->id], ['status', 2]])->get() }}
								{{! $process = App\Order::where([['id_user', $member->id], ['status', 1]])->orWhere([['id_user', $member->id], ['status', 3]])->orWhere([['id_user', $member->id], ['status', 4]])->get() }}
								{{! $success = App\Order::where([['id_user', $member->id],['status', 5]])->get() }}
							</div>
							<ul class="list list-unstyled no-margin">
								<li class="no-margin">
									<i class="icon-infinite text-size-base text-warning position-left"></i>
									Pending:
									<a href="#">{{ count($pending) }} orders</a>
								</li>

								<li class="no-margin">
									<i class="icon-spinner2 text-size-base text-success position-left"></i>
									Processed:
									<a href="#">{{ count($process) }}  orders</a>
								</li>

								<li class="no-margin">
									<i class="icon-checkmark3 text-size-base text-success position-left"></i>
									Success:
									<a href="#">{{ count($success) }}  orders</a>
								</li>
							</ul>
						</td>
						<td>
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="#"><i class="icon-eye"></i> Lihat detail</a></li>
										<li><a onclick="deleteUser({{ $member->id }})"><i class="icon-trash"></i> Hapus</a></li>
									</ul>
								</li>
							</ul>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<script>
		function deleteUser(id){
			var csrf_token = $('meta[name="csrf-token"]').attr('content');
			swal({
				title: "Yakin akan menghapus?",
				text: "Tidak akan dapat mengembalikan lagi!",
				icon: "warning",
				buttons: true,
				dangerMode: true
			}).then((value) => {
				if(value){
					fetch("/admin/pelanggan/"+id,{
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
	<!-- /marketing campaigns -->
@endsection
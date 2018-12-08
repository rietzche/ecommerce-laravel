@extends('layouts.layout_admin')

@section('content')
<div class="row">
	<div class="col-sm-4">
		<form action="{{ route('category.create') }}" method="post">
			@csrf
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Tambah Data Kategori</h5>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<input type="text" name="name" required="" placeholder="masukan nama kategori" class="form-control">
					</div>
					<div class="form-group right">
						<input type="submit" value="Tambahkan" class="btn btn-info">
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="col-sm-8">
		<!-- Basic initialization -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Daftar Kategori</h5>
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
							<th>ID Kategori</th>
							<th>Nama Kategori</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					@if(count($categories) != 0)
						{{! $i = 1 }}
						@foreach($categories as $category)
						<tr>
							<form action="{{ route('category.update', $category->id) }}" method="post">
								<td>{{$i}}</td>
								<td>KSO{{$category->id}}</td>
								@csrf
								@method('PUT')
								<td><input type="text" value="{{ $category->name }}" required="" name="name" class="form-control"></td>
								<td class="text-center">
									<button type="submit" class="btn btn-info btn-sm"><i class="icon-pencil7"></i> Update</button>
									<a class="btn btn-danger btn-sm"
										onclick="deleteCategory({{ $category->id }})">
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
		function deleteCategory(id){
			var csrf_token = $('meta[name="csrf-token"]').attr('content');
			swal({
				title: "Yakin akan menghapus?",
				text: "Tidak akan dapat mengembalikan lagi!",
				icon: "warning",
				buttons: true,
				dangerMode: true
			}).then((value) => {
				if(value){
					fetch("/admin/category/"+id,{
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
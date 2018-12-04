@extends('layouts.layout_admin')

@section('content')
	<!-- Basic initialization -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Daftar Produk</h5>
			<a href="/admin/tambah barang" class="btn btn-default btn-sm">Tambah Produk</a>
			<div class="heading-elements">
				<ul class="icons-list">
            		<li><a data-action="reload"></a></li>
            	</ul>
        	</div>
		</div>

		<div class="panel-body">
			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>No</th>
						<th>ID Produk</th>
						<th>Nama Produk</th>
						<th>Kategori</th>
						<th>Harga</th>
						<th>Stok</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					{{! $i = 1 }}
					@foreach($products as $product)
					<tr>
						<td>{{$i}}</td>
						<td>PSO{{$product->id}}</td>
						<td>{{ $product->name }}</td>
						<td>{{ App\Category::find($product->id_category)->name }}</td>
						<td>Rp. {{ $product->price }}</td>
						<td><span class="label label-info">{{ App\Stock::where('id_product', $product->id)->value('stock') }}</span></td>
						<td class="text-center">
							<a href="{{ route('product.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="icon-pencil7"></i> Update</a>
							<a class="btn btn-danger btn-sm"
								onclick="deleteProduct({{ $product->id }})">
									<i class="icon-trash"></i> Hapus
							</a>

								<form id="delete-form-{{ $product->id }}" action="{{ route('product.delete', $product->id) }}" method="POST">
									@csrf
									@method('DELETE')
								</form>
						</td>
					</tr>
					{{! $i++ }}
					@endforeach
				</tbody>
			</table>
		</div>
	<script>
		function deleteProduct(id){
			var csrf_token = $('meta[name="csrf-token"]').attr('content');
			swal({
				title: "Yakin akan menghapus?",
				text: "Tidak akan dapat mengembalikan lagi!",
				icon: "warning",
				buttons: true,
				dangerMode: true
			}).then((value) => {
				if(value){
					fetch("/admin/product/"+id,{
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
	<!-- /basic initialization -->
@endsection
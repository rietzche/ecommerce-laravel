@extends('layouts.layout_admin')

@section('content')

	<h5 class="panel-title">Tambah Data Produk</h5>

	<form action="{{ route('product.create') }}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-body">
						<div class="form-group">
							<label>Nama Produk :</label>
							<input type="text" name="name" class="form-control" required="" placeholder="masukan nama produk">
						</div>

						<div class="form-group">
							<label>Deskripsi Produk :</label>
							<textarea name="description" required="" class="ckeditor" id="ckedtor"></textarea>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-body">
						<div class="row">
							<div class="form-group col-sm-5">
								<label>Kategori :</label>
								<select class="select" name="category" data-placeholder="Pilih Kategori">
									<option></option>
									@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-sm-2">
								<label>Stok :</label>
								<input type="number" name="stock" class="form-control" required="" value="1">
							</div>

							<div class="form-group col-sm-5">
								<label>Harga :</label>
								<div class="input-group">
									<span class="input-group-addon"><b>Rp</b></span>
									<input type="text" name="price" class="form-control" required="" placeholder="">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Gambar Produk :</label>
							<input type="file" accept="image/x-png,image/gif,image/jpeg/*" name="pictures" class="form-control">
							<input type="file" class="file-input-ajax" multiple="multiple">
						</div>

						<!--<div class="form-group">
							<label>Preview Gambar :</label>
						</div> -->					
						<div class="form-group right">
							<a href="{{URL::previous()}}" class="btn btn-danger">Batal</a>
							<input type="submit" value="Tambahkan" class="btn btn-info">
						</div>
					</div>
				</div>
			</div>

		</div>
	</form>
@endsection
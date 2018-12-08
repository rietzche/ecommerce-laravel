@extends('layouts.layout_admin')

@section('content')

	<h5 class="panel-title">Update Data Produk</h5>

	<form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-body">
						<div class="form-group">
							<label>Nama Produk :</label>
							<input type="text" name="name" class="form-control" value="{{ $product->name }}" required="" placeholder="masukan nama produk">
						</div>

						<div class="form-group">
							<label>Deskripsi Produk :</label>
							<textarea name="description" required="" class="ckeditor" id="ckedtor"> {!! $product->description !!} </textarea>
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
									<option value="{{ $category->id }}" {{{ ($category->id == $product->id_category ? 'selected' : '') }}}>{{ $category->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-sm-2">
								<label>Stok :</label>
								<input type="number" name="stock" class="form-control" required="" value="{{ (App\Stock::where('id_product', $product->id))->value('stock') }}">
							</div>

							<div class="form-group col-sm-5">
								<label>Harga :</label>
								<div class="input-group">
									<span class="input-group-addon"><b>Rp</b></span>
									<input type="number" name="price" class="form-control" value="{{ $product->price }}" required="" placeholder="">
								</div>
							</div>
							<div class="form-group col-sm-12">
								<label>Berat :</label>
								<div class="input-group">
									<input type="text" name="weight" class="form-control" required="" placeholder="">
									<span class="input-group-addon"><b>gram</b></span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Gambar Produk :</label>
							<!-- <input type="file" accept="image/*" value="{{ App\Picture::where('id_product', $product->id)->value('picture') }}" name="pictures" class="form-control" onchange="readURL(this);" multiple="multiple"> -->

							<input type="file" value="{{ App\Picture::where('id_product', $product->id)->value('picture') }}"  class="file-input-ajax" name="pictures[]" multiple="multiple" accept="image/*">
							<label class="text-muted">*abaikan jika tidak diganti</label>
						</div>

						<div class="form-group right">
							<a href="{{URL::previous()}}" class="btn btn-danger">Batal</a>
							<input type="submit" value="Simpan" class="btn btn-info">
						</div>
					</div>
				</div>
			</div>

		</div>
	</form>
@endsection
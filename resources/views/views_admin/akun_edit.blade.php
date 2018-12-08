@extends('layouts.layout_admin')

@section('content')
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Pengaturan Akun</h5>
			<hr>
		</div>
		<div class="panel-body">
			<form action="{{ route('admin.update', Auth::user()->id) }}" method="POST">
			@csrf
			@method('PUT')
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" placeholder="Masukan nama admin">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="Masukan email admin">
				</div>
				<div class="form-group">
					<label>Password Baru</label>
					<input type="password" name="password" class="form-control" value="" placeholder="Password Baru">
					<label class="text-muted">*abaikan jika tidak diganti</label>
				</div>
				<div class="right">
					<input type="submit" value="Simpan" class="btn btn-info">
				</div>
			</form>
		</div>
	</div>

@endsection
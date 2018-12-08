@extends('layouts.layout')

@section('content')
<div class="content">
	<div style="width: 50%; margin:0px auto">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Profile</h5>
				<p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
				<hr>
			</div>
			<div class="panel-body">
				<form action="{{ route('user.update', Auth::user()->id) }}" method="POST">
				@csrf
				@method('PUT')
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" placeholder="Masukan nama admin">
					</div>
					<div class="form-group">
						<label>Nomor Telepon</label>
						<input type="numer" name="no_tlp" class="form-control" value="{{ Auth::user()->no_tlp }}" placeholder="Masukan email admin">
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
	</div>
</div>

@endsection
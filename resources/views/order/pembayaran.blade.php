@extends('layouts.layout')

@section('content')
<div class="content">
	<div class="container-fluid pembayaran">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title bold">Total Pembayaran&nbsp;:</h6>
				<h1 class="panel-title" style="color: #ff6600;">Rp. {{ number_format($order->sum('price_total'), 0, ",", ".") }}</h1>
				<p class="text-success">Bayar pesanan sesuai jumlah diatas</p>
				<p class="text-muted">Dicek dalam 24 jam setelah bukti transfer diupload. Diwajibkan untuk membayar sesuai total pembayaran sebelum batas waktu berakhir.</p>
			</div>
		</div>
		<div>
			<div class="bullet-detail">1</div>
			<p class="text-muted">Gunakan ATM / iBanking / mBanking / setor tunai untuk transfer ke rekening Shabby berikut ini:</p>
		</div>
		@if(count($order) != 0)
		{{! $bank = App\Rekening::find($order->first()->bank) }}
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title bold">{{ $bank->nama_bank }}</h6>
				<div style="width: 95%; margin: 0px auto; font-size: 14px; color: #808080">
					<span>No. Rekening&nbsp;:&nbsp;</span><span>{{ $bank->no_rekening }}</span><br>
					<span>Cabang&nbsp;:&nbsp;</span><span>{{ $bank->cabang }}</span><br>
					<span>Nama Rekening&nbsp;:&nbsp;</span><span>{{ $bank->nama_rekening }}</span><br>
				</div>
			</div>
		</div>
		@endif
		<div>
			<div class="bullet-detail">2</div>
			<p class="text-muted">Silakan upload bukti transfer sebelum 23-11-2018</p>
		</div>
		<div>
			<div class="bullet-detail">3</div>
			<p class="text-muted">Demi keamanan transaksi, mohon untuk tidak membagikan bukti atau konfirmasi pembayaran pesanan kepada siapapun, selain mengunggahnya diwebsite Shabby Organizer.</p>
		</div>
		<div>
			<a href="/transaction/{{ $code }}"><div class="btn-upload-bukti1">Upload bukti transfer sekarang</div></a>
			<a href="/belanjaanku"><div class="btn-upload-bukti2">Upload bukti transfer nanti</div></a>
		</div>
	</div>
</div>
@endsection
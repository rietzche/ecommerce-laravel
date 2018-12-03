@extends('layouts.layout')

@section('content')
<div class="content">
	<div class="container-fluid pembayaran">
		<div class="panel panel-flat">
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;"><b>Total Pembayaran : </b></h6>
				<h5 style="float: right; color: #ff6600">Rp. 32.000</h5>
				<div class="clear"></div>
			</div>
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6><b>Informasi Bank : </b></h6>
				<div style="margin: 10px 20px">
					<h6><b>BRI</b></h6>
					<div style="font-size: 14px; color: #808080">
						<span>No. Rekening:&nbsp;112001000159301</span><br>
						<span>Cabang:&nbsp;Slipi</span><br>
						<span>Nama Rekening:&nbsp;Shabby Organizer</span><br>
					</div>
				</div>
			</div>
		</div>
		<div style="margin: 0px 20px">
			<p class="text-muted">Upload foto bukti transfer Anda atau screenshot bukti dari Internet Banking. Shopee akan memeriksa bukti Anda dalam 24 jam.</p>
		</div>
	
	<form action="" method="">
		<div class="panel panel-flat">
			<div style="padding: 10px">
				<h6 class="panel-title bold">Info Rekening Bank</h6>			
			</div>
			<div>
				<!-- Multiple file upload -->
				<div class="panel-body">
					<p class="text-semibold">Upload bukti transfer:</p>
					<div class="dropzone" id="dropzone_multiple" style="width: 260px; margin: 0px auto">
						<input type="file" class="file-input" data-show-caption="false" data-show-upload="false">
					</div>
				</div>
				<!-- /multiple file upload -->
			</div>
		</div>
		<div class="panel panel-flat">
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;">Nama Rekening pengirim</h6>
				<input type="text" name="nm_rekening" style="float: right; width: 70%; border:none; margin-top: 11px" placeholder="Masukan nama pengirim">
				<div class="clear"></div>
			</div>
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;">Transfer dari Bank</h6>
				<input type="text" name="bank_pengirim" style="float: right; width: 70%; border:none; margin-top: 11px" placeholder="Masukan nama bank">
				<div class="clear"></div>
			</div>
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;">Transfer ke Bank </h6>
				<input type="text" name="bank_tujuan" readonly="" style="float: right; width: 70%; border:none; margin-top: 11px" value="BRI">
				<div class="clear"></div>
			</div>
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;">Metode Transfer </h6>
				<select name="metode" style="float: right; width: 70.5%; background: #ffffff; border:none; margin-top: 11px">
					<option selected disabled hidden>Pilih Metode</option>
					<option>Transfer ATM</option>
					<option>iBanking</option>
					<option>mBanking</option>
				</select>
				<div class="clear"></div>
			</div>
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;">Jumlah Ditransfer (Rp) </h6>
				<input type="text" name="jumlah" readonly="" style="float: right; width: 70%; border:none; margin-top: 11px" value="Rp. 32.000">
				<div class="clear"></div>
			</div>
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;">Tanggal Transfer </h6>
				<input type="date" name="tgl_transfer" style="float: right; width: 70%; border:none; margin-top: 11px" value="{{ date('Y-m-d') }}">
				<div class="clear"></div>
			</div>
		</div>

		<div>
			<input type="submit" class="btn-upload-bukti1" style="width: 100%" value="Kirimkan">
			<a href="{{ URL::previous() }}"><div class="btn-upload-bukti2">Batal</div></a>
		</div>
	</form>
	</div>
</div>
@endsection
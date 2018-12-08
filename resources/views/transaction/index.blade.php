@extends('layouts.layout')

@section('content')
<div class="content">

	<form action="{{ route('transaction.create', $code) }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="container-fluid pembayaran">
		<div class="panel panel-flat">
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;"><b>Total Pembayaran : </b></h6>
				<h5 style="float: right; color: #ff6600">Rp. {{ number_format($orders->sum('price_total') + $orders->first()->ongkir, 0, ",", ".") }}</h5>
				<div class="clear"></div>
			</div>
			{{! $order = $orders->first() }}
			{{! $bank = App\Rekening::find($order->bank) }}
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6><b>Informasi Bank : </b></h6>
				<div style="margin: 10px 20px">
					<h6><b>{{ $bank->nama_bank }}</b></h6>
					<div style="font-size: 14px; color: #808080">
						<span>No. Rekening:&nbsp;{{ $bank->no_rekening }}</span><br>
						<span>Cabang:&nbsp;{{ $bank->cabang }}</span><br>
						<span>Nama Rekening:&nbsp;{{ $bank->nama_rekening }}</span><br>
					</div>
				</div>
			</div>
		</div>
		<div style="margin: 0px 20px">
			<p class="text-muted">Upload foto bukti transfer Anda atau screenshot bukti dari Internet Banking. Shopee akan memeriksa bukti Anda dalam 24 jam.</p>
		</div>
	
		<div class="panel panel-flat">
			<div style="padding: 10px">
				<h6 class="panel-title bold">Info Rekening Bank</h6>			
			</div>
			<div>
				<!-- Multiple file upload -->
				<div class="panel-body">
					<p class="text-semibold">Upload bukti transfer:</p>
					<!-- js show image -->
			          	<script type="text/javascript">
			            function readURL(input) {
			              if (input.files && input.files[0]) {
			                var reader = new FileReader();

			                reader.onload = function(e) {
			                  $('#cek-gambar')
			                    .attr('src', e.target.result);
			                };
			                reader.readAsDataURL(input.files[0]);
			              }
			            }
			          	</script>
			          <!--end-->

					<div class="dropzone" id="dropzone_multiple" style="width: 260px; margin: 0px auto">
						<input type="file" name="proof" class="form-control" onchange="readURL(this);" accept="image/*" required="">
			            <img id="cek-gambar" src="#" alt="" width="100%" height="100%">
						<!-- <input type="file" class="file-input" name="proof" multiple="multiple" accept="image/*"> -->
					</div>

			        <div class="form-group">
			        	
			        </div>
				</div>
				<!-- /multiple file upload -->

			</div>
		</div>
		<div class="panel panel-flat">
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;">Nama Rekening pengirim</h6>
				<input type="text" name="sender_name" style="float: right; width: 70%; border:none; margin-top: 11px" placeholder="Masukan nama pengirim" required="">
				<div class="clear"></div>
			</div>
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;">Transfer dari Bank</h6>
				<input type="text" name="bank_from" style="float: right; width: 70%; border:none; margin-top: 11px" placeholder="Masukan nama bank" required="">
				<div class="clear"></div>
			</div>
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;">Transfer ke Bank </h6>
				<input type="text" readonly="" style="float: right; width: 70%; border:none; margin-top: 11px" value="{{ $bank->nama_bank }}" required="">
				<div class="clear"></div>
			</div>
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;">Metode Transfer </h6>
				<select name="method" required="" style="float: right; width: 70.5%; background: #ffffff; border:none; margin-top: 11px">
					<option selected disabled hidden>Pilih Metode</option>
					<option value="atm">Transfer ATM</option>
					<option value="ibanking">iBanking</option>
					<option value="mbanking">mBanking</option>
				</select>
				<div class="clear"></div>
			</div>
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;">Jumlah Ditransfer (Rp) </h6>
				<input type="text" readonly="" required="" style="float: right; width: 70%; border:none; margin-top: 11px" value="Rp. {{ number_format($orders->sum('price_total') + $orders->first()->ongkir, 0, ',', '.') }}">
				<div class="clear"></div>
			</div>
			<div style="padding: 0px 15px; border:1px solid #f2f2f2">
				<h6 style="float: left;">Tanggal Transfer </h6>
				<input type="date" required="" name="transfer_date" style="float: right; width: 70%; border:none; margin-top: 11px" value="{{ date('Y-m-d') }}">
				<div class="clear"></div>
			</div>
		</div>
	

		<div>
			<input type="submit" class="btn-upload-bukti1" style="width: 100%" value="Kirimkan">
			<a href="{{ URL::previous() }}"><div class="btn-upload-bukti2">Batal</div></a>
		</div>
	</div>
	</form>
</div>
@endsection
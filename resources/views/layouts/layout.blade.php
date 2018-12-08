<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Shabby Organizer</title>

		<!-- Global stylesheets -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
		<link href="/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
		<link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="/assets/css/core.css" rel="stylesheet" type="text/css">
		<link href="/assets/css/components.css" rel="stylesheet" type="text/css">
		<link href="/assets/css/colors.css" rel="stylesheet" type="text/css">
		<!-- /global stylesheets -->
		<link rel="stylesheet" type="text/css" href="/css/styleme.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<!-- Core JS files -->
		<script type="text/javascript" src="/assets/js/plugins/loaders/pace.min.js"></script>
		<script type="text/javascript" src="/assets/js/core/libraries/jquery.min.js"></script>
		<script type="text/javascript" src="/assets/js/core/libraries/bootstrap.min.js"></script>
		<script type="text/javascript" src="/assets/js/plugins/loaders/blockui.min.js"></script>
		<!-- /core JS files -->

		<!-- Theme JS files -->
		<script type="text/javascript" src="/assets/js/plugins/ui/prism.min.js"></script>
		<!-- /theme JS files -->

		<!-- Theme JS files -->
		<script type="text/javascript" src="/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
		<script type="text/javascript" src="/assets/js/plugins/forms/selects/select2.min.js"></script>
		<script type="text/javascript" src="/assets/js/pages/form_select2.js"></script>
		<!-- /theme JS files -->

		<!-- Theme JS files -->
		<script type="text/javascript" src="/assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
		<script type="text/javascript" src="/assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
		<script type="text/javascript" src="/assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
		<!-- /theme JS files -->

		<script type="text/javascript" src="/assets/js/core/app.js"></script>
		<script type="text/javascript" src="/assets/js/pages/uploader_bootstrap.js"></script>
   		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
		<!-- sweet_alert -->
		<link rel="stylesheet" href="/assets/sweetalert2/sweetalert2.min.css">
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

		<!-- Style CSS -->
		<link rel="stylesheet" href="/world/style.css">
	
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
  		

	</head>

	<body>	
	<div id="preloader">
		<div class="preload-content">
			<div id="world-load"></div>
		</div>
	</div>
	@include('sweet::alert')
	<!-- Default navbar -->
	<div class="navbar navbar-default navbar-component" style="padding: 15px">
		<div class="navbar-header">
			<a class="navbar-brand" href="">
				<img src="/assets/images/logo.jpg" class="logoSO" alt="">
				<img src="/assets/images/logo_dark.png" alt="">
			</a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-demo1"><i class="icon-grid3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-demo1">
			<ul class="nav navbar-nav">
				<li><a href="/" class="text-info">Beranda</a></li>
				<li><a href="/products" class="text-info">Belanja</a></li>
				<li><a href="/panduan" class="text-info">Panduan</a></li>
				@guest
				@else
				<li> <a href="/belanjaanku" class="text-info">Belanjaanku</a></li>
				@endguest
				<li><a href="/kontak" class="text-info">Kontak</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li>
					<form class="form-search">
						<input type="text" name="q" class="in-search" placeholder="Search here..">	
						<button type="submit" style="outline: none; " class="btn-search"><i class="glyphicon glyphicon-search"></i></button>
						<div class="clear"></div>
					</form>
				</li>
				@guest
				<li>
					<a href="/carts">
						<i class="icon-cart text-info"></i>
						<span class="visible-xs-inline-block position-right text-info">Keranjang</span>
						
					</a>
				</li>
				<li><a href="/login" class="text-info">Login</a></li>
				@else
				<li class="dropdown">
					<a href="#" class="dropdown-toggle text-info" data-toggle="dropdown">{{ Auth::user()->name }}</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#" class="text-info">Profile</a></li>
						<li>
							<a class="text-info" href="{{ route('logout') }}"
								onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</li>
					</ul>
				</li>
				<li><a href="/carts">
						<i class="icon-cart text-info"></i>
						<span class="visible-xs-inline-block position-right text-info">Keranjang</span>
						{{! $carts = App\Cart::all()->where('id_user', Auth::user()->id) }}
						<span class="badge bg-warning-400">{{ count($carts) }}</span>
					</a>
				</li>
				@endguest
			</ul>
		</div>
	</div>
	<!-- /default navbar -->

	<!-- content -->
	@yield('content')
	<!-- content -->


	<footer>
		<div class="center-footer">
			<div class="foot-element capitalize">
				<h6>shabby organizer</h6>
				<ul>
					<li><a href="">bantuan</a></li><br>
					<li><a href="">syarat & ketentuan</a></li><br>
					<li><a href="">tentang kami</a></li><br>
				</ul>
			</div>

			<div class="foot-element capitalize" >
				<h6>layanan pelanggan</h6>
				<ul>
					<li><a href="">panduan</a></li><br>
					<li><a href="">pembayaran</a></li><br>
					<li><a href="">Lacak Pesanan Pembeli</a></li><br>
					<li><a href="">hubungi kami</a></li><br>
				</ul>
			</div>
			
			<div style="padding-top: 40px; float: right;">
				<div style="margin-left: 30px; float: left;">
					<img src="assets/images/logo_dark.png" alt="" style="float: left;width:220px; height:35px">
				</div>

				<div class="foot-element" style="margin-top: -10px; margin-left: 30px">
					<h6>Temukan kami di :</h6>
					<ul class="contact-us">
						<li><a href=""><img src="/assets/images/brands/facebook.png"></a></li>
						<li><a href=""><img src="/assets/images/brands/twitter.png"></a></li>
						<li><a href=""><img src="/assets/images/brands/insta.png"></a></li>
						<li><a href=""><img src="/assets/images/brands/whatsapp.png"></a></li>
						<li><a href=""><img src="/assets/images/brands/gmail.png"></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div style="border-top:1px solid #cccccc; padding: 20px; text-align: center;">
			<p>Copyright &copy; 2018 Granada projects.</p>
		</div>
	</footer>



		<!-- jQuery (Necessary for All JavaScript Plugins) -->
		<script src="/world/js/jquery/jquery-2.2.4.min.js"></script>
		<script src="/world/js/popper.min.js"></script>
		<script src="/world/js/bootstrap.min.js"></script>
		<script src="/world/js/plugins.js"></script>
		<script src="/world/js/active.js"></script>
	</body>
</html>
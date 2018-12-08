
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shabby Organizer - Admin</title>

	<link rel="stylesheet" type="text/css" href="/css/styleme.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>	
	<!-- Core JS files -->
	<script type="text/javascript" src="/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="/assets/js/pages/form_layouts.js"></script>
	<!-- /theme JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="/assets/js/pages/datatables_basic.js"></script>
	<!-- /theme JS files -->

	<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>

	<!-- Theme JS files -->
	<script type="text/javascript" src="/assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
	<script type="text/javascript" src="/assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
	<script type="text/javascript" src="/assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	<!-- /theme JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="/assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
	<script type="text/javascript" src="/assets/js/plugins/tables/datatables/extensions/select.min.js"></script>
	<!-- /theme JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="/assets/js/core/app.js"></script>
	<script type="text/javascript" src="/assets/js/pages/datatables_extension_buttons_print.js"></script>
	<script type="text/javascript" src="/assets/js/pages/uploader_bootstrap.js"></script>
	<script type="text/javascript" src="/assets/js/pages/editor_ckeditor.js"></script>
	<script type="text/javascript" src="/assets/js/pages/layout_fixed_custom.js"></script>
	<!-- /theme JS files -->

	<!-- sweet_alert -->
	<link rel="stylesheet" href="/assets/sweetalert2/sweetalert2.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="navbar-top">
	@include('sweet::alert')

	<!-- Main navbar -->
	<div class="navbar navbar-default navbar-fixed-top header-highlight">
		<div class="navbar-header bg-slate-800">
			<a class="navbar-brand" href="javascript:void(0)">
				<p style="color: #ffffff;font-size: 18px"><b>ADMIN PANEL</b></p>
			</a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="navbar-brand" href="javascript:void(0)"><img src="/assets/images/logo_dark.png" alt=""></a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="/assets/images/placeholder.jpg" alt="">
						<span>{{ Auth::user()->name }}</span>
						<i class="caret"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
						<li>
							<a href="{{ route('logout') }}"
										onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
											<i class="icon-switch2"></i> {{ __('Logout') }}
										</a>

										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main sidebar-fixed bg-slate-700">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="/assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold">Victoria Baker</span>
									<div class="text-size-mini text-muted">
										<i class="icon-pin text-size-small"></i> &nbsp;Santa Ana, CA
									</div>
								</div>

								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<a href="#"><i class="icon-cog3"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible" >
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
								<li {{{ (Request::is('admin/dashboard') ? 'class=active' : '') }}}><a href="/admin/dashboard"><i class="icon-home4"></i><span>Dashboard</span></a></li>
								
								<li>
									<a href="javascript:void(0)"><i class="glyphicon glyphicon-list-alt"></i> <span>Pesanan</span></a>
									<ul>
										<li {{{ (Request::is('admin/tabel pesanan/pending') ? 'class=active' : '') }}}>
											<a href="/admin/tabel pesanan/pending">Pending</a></li>
										<li {{{ (Request::is('admin/tabel pesanan/terbaru') ? 'class=active' : '') }}}>
											<a href="/admin/tabel pesanan/terbaru">Terbaru</a></li>
										<li {{{ (Request::is('admin/tabel pesanan/dikirim') ? 'class=active' : '') }}}>
											<a href="/admin/tabel pesanan/dikirim">Sedang Dikirim</a></li>
										<li {{{ (Request::is('admin/tabel pesanan/terkirim') ? 'class=active' : '') }}}>
											<a href="/admin/tabel pesanan/terkirim">Terkirim</a></li>
										<li {{{ (Request::is('admin/tabel pesanan/dibatalkan') ? 'class=active' : '') }}}>
											<a href="/admin/tabel pesanan/dibatalkan">Dibatalkan</a></li>
									</ul>
								</li>

								<li {{{ (Request::is('admin/tabel pelanggan') ? 'class=active' : '') }}}><a href="/admin/tabel pelanggan"><i class="icon-user-check"></i><span>Pelanggan</span></a></li>
								<li {{{ (Request::is('admin/tabel kategori') ? 'class=active' : '') }}}><a href="/admin/tabel kategori"><i class="glyphicon glyphicon-tag"></i> <span>Kategori</span></a></li>
								<li>
									<a href="javascript:void(0)"><i class="icon-cart-add2"></i> <span>Produk</span></a>
									<ul>
										<li {{{ (Request::is('admin/tambah barang') ? 'class=active' : '') }}}><a href="/admin/tambah barang">Tambah Produk</a></li>
										<li {{{ (Request::is('admin/tabel barang') ? 'class=active' : '') }}}><a href="/admin/tabel barang">Data Produk</a></li>
									</ul>
								</li>
								<li {{{ (Request::is('admin/tabel rekening') ? 'class=active' : '') }}}><a href="/admin/tabel rekening"><i class="fa fa-credit-card"></i> <span>Rekening</span></a></li>
								<li {{{ (Request::is('admin/tabel penjualan') ? 'class=active' : '') }}}><a href="/admin/tabel penjualan"><i class="icon-cart2"></i> <span>Penjualan</span></a></li>
								<li {{{ (Request::is('admin/tabel penilaian') ? 'class=active' : '') }}}><a href="/admin/tabel penilaian"><i class="icon-stars"></i> <span>Penilaian Produk</span></a></li>
								<!-- /Main -->
							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					@yield('content')


					<!-- Footer -->
					<div class="footer text-muted">
						<p class="text-muted">Copyright &copy; 2018 Granada projects.</p>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>

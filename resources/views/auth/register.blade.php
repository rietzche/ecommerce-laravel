@extends('layouts.layout')

@section('content')
<div class="login-container banner" style="margin-top: -20px">
	<!-- Page container -->
	<div class="page-container">
		<!-- Page content -->
		<div class="page-content">
			<!-- Main content -->
			<div class="content-wrapper">
				<!-- Content area -->
				<div class="content pb-20">
					<div style="text-align: center; margin-bottom: 50px">
      					<img src="/assets/images/shabby.png" style="width: 350px; height: 80px;">
					</div>
					<!-- Advanced login -->
					<form method="post" action="/register">
                        @csrf
						<div class="panel panel-body login-form">
							<div class="text-center">
								<h5 class="content-group">Create account <small class="display-block">All fields are required</small></h5>
							</div>

							<div class="content-divider text-muted form-group"><span>Your credentials</span></div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" name="name" placeholder="Nama">
								<div class="form-control-feedback">
									<i class="icon-user-check text-muted"></i>
								</div>
								@if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
								@endif
							</div>
							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" name="no_tlp" placeholder="Nomor handphone">
								<div class="form-control-feedback">
									<i class="icon-phone2 text-muted"></i> 
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="email" class="form-control" name="email" placeholder="Email">
								<div class="form-control-feedback">
									<i class="icon-mention text-muted"></i>
								</div>
								@if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
								@endif
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" name="password" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-user-lock text-muted"></i>
								</div>
								@if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
								@endif
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password">
								<div class="form-control-feedback">
									<i class="icon-user-lock text-muted"></i>
								</div>
							</div>

							<div class="content-divider text-muted form-group"><span>Additions</span></div>
							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" required="" class="styled">
										I Accept <a href="#">terms of service</a>
									</label>
								</div>
							</div>
							<button type="submit" class="btn bg-info btn-block btn-lg">Register <i class="icon-circle-right2 position-right"></i></button>
						</div>
					</form>
					<!-- /advanced login -->
				</div>
				<!-- /content area -->
			</div>
			<!-- /main content -->
		</div>
		<!-- /page content -->
	</div>
	<!-- /page container -->
</div>
@endsection
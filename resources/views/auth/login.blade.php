<html lang="en">
<head>
	<title>Aluswah Mart Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	{{-- icon --}}
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.ico') }}" />

	{{-- Bootstrap --}}
	<link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- iconic --}}
	<link href="{{ asset('vendors/iconic/css/material-design-iconic-font.min.css') }}" rel="stylesheet">

	{{-- fontawesome --}}
	<link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

<!--===============================================================================================-->
<!--===============================================================================================-->
	{{-- <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css"> --}}
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{ asset('images/bg-01.jpg') }}');">
			<div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <span class="login100-form-logo">
						<img src="{{ asset('images/logo.png') }}" alt="">
					</span>


					<span class="login100-form-title p-b-30 p-t-27">
						USWAH MART
					</span>
					@if ($errors->has('username'))
					   <div class="alert alert-danger alert-dismissible fade in" role="alert">
		                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
		                    </button>
		                    {{ $errors->first('username') }}
                  		</div>
				   @endif

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" maxlength="10" type="text" class="form-control" placeholder="Username" autocomplete="off" name="username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" maxlength="35" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>


{{-- jquery --}}
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>

{{-- Bootstrap --}}
<script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>

{{-- login --}}
<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>

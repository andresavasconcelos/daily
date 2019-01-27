@extends('admin.layouts.app')

@section('title', 'Login')

@section('content')
	<section id="wrapper" class="login-register">
		<div class="login-box">
			<div class="white-box">
				<form class="form-horizontal form-material" id="loginform" method="POST" action="{{ url('admin/login') }}">
					{{ csrf_field() }}

					<h3 class="box-title m-b-20">Login</h3>

					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<div class="col-xs-12">
							<input class="form-control form-control-line" type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required autofocus>
						</div>
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<div class="col-xs-12">
							<input class="form-control form-control-line" type="password" name="password" placeholder="Senha" required>
						</div>
						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<div class="col-md-12">
							<div class="checkbox checkbox-primary p-t-0">
								<input id="checkbox-signup" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
								<label for="checkbox-signup"> Lembrar-me</label>
							</div>
						</div>
					</div>

					<div class="form-group text-center m-t-20">
						<div class="col-xs-12">
							<button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">
								Entrar
							</button>
						</div>
					</div>

					<div class="form-group m-b-0">
						<div class="col-sm-12 text-center">
							<a href="{{ url('admin/login/resetar') }}" class="text-primary m-l-5"><b>Esqueceu a senha?</b></a>
						</div>
					</div>
				</form>
			</div>
		</div>

		<footer class="text-center text-white"> 2017 &copy; CuboCommerce por <strong>tmontec</strong></footer>
	</section>
@endsection

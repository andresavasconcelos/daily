@extends('layouts.app')

@section('content')
    <div class="ks-page">
        <div class="ks-header">
            <a href="#" class="ks-logo">CUBO</a>
        </div>

        <div class="ks-body">
            <div class="ks-logo">ECOMMERCE</div>

            <div class="card panel panel-default light ks-panel ks-forgot-password">
                <div class="card-block">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-container" role="form" method="POST" action="{{ route('admin.password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <h4 class="ks-header">
                            Resetar senha
                        </h4>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                <input id="email" type="email" class="form-control form-control-line" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
                                <span class="icon-addon">
                                    <span class="fa fa-at"></span>
                                </span>
                            </div>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                <input id="password" type="password" placeholder="Senha" class="form-control form-control-line" name="password" required>
                                <span class="icon-addon">
                                    <span class="fa fa-key"></span>
                                </span>
                            </div>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                <input id="password-confirm" type="password" placeholder="Confirmar Senha" class="form-control form-control-line" name="password_confirmation" required>
                                <span class="icon-addon">
                                    <span class="fa fa-key"></span>
                                </span>
                            </div>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Resetar senha</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="ks-footer">
            <span class="ks-copyright">&copy; 2017 Cubo</span>
        </div>
    </div>
@endsection

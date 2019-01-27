@extends('admin.layouts.app')

@section('content')
    <section id="wrapper" class="login-register">
        <div class="login-box">
            <div class="white-box">
                <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ url('admin/login/email') }}">
                    {{ csrf_field() }}

                    <h3 class="box-title m-b-20">Esqueceu a senha</h3>
                    <p>Não se preocupe isso acontece as vezes, digite seu e-mail abaixo para receber um link, assim você pode alterar a senha e poderá acessar nosso sistema novamente. :)</p><br />

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control form-control-line" type="email" name="email" placeholder="E-mail" value="{{ $email or old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">
                                Enviar
                            </button>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Lembrou da senha? <a href="{{ url('admin/login') }}" class="text-primary m-l-5"><b>Faça login</b></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <footer class="text-center"> 2017 &copy; CuboCommerce por tmontec</footer>
    </section>
@endsection

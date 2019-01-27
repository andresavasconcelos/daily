@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <main class="page-main">
        <div class="block">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                    <li><a href="{{ url('minha-conta') }}">Minha conta</a></li>
                    <li><span>Acesse sua conta</span></li>
                </ul>
            </div>
        </div>

        @if(URL::previous() == url('/minha-cesta'))
            @php session(['backUrl' => url('/minha-cesta/finalizar-compra/entrega')]); @endphp
        @endif

        <div class="block">
            <div class="container">
                <div class="row row-eq-height">
                    @include('auth.login')

                    <div class="col-sm-6">
                        <div class="form-card acessoCliente">
                            <h4>Cliente novo</h4>

                            <div class="social-buttons">
                                <p>Entre com as redes sociais</p>

                                <a href="{{ url('/auth/facebook') }}" class="btn btn-facebook">
                                    <i class="fa fa-fw fa-facebook"></i>
                                    <span>Facebook</span>
                                </a>
                                <!--<a href="{{ url('/auth/twitter') }}" class="btn btn-twitter">
                                    <i class="fa fa-fw fa-twitter"></i>
                                    <span>Twitter</span>
                                </a>
                                <a href="{{ url('/auth/google') }}" class="btn btn-google">
                                    <i class="fa fa-fw fa-google"></i>
                                    <span>Google</span>
                                </a>-->
                            </div>

                            <p class="register-or"><span>Ou</span></p>

                            <p>Se você ainda não é nosso cliente, cadastre-se e comece hoje mesmo a fazer parte de uma seleta lista de clientes da Fautriz</p>

                            <form class="account-register-email" role="form" method="POST" action="{{ url('minha-conta/registrar/email') }}">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="email">E-mail *</label>
                                    <input id="email" required type="email" class="form-control input-lg m-b-0" name="email">
                                    <span class="error-email_cad text-danger"></span>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-lg btn-register">
                                        <i class="icon icon-user"></i> Quero me cadastrar
                                    </button>
                                    <span class="required-text pull-right">* Campo obrigatório.</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- /Page Content -->
@endsection
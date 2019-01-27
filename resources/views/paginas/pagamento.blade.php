@extends('layouts.app')

@section('style')


@endsection


@section('scripts')

@endsection


@section('content')
    <main class="page-main">
        <div class="block">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                    <li><span>Pagamento</span></li>
                </ul>
            </div>
        </div>
        <div class="container">
            <h3 class="w3ls-title w3ls-title1">Pagamentos</h3>
            <p>Trabalhamos com diversas formas de pagamento.</p>
            <p>Assim que finalizar sua compra, você poderá escolher qual a forma que mais lhe agrada. Demais instruções serão passadas após a escolha da forma de pagamento.</p>
        </div>
    </main>

@endsection
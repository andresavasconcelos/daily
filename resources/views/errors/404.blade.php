@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <main class="page-main">
        <div class="block fullwidth fullheight page_404">
            <div class="container">
                <div class="image-404">
                    <img src="{{ asset('images/404.png') }}" class="img-responsive" style="margin: 50px auto;" alt="404">
                    {{--<div class="text-404">A página não foi encontrada</div>--}}
                </div>
                <div>
                    <a href="javascript:history.back()" class="btn btn-danger">
                        <i class="fa fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
        </div>
    </main>
    <!-- /Page Content -->
@endsection
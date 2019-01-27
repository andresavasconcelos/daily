@extends('layout_site.app')
@section('content')
    <section class="magazine-section my-5">
        <div class="container">
            <div class="row rowTitle">
                <div class="container">
                    <h1>EVENTOS</h1>
                </div>
            </div>
            <div class="row">
                @if(isset($eventoDestaque))
                    @if($eventoDestaque->is_featured != '')
                    <div class="col-lg-6 col-md-12 boxEventoDestaque">
                        <div class="single-news mb-lg-0 mb-4">
                            <div class="view overlay rounded z-depth-1-half mb-4">
                                <img class="img-fluid" src="{{ $eventoDestaque->imagem }}" alt="Sample image">
                                <a>
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <div class="news-data d-flex justify-content-between text-center">
                                <p class="font-weight-bold dark-grey-text"><i class="far fa-clock"></i> {{ $eventoDestaque->data }}</p>
                            </div>
                            <h3 class="font-weight-bold dark-grey-text mb-3"><a>{{ $eventoDestaque->titulo }}</a></h3>
                            <p class="dark-grey-text mb-lg-0 mb-md-5 mb-4">
                                {!! $eventoDestaque->texto !!}
                            </p>
                            @if($eventoDestaque->link != '')
                            <a href="{{ $eventoDestaque->link }}" target="_blank" class="btnComprar">Comprar ingresso</a>
                            @endif
                        </div>
                    </div>
                    @endif
                @endif
                <div class="col-lg-6 col-md-12 boxEventos">
                    @foreach($eventos as $evento)
                    <div class="single-news mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="view overlay rounded z-depth-1 mb-4">
                                    <img class="img-fluid" src="{{ $evento->imagem }}" alt="Sample image">
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                @if($evento->data != '')
                                    <p class="font-weight-bold dark-grey-text">{{ $evento->data }}</p>
                                @endif
                                <p>{{ $evento->titulo }}</p>
                                <div class="d-flex justify-content-between">

                                    @if($evento->resenha != '')
                                    <div class="col-11 text-truncate pl-0 mb-3">
                                        <a href="#" class="dark-grey-text">{{ $evento->resenha }}</a>
                                    </div>
                                    @endif
                                </div>
                                <a href="{{ url('/evento/'.$evento->alias) }}" class="btnSaiba">Saiba mais <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
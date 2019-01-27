@extends('layout_site.app')
@section('content')
    <section class="magazine-section my-5">
        <div class="container">
            <div class="row rowTitle">
                <div class="container">
                    <h1>{{ $evento->titulo }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 {{ $evento->texto == '' ? "offset-3" : ''}} col-md-12 boxEventoDestaque">
                    <div class="single-news mb-lg-0 mb-4">
                        <div class="view overlay rounded z-depth-1-half mb-4">
                            <img class="img-fluid" src="{{ $evento->imagem }}" alt="Sample image">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                        @if($evento->data != '')
                        <div class="news-data d-flex justify-content-between text-center">
                            <p class="font-weight-bold dark-grey-text"><i class="far fa-clock"></i> {{ $evento->data }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 boxEventoDestaque">
                    <p class="dark-grey-text mb-lg-0 mb-md-5 mb-4">
                        {!! $evento->texto !!}
                    </p>
                    @if($evento->link != '')
                        <a href="{{ $evento->link }}" target="_blank" class="btnComprar">Comprar ingresso</a>
                    @endif
                </div>
            </div>
            <div class="row rowGaleria">

                @if(sizeof($evento->eventosGaleria) > 0)
                    <div class="col-12">
                        <h2>GALERIA DE  FOTOS</h2>
                    </div>
                    @foreach($evento->eventosGaleria as $galeria)
                        <div class="col-12 col-lg-3">
                            <div class="boxGaleria">
                                <a href="{{ $galeria->imagem }}" data-fancybox="gallery">
                                    <img src="{{ $galeria->imagem }}" alt="" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection

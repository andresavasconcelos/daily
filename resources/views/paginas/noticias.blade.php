@extends('layout_site.app')
@section('content')
    <section class="blocoSobre">
        <div class="container">
            <div class="row rowTitle">
                <div class="container">
                    <h1>FIQUE POR DENTRO</h1>
                </div>
            </div>

            <div class="row rowPagNoticias">
                <div class="col-12 col-lg-8 mb-30">
                    <a href="{{ url('/noticia/'.$noticiaDestaque->alias) }}">
                        <div class="imgNotDestaque">
                            <img src="{{ $noticiaDestaque->imagem }}" alt="" class="img-fluid">
                            <div class="blockTitleNoticia">
                                <h2 class="text-left">{{ $noticiaDestaque->titulo }}</h2>
                            </div>
                        </div>
                    </a>
                </div>

                @foreach($noticias as $key => $noticia)
                    @if($key == 0 || $key > 1)
                    <div class="col-12 col-lg-4">
                        <div class="row">
                    @endif

                            <div class="col-12 col-lg-12 mb-30">
                                <a href="{{ url('/noticia/'.$noticia->alias) }}">
                                    <div class="imgNoticia" >
                                        <img src="{{ $noticia->imagem }}" alt="" class="img-fluid">
                                        <div class="blockTitleNoticia">
                                            <h2 class="text-left">{{ $noticia->titulo }}</h2>
                                            {{--<p>{!! str_limit($noticia->descricao, $limit = 150, $end = '...') !!}</p>--}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                    @if($key >= 1)
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
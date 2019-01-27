@extends('layout_site.app')
@section('content')
    <section>
        <div class="container">
            <div class="row rowTitle">
                <div class="container">
                    <h1 class="mb-2">{{ $noticia->titulo }}</h1>
                </div>
            </div>
            <div class="row rowSocial mb-4">
                <div class="col-12 col-lg-4 offset-lg-4 col-md-6 offset-md-3 socialList">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <p><i class="fas fa-share-alt"></i> Compartilhe: </p>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('noticia/'.$noticia->alias) }}" class="icon icon-facebook-logo facebook" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="http://twitter.com/share?text={{ $noticia->title }}&url={{ url('noticia/'.$noticia->alias) }}" class="icon icon-twitter-logo twitter" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://plus.google.com/share?url={{ url('noticia/'.$noticia->alias) }}" class="icon icon-google google" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><i class="fab fa-google-plus-g"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url('noticia/'.$noticia->alias) }}&title={{ $noticia->title }}&summary={{ $noticia->meta_description }}&source=Depósito da Lingerie - Valorize sua intimidade" class="icon icon-pinterest pinterest" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row rowNotInterna">
                <div class="col-12">
                    <div class="col-12 col-lg-5 float-left mb-3">
                        <img src="{{ $noticia->imagem }}" alt="" class="img-fluid">
                    </div>
                    {!! $noticia->descricao !!}
                </div>
            </div>
            <div class="row rowGaleria">
                @if(sizeof($noticia->noticiasGaleria) > 0)
                    <div class="col-12">
                        <h2>GALERIA DE  FOTOS</h2>
                    </div>
                    @foreach($noticia->noticiasGaleria as $notGaleria)
                        <div class="col-12 col-lg-3">
                            <div class="boxGaleria">
                                <a href="{{ $notGaleria->imagens }}" data-fancybox="gallery">
                                    <img src="{{ $notGaleria->imagens }}" alt="" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
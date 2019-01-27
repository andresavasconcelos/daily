@extends('layout_site.app')
@section('content')
    <section>
        <div class="container">
            <div class="row rowTitle">
                <div class="container">
                    <h1 class="mb-0">{{ $materia->titulo }}</h1>
                </div>
            </div>
            <div class="row rowSocial mb-4 mt-2">
                <div class="col-12 col-lg-4 offset-lg-4 col-md-6 offset-md-3 socialList">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <p><i class="fas fa-share-alt"></i> Compartilhe: </p>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('materia/'.$materia->alias) }}" class="icon icon-facebook-logo facebook" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="http://twitter.com/share?text={{ $materia->title }}&url={{ url('materia/'.$materia->alias) }}" class="icon icon-twitter-logo twitter" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://plus.google.com/share?url={{ url('materia/'.$materia->alias) }}" class="icon icon-google google" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><i class="fab fa-google-plus-g"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url('materia/'.$materia->alias) }}&title={{ $materia->title }}&summary={{ $materia->meta_description }}&source=Depósito da Lingerie - Valorize sua intimidade" class="icon icon-pinterest pinterest" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row rowNotInterna">
                <div class="col-12">
                    @if($materia->imagem != '')
                    <div class="col-12 col-lg-5 float-left mb-3 text-center">
                        <img src="{{ $materia->imagem }}" alt="" class="img-fluid">
                    </div>
                    @endif
                    {!! $materia->conteudo !!}
                </div>
            </div>
            {{--<div class="row">--}}
                {{--@foreach($materia->noticiasGaleria as $materiaInterna)--}}
                    {{--<div class="col-2">--}}
                        {{--<img src="{{ $materiaInterna->imagens }}" alt="" class="img-fluid">--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        </div>
    </section>
@endsection
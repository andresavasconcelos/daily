@extends('layout_site.app')
@section('content')
    <section class="blocoSobre">
        <div class="container">
            <div class="row rowTitle">
                <div class="container">
                    <h1>MATÉRIAS</h1>
                </div>
            </div>

            <div class="row rowPagNoticias">
                @foreach($materias as $materia)
                    <div class="col-12 col-lg-4 mb-30">
                        <a href="{{ url('/materia/'.$materia->alias) }}">
                            <div class="imgNoticia" >
                                @if($materia->imagem != '')
                                <img src="{{ $materia->imagem }}" alt="" class="img-fluid">
                                @else
                                <img src="{{ asset('images/semfoto.png') }}" alt="" class="img-fluid">
                                @endif
                                <div class="blockTitleNoticia">
                                    <h2 class="text-left">{{ $materia->titulo }}</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
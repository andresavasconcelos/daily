@extends('layout_site.app')

@section('content')
    <section class="blocoSobre">
        {{--MODAL REVISTAS--}}
        <div class="modal fade" id="modalRevistas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">ASSINE JÁ</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="container">
                            <div class="row rowAssinaturas" id="assinaturas">
                                {{--<div class="col-lg-4 col-md-4 col-12">--}}
                                {{--<img src='{{ asset('/images/revista/'.$revistas->imagem) }}' class='img-fluid' alt=''>--}}
                                {{--</div>--}}
                                <div class="col-lg-12 col-md-12 col-12 chamadaAssinaturas">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-2">
                                            <img src="{{ asset('/images/e_logo.png') }}" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-lg-9 col-md-10">
                                            <h2>
                                                Não perca as novidades da Empreenda Revista e assine já !
                                            </h2>
                                            <p>Aproveite! <span>50% de desconto</span> em todas assinaturas</p>
                                        </div>
                                        <div class="col-lg-4 offset-lg-4 mt-3 col-md-4">
                                            <img src="{{ asset('/images/pagseguro.png') }}" alt="" class="img-fluid float-right">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="row">
                                            @foreach($assinaturas as $assinatura)
                                                <div class=" col-lg-4 col-md-4 col-12 text-center">
                                                    <h3>{{ $assinatura->nome }}</h3>
                                                    <h6><strike>{{ \Cknow\Money\Money::BRL($assinatura->preco_inicial)->format('BRL', null, \NumberFormatter::CURRENCY) }}</strike></h6>
                                                    <h5>COM DESCONTO DE {{ $assinatura->desconto }}%</h5>
                                                    <h4>{{ \Cknow\Money\Money::BRL($assinatura->valor)->format('BRL', null, \NumberFormatter::CURRENCY) }}</h4>
                                                    <a href='{{ url('/assinaturas/'.$assinatura->code) }}' class='btn btn-warning btn-back btn-noticia' role='button'>Assinar</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row rowTitle">
                <div class="container">
                    <h1>REVISTAS</h1>
                </div>
            </div>
            {{--<div class="row rowCarouselRevistas">--}}
                {{--<div class="carouselRevistas">--}}
                    {{--<ul>--}}
                        {{--@foreach($revistas as $revista)--}}
                            {{--<li>--}}
                                {{--<img src="{{ asset('/images/revista/'.$revista->imagem) }}" alt="" class="img-fluid">--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="row rowTodasRevistas">
                @foreach($revistas as $revista)
                    <div class="col-lg-2 col-12">
                        <a href="" data-toggle="modal" data-target="#modalRevistas" >
                            <img src="{{ asset('/images/revista/'.$revista->imagem) }}" class="img-fluid" alt="{{ $revista->titulo }}">
                        </a>
                        <h2>
                            <a href="#">Edição {{ $revista->titulo }}</a>
                        </h2>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
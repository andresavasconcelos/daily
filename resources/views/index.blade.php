@extends('layout_site.app')

@section('content')

    @foreach($revistas as $key => $revista)
        <div class="modal fade modalEdicao" tabindex="-1" role="dialog" id="modalEdicao{{ $revista->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Edição {{ $revista->titulo }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        {!! $revista->descricao !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <section class="sectionHome">
        <!--***CAROUSEL***-->
        <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-1z" data-slide-to="1"></li>
                <li data-target="#carousel-example-1z" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <a href="{{ url('/assineja') }}">
                        <img class="d-block w-100" src="{{ asset('/images/banner/banner_empreenda2.png') }}" alt="First slide">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="{{ url('images/midia kit_2019.pdf') }}" target="_blank">
                        <img class="d-block w-100" src="{{ asset('/images/banner/banner_anuncie.png') }}" alt="Second slide">
                    </a>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('/images/banner/app.png') }}" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!--********************CONTEÚDO*********************-->

        <!--***REVISTAS TIMELINE***-->
        <div class="container">
            <div class="wrapper">
                <div class="connected-carousels">
                    <div class="stage">
                        <div class="carousel carousel-stage">
                            <ul class="itens">
                                @foreach($revistas as $key => $value)
                                    <li class="item-jcarousel">
                                        <div class="row rowBoxRevistas">
                                            <div class="col-12 col-lg-3 imgLinhaTempo">
                                                <img src="{{ asset('/images/revista/'.$value->imagem) }}" alt="First slide" class="img-fluid">
                                            </div>
                                            <div class="col-12 col-lg-4 offset-lg-1 textLinhaTempo">
                                                <h2>Edição <span>{{ $value->titulo }}</span></h2>
                                                <p>{!! str_limit($value->descricao, 300, '...') !!}</p>
                                                <a href="#" data-toggle="modal" data-target="#modalEdicao{{ $value->id }}" class="btnLeia">
                                                    Leia mais >>
                                                </a>
                                            </div>
                                            <div class="col-12 col-lg-4 areaDestaques">
                                                <ul>
                                                    @if(count($value->materia) > 0)
                                                    <h2 class="tituloDestaques">DESTAQUES</h2>
                                                    @foreach($value->materia as $k => $materia)

                                                        @if($materia->is_featured == 1)
                                                        <li>
                                                            <a href="{{ url('/materia/'.$materia->alias) }}">
                                                                <h2>{{ $materia->titulo }}</h2>
                                                                <p style="color: #000;">{{ $materia->resenha }}</p>
                                                            </a>
                                                        </li>
                                                        @endif

                                                    @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="#" class="prev prev-navigation setasRevistasMobile d-block d-lg-none d-sm-none">&lsaquo;</a>
                        <a href="#" class="next next-navigation setasRevistasMobile d-block d-lg-none d-sm-none">&rsaquo;</a>
                    </div>
                    <div class="row rowOutrasEdicoes d-none d-lg-block d-sm-block">
                        <div class="col-12 text-center">
                            <h2>OUTRAS EDIÇÕES</h2>
                        </div>
                    </div>
                    <div class="navigation d-none d-lg-block d-sm-block">
                        <a href="#" class="prev prev-navigation">&lsaquo;</a>
                        <a href="#" class="next next-navigation">&rsaquo;</a>
                        <div class="carousel carousel-navigation">
                            <ul>
                                @foreach($revistas as $key => $value)
                                    <li>
                                        <span class="linhaProgresso"></span>
                                        <span class="mesesRevista">{{ $value->titulo }}</span>
                                        <span class="bolinhaLaranja"></span>
                                        <span class="barrinhaLaranja"></span>
                                        <img src="{{ asset('/images/revista/'.$value->imagem) }}" width="50" height="50" alt="">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--***ANUNCIANTES***-->
        <div class="container-fluid">
            <div class="row rowPropaganda">
                <div class="container">
                    <a href="http://www.tmontec.com.br" target="_blank">
                        <img src="{{ asset('images/banner/banner_tmontec.png') }}" alt="" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>

        <!--***CENTRAL DO EMPREENDEDOR<***-->
        <div class="container-fluid">
            <div class="row rowTitleNot">
                <div class="container">
                    <h1 class="text-left"><strong>Eventos</strong></h1>
                </div>
            </div>
        </div>

        <div class="container">
            {{--<div class="row rowNoticiasEmp">--}}
                {{--<div class="container">--}}
                    {{--<ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">--}}
                        {{--//foreach aqui--}}
                        {{--@foreach($categorias as $key => $categoria)--}}
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="politica-tab" data-toggle="tab" href="#{{ $categoria->alias }}" role="tab" aria-controls="{{ $categoria->alias }}" aria-selected="true">{{ $categoria->titulo }}</a>--}}
                        {{--</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="row">
                <div class="container">
                    <div class="row abaNoticias">
                        @foreach($eventos as $evento)
                            <div class="col-md-4 col-lg-4">
                                <a href="{{ url('/evento/'.$evento->alias) }}">
                                    <div class="divImgEvento">
                                        <img src="{{ $evento->imagem }}" alt="" class="img-fluid">
                                    </div>
                                    <div class="blockTitleNoticia">
                                        <h2 class="text-left">{{ $evento->titulo }}</h2>
                                        {{--<p>{{ $evento->resenha }}</p>--}}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{--<div class="tab-content abaNoticias" id="myTabContent">--}}

                        {{--@foreach($categorias as $key => $categoria)--}}
                            {{--@php--}}
                                {{--$noticiasEmp = \App\Categoria::getNoticias($categoria->id);--}}
                            {{--@endphp--}}
                        {{--<div class="tab-pane fade show {{ $key == 0 ? 'active' : '' }} text-center" id="{{ $categoria->alias }}" role="tabpanel" aria-labelledby="{{ $categoria->alias }}-tab">--}}

                            {{--<img src="{{ asset('images/imgnoticia.png') }}" alt="" class="img-fluid w-100">--}}
                            {{--<h2 class="text-left">Lorem Ipsum is simply dummy text of the: </h2>--}}
                            {{--<p>Printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the.</p>--}}
                            {{--<div class="container">--}}
                                {{--<div class="row rowAllNoticias">--}}
                                    {{--@foreach($noticiasEmp as $noticiaEmpreendedorismo)--}}
                                        {{--<div class="col-md-4">--}}
                                            {{--<a href="{{ url('/noticia_empreendedorismo/'.$noticiaEmpreendedorismo->alias) }}">--}}
                                                {{--<img src="{{ $noticiaEmpreendedorismo->imagem }}" alt="" class="img-fluid">--}}
                                                {{--<div class="blockTitleNoticia">--}}
                                                    {{--<h2 class="text-left">{{ $noticiaEmpreendedorismo->titulo }}</h2>--}}
                                                    {{--<p>{{ $noticiaEmpreendedorismo->resenha }}</p>--}}
                                                {{--</div>--}}
                                            {{--</a>--}}
                                        {{--</div>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>

        <!--***ANUNCIANTES***-->
        <div class="container-fluid">
            <div class="row rowPropaganda">
                <div class="container">
                    <a href="http://www.impactographics.com.br/" target="_blank">
                        <img src="{{ asset('images/banner/banner_impact.jpg') }}" alt="" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>

        <!--***VIDEOS***-->
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="col-12">
                        <div class="row rowVideosCanal">
                            <div class="col-12 mb-3">
                                <img src="{{ asset('images/conexao_empreenda.png') }}" alt="" class="img-fluid">
                            </div>
                            <div class="col-12 col-lg-9 col-md-9 divIframeVideo">
                                <iframe width="100%" height="100%" src="https://www.youtube-nocookie.com/embed/videoseries?list=PLRVv9SDh56syGgjoYs43eOwkgk1iQRa6N" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <div class="col-12 col-lg-3 col-md-3">
                                <a  href="/contato" data-toggle="modal" data-target="#modalContato" class="text-center d-block">
                                    <img src="{{ asset('images/banner/anuncie_pequeno.png') }}" alt="" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--***ANUNCIANTES***-->
        <div class="container-fluid">
            <div class="row rowPropaganda">
                <div class="container">
                    <a href="/contato" data-toggle="modal" data-target="#modalContato">
                        <img src="{{ asset('images/banner/banner_anuncie.jpg') }}" alt="" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>

        <!--***ASSINATURAS***-->
        <div class="container">
            <div class="container-fluid">
                <div class="row rowTitleNot">
                    <div class="container">
                        <h1 class="text-center">ASSINATURA</h1>
                    </div>
                </div>
            </div>
            <div class="row rowAssinaturas" id="assinaturas">
                <div class="col-lg-4 col-md-4 col-12">
                    <img src='{{ asset('/images/revista/'.$revista->imagem) }}' class='img-fluid' alt=''>
                </div>
                <div class="col-lg-7 col-md-7 offset-md-1  offset-lg-1 col-12 chamadaAssinaturas">
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
                                    {{--<h4>{{ money((int)$assinatura->valor, 'BRL') }}</h4>--}}
                                    <h4>{{ \Cknow\Money\Money::BRL($assinatura->valor)->format('BRL', null, \NumberFormatter::CURRENCY) }}</h4>
                                    <a href='{{ url('/assinaturas/'.$assinatura->code) }}' class='btn btn-warning btn-back btn-noticia' role='button'>Assinar</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--***MODAL NEWS***-->
        {{--<div class="modal fade left" id="modalNews" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
            {{--<div class="modal-dialog modal-side modal-top-left" role="document">--}}
                {{--<div class="modal-content">--}}
                    {{--<div class="modal-header">--}}
                        {{--<h4 class="modal-title w-100" id="myModalLabel">Receba nossas Novidades</h4>--}}
                        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                            {{--<span aria-hidden="true">&times;</span>--}}
                        {{--</button>--}}
                    {{--</div>--}}
                    {{--<div class="modal-body">--}}
                        {{--...--}}
                    {{--</div>--}}
                    {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                        {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    </section>

@endsection
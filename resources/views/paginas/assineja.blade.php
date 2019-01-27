@extends('layout_site.app')
@section('content')
    <section class="blocoSobre">
        <div class="container">
            <div class="row rowTitle">
                <div class="container">
                    <h1>ASSINATURA</h1>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <h3 class="text-left">VOCÊ ESTÁ PREPARADO PARA FAZER PARTE DA COMUNIDADE DE EMPREENDEDORES QUE IRÃO MUDAR O MUNDO?</h3>
                    <p>Se você empreende ou pretende empreender, e quer fazer parte dessa transformação que os empreendedores irão fazer no mundo, ter uma revista com conteúdos que podem ser aplicados ao seu negócio, escrito por pessoas renomadas no mercado e que entendem de empreendedorismo faz toda a diferença em sua jornada.</p>
                    <h3 class="text-left">VEJA AS VANTAGENS DE ASSINAR A EMPREENDA REVISTA</h3>
                    <ul>
                        <li>Clube Empreenda de Vantagens, cupons de desconto nos eventos produzidos pela Empreenda Revista, cupons de desconto em empresas parceiras.</li>
                        <li>Conteúdo exclusivo para assinante da revista, vídeos e entrevistas com as principais personalidades do empreendedorismo nacional.</li>
                        <li>Os melhores colunistas escrevendo sobe empreendedorismo para você.</li>
                    </ul>
                    <h3 class="mb-5 text-left">ASSINE AGORA COMECE A LER SUA REVISTA</h3>
                </div>
            </div>
            <div class="container">
                <div class="row rowAssinaturas" id="assinaturas">
                    <div class="col-lg-4 col-12">
                        <img src='{{ asset('/images/revista/'.$revista->imagem) }}' class='img-fluid' alt=''>
                    </div>
                    <div class="col-lg-7 offset-lg-1 col-12 chamadaAssinaturas">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="{{ asset('/images/e_logo.png') }}" alt="" class="img-fluid">
                            </div>
                            <div class="col-lg-9">
                                <h2>
                                    Não perca as novidades da Empreenda Revista e assine já !
                                </h2>
                                <p>Aproveite! <span>50% de desconto</span> em todas assinaturas</p>
                            </div>
                            <div class="col-lg-4 offset-lg-4 mt-3">
                                <img src="{{ asset('/images/pagseguro.png') }}" alt="" class="img-fluid float-right">
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="row">
                                @foreach($assinaturas as $assinatura)
                                    <div class=" col-lg-4 col-12 text-center">
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

        </div>
    </section>
@endsection
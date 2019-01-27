@extends('layout_site.app')
@section('content')
    <section class="blocoSobre">
        <div class="container">
            <div class="row rowTitle">
                <div class="container">
                    <h1>CONFIRMAÇÃO DE PAGAMENTO</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8 md-offset-2 offset-lg-2 text-center">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Parabéns!</h4>
                        <p>Seu pedido foi realizado com sucesso, após a aprovação do pagamento, entraremos em contato.</p>
                        <hr>
                        <p class="mb-0">Obrigado por fazer parte do nosso seleto clube de empreendedores!</p>
                    </div>
                    @if($assinatura->url_boleto != '' && $assinatura->url_boleto != Null)
                        <a href="{{ $assinatura->url_boleto }}" target="_blank" class="btn btn-success">Visualizar boleto</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO -->
    {!! SEO::generate(false) !!}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('images/favico.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="{{ asset('lib/fancybox/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('lib/bxslider/jquery.bxslider.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('/css/_connected_carousel.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('/lib/jcarousel/jcarousel.connected-carousels.css') }}">
    <link rel="stylesheet" href="{{ asset('/lib/jcarousel/style_jcarousel.css') }}">
    <link rel="stylesheet" href="{{ asset('/lib/jcarousel/jcarousel.basic.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css?').time() }}">

    @yield('style')

    {{--<!-- Scripts -->--}}
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.2';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!--MENU-->
<header>
    <div class="container containerMenu">
        <div class="row">
            <div class="col-12 col-lg-3 offset-lg-9 float-right">
                <a href="{{ url('/assineja') }}" class="btnAssine" id="btnAssine">ASSINE JÁ</a>
                <ul class="list-inline float-right mb-0 ulredes">
                    <li class="list-inline-item">
                        <a href="https://wa.me/5511996328813?text=Olá!%20Venho%20através%20do%20site!" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://www.instagram.com/empreendarevista/" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://www.facebook.com/Empreendarevista/" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://twitter.com/empreendarev?lang=en" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <a class="navbar-brand d-none d-md-block d-lg-block" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid">
            </a>
            <nav class="navbar navbar-expand-lg navbar-light bg-light ml-auto">
                <div class="container">
                    <a class="navbar-brand d-block d-md-none d-lg-none" href="#">
                        <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid">
                    </a>
                    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a href="{{ url('/assineja') }}" class="btnAssine btnAssineMobile d-block d-lg-none d-md-none" id="btnAssine">ASSINE JÁ</a>

                    {{--<div class="areaAppMobile">--}}
                        {{--<ul class="list-inline">--}}
                            {{--<li class="list-inline-item"><p>Baixe o app</p></li>--}}
                            {{--<li class="btnPlayStore list-inline-item">--}}
                                {{--<a href="" class=""><img src="{{ asset('/images/logo_appstore.png') }}" alt=""></a>--}}
                            {{--</li>--}}
                            {{--<li class="btnAppStore list-inline-item">--}}
                                {{--<a href="" class=""><img src="{{ asset('/images/applestore.png') }}" alt=""></a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    <a class="btnApp" href="" target="_blank">
                        <img src="" alt="" class="img-fluid">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="logoE d-none d-lg-block">
                                <img src="{{ asset('images/e_logo.png') }}" alt="" class="img-fluid">
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-home"></i> HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/sobre') }}">A EMPRENDA</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/materias') }}">MATÉRIAS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/revistas') }}">REVISTAS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/noticias') }}">FIQUE POR DENTRO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/eventos') }}">EVENTOS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contato" data-toggle="modal" data-target="#modalContato">CONTATO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://blog.empreendarevista.com.br/" target="_blank">BLOG</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="appEmpreenda text-center d-none d-lg-block d-md-block">
        <a href="https://play.google.com/store/apps/details?id=social.hallo.android.empreendarevista" target="_blank">
            <img src="{{ asset('images/logo_appstore.png') }}" alt="">
        </a>
        <a href="https://itunes.apple.com/br/app/empreenda-revista/id1443517671?mt=8" target="_blank">
            <img src="{{ asset('images/applestore.png') }}" alt="">
        </a>
    </div>
</header>
<!--FIM MENU-->


{{--MODAL CONTATO--}}
<div class="modal fade" id="modalContato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">CONTATO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <form action="{{ url('/contato') }}" method="post" id="formContato">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="md-form mb-2">
                                <i class="fa fa-user prefix grey-text"></i>
                                <input type="text" id="nomeContato" class="form-control validate" name="nome">
                                <label data-error="wrong" data-success="right" for="nome">Nome</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="md-form mb-2">
                                <i class="fa fa-envelope prefix grey-text"></i>
                                <input type="email" id="emailContato" class="form-control validate" name="email">
                                <label data-error="wrong" data-success="right" for="email">Email</label>
                            </div>
                        </div>
                    </div>

                    <div class="row rowTels">
                        <div class="col-lg-6 col-12">
                            <div class="md-form">
                                <i class="fas prefix fa-phone-volume"></i>
                                <input type="text" id="telefoneContato" class="form-control validate tel" name="telefone">
                                <label data-error="wrong" data-success="right" for="telefone">Telefone</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="md-form">
                                <i class="fas prefix fa-mobile-alt"></i>
                                <input type="text" id="celularContato" class="form-control validate cel" name="celular">
                                <label data-error="wrong" data-success="right" for="celular">Celular</label>
                            </div>
                        </div>
                    </div>

                    <div class="md-form mb-2">
                        <i class="fa fa-tag prefix grey-text"></i>
                        <input type="text" id="assunto" class="form-control validate" name="assunto">
                        <label data-error="wrong" data-success="right" for="assunto">Assunto</label>
                    </div>

                    <div class="md-form">
                        <i class="fa fa-pencil prefix grey-text"></i>
                        <textarea type="text" id="mensagem" class="md-textarea form-control" rows="2" name="mensagem"></textarea>
                        <label data-error="wrong" data-success="right" for="mensagem">Mensagem</label>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <div class="contact-notif"></div>
                    </div>
                    <div class="d-flex justify-content-center btn-rounded mb-2 btnEnviar">
                        <button class="btn" type="submit">Enviar <i class="fa fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@yield('content')

<!--FOOTER-->
<footer>
    <div class="container-fluid">
        <div class="row rowFooter">
            <div class="container">
                <div class="row rowLogoFooter">
                    <div class="col-md-4 col-lg-4 logoFooter">
                        <img src="{{ asset('/images/logo_footer2.png') }}" alt="" class="img-fluid">
                        <p>O nosso propósito é orientar o Empreendedor ao Sucesso! Tornando se a conexão entre o Empreendedor e os conteúdos necessários para superar os desafios diários.</p>
                    </div>
                    <div class="col-lg-4 col-md-4 redesSociais text-center">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="https://wa.me/5511996328813?text=Olá!%20Venho%20através%20do%20site!" target="_blank"><i class="fab fa-whatsapp"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.instagram.com/empreendarevista/" target="_blank"><i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.facebook.com/Empreendarevista/" target="_blank"><i class="fab fa-facebook"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://twitter.com/empreendarev?lang=en" target="_blank"><i class="fab fa-twitter"></i>
                                </a>
                            </li>
                        </ul>
                        <p>Acompanhe-nos em nossas <strong>REDES SOCIAIS</strong> <br />fique por dentro das novidades, e receba tudo em seu email</p>
                    </div>
                    <div id="fbSlot" class="col-lg-4 col-md-4">
                        <div class="fb-page" data-href="https://www.facebook.com/Empreendarevista" data-tabs="timeline" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Empreendarevista" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Empreendarevista">Empreenda Revista</a></blockquote></div>
                    </div>
                </div>
                {{--<div class="row rowNewsletter">--}}
                    {{--<div class="col-lg-6 col-md-6">--}}
                        {{--<div class="input-group mb-3">--}}
                            {{--<div class="input-group-prepend">--}}
                                {{--<span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>--}}
                            {{--</div>--}}
                            {{--<input type="email" class="form-control" placeholder="EMAIL" aria-label="email" aria-describedby="basic-addon1">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="row rowCopyright">
            <div class="container">
                <p class="text-center">Copyright 2018 Empreenda revista | Todos os direitos reservados | Desenvolvido por:
                    <a href="http://tmontec.com.br/" target="_blank">
                        <img src="{{ asset('/images/logoTmontec_branco.png') }}" alt="" class="img-fluid">
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>
<!--FIM FOOTER-->

<!-- Scripts -->
<script type="text/javascript" src="{{ asset('lib/mdb/js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('lib/fancybox/jquery.fancybox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('lib/notifyjs/notify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('lib/carousel/js/Carousel.js') }}"></script>
<script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>
<script type="text/javascript" src="{{ asset('js/app.js?').time() }}"></script>
<script type="text/javascript" async src="https://d335luupugsy2.cloudfront.net/js/loader-scripts/38b063a1-bf35-4a71-b8b5-f32dc0d9a496-loader.js" ></script>
@if(str_contains(Request::url(), '/assinaturas/'))
    <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script type="text/javascript" src="{{ asset('js/pagseguro.js') }}"></script>
    <script>

        $(window).resize(function () {
            $('#fbSlot div').remove();

            $('<div class="fb-page" data-href="https://www.facebook.com/Empreendarevista" data-tabs="timeline" data-width="340" data-height="20" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Empreendarevista" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Empreendarevista">Empreenda Revista</a></blockquote></div>').appendTo($('#fbSlot'));
        })
        /*===== Ajax =====*/
        $.ajaxSetup({
            crossDomain: true,
            xhrFields: {
                withCredentials: true
            },
            beforeSend: function (xhr, type) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            }
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){


            if(e.target.id == 'tab-boleto'){
                $('#paymentMethod').val('boleto');
            } else {
                $('#paymentMethod').val('creditCard');
            }
        });

        $(document).ready(function () {
            PagSeguroDirectPayment.setSessionId('{{ PagSeguro::startSession() }}');


            var _total = "{{money($assinaturas->valor)}}";
            _total = _total.replace('R$', "").replace(',', '.');
            _total = _total.substr(1);

            //*****CRIAÇÃO DAS IMAGENS DAS BANDEIRAS*****
            pagSeguro.getPaymentMethod(parseFloat( _total))
                .then(function(urls){
                    var html = '';
                    var prefix = 'https://stc.pagseguro.uol.com.br';
                    for(var item in urls){
                        if(urls[item].status === "AVAILABLE"){

                            var url = prefix + urls[item].images.MEDIUM.path;
                            var name = urls[item].name.toLowerCase();

                            html += '<img src="' +url+ '" id="'+name+'" class="credit_card img-black-and-white">'
                        }
                    }


                    $('#payment_methods').html(html);

                    pagSeguro.getSenderHash().then(function(data){
                        $('#senderHash').val(data);
                    });
                });


            $('#card_number').on('keyup', function(){
                var value = $(this).val();
                var brand = '';
                var final = value.replace('.', '').replace('.', '').replace('.', '').replace('.', '');
                var total = '{{ str_replace('R$ ', '', str_replace(',', '.', money(str_replace(',', '.', $assinaturas->valor)))) }}';

                if(final.length >= 6){
                    pagSeguro.getBrand(final).then(function(response){
                        $('.credit_card').addClass('img-black-and-white');
                        $('#'+response.result.brand.name).removeClass('img-black-and-white');
                        $('#payment_id').val(response.result.brand.name);

                    });

                } else {
                    $('.credit_card').addClass('img-black-and-white');
                    $('#payment_id').val('');
                }
            });
            $('#sameAddress').on('change', function(){
                var value = $('#sameAddress:checked').val();

                if(value == 1){

                    var cep = $('#cep').val();
                    var rua = $('#endereco').val();
                    var numero = $('#numero').val();
                    var complemento = $('#complemento').val();
                    var referencia = $('#referencia').val();
                    var bairro = $('#bairro').val();
                    var cidade = $('#cidade').val();
                    var estado = $('#estado').val();

                    $('#cepCard').val(cep).focus();
                    $('#enderecoCard').val(rua).focus();
                    $('#numeroCard').val(numero).focus();
                    $('#complementoCard').val(complemento).focus();
                    $('#refCard').val(referencia).focus();
                    $('#bairroCard').val(bairro).focus();
                    $('#cidadeCard').val(cidade).focus();
                    $('#estadoCard').val(estado).focus();



                }else{
                    $('#cepCard').val('');
                    $('#enderecoCard').val('');
                    $('#numeroCard').val('');
                    $('#complementoCard').val('');
                    $('#refCard').val('');
                    $('#bairroCard').val('');
                    $('#cidadeCard').val('');
                    $('#estadoCard').val('');
                }
            });
        });
//******PARCELAMENTO*************
//        $('#parcelamento').on('change', function(){
//            var value = $('#parcelamento option:selected').attr('data-installment');
//            var valueTotal = $('#parcelamento option:selected').attr('data-total');
//            var valorOption = $('#parcelamento').val();
//            console.log(valueTotal);
//            if(valorOption == 1){
//                $('.valorTotalParc span').html(valueTotal);
//                $('.totalValueCheckout').html(valueTotal);
//            }else{
//                $('#installmentValue').val(value);
//                $('.totalValueCheckout').html('R$ ' + valueTotal.replace(".", ","));
//                $('.valorTotalParc span').html('<span style="font-size: 12px;">parcelado</span> ' + 'R$ ' + valueTotal.replace(".", ","));
//            }
//        });
        $('form.send-payment').submit(function(e){
            e.preventDefault();

            $('.error-card').hide();

            var _total = "{{money($assinaturas->valor)}}";
            _total = _total.replace('R$', "").replace(',', '.');
            // _total = _total.substr(1);

            var btn = $('.btnAssinar');
            btn.html('<i class="fa fa-spinner fa-fw fa-pulse"></i> Finalizando');
            btn.attr('disabled', 'disabled');

            var nome = $('#nome').val();
            var email = $('#email').val();
            var password = $('#senha').val();
            var password_confirmed = $('#confirmSenha').val();
            var cpf = $('#cpf').val();
            var celular = $('#celular').val();
            var telefone = $('#telefone').val();
            var cep = $('#cep').val();
            var address = $('#endereco').val();
            var numero = $('#numero').val();
            var complemento = $('#complemento').val();
            var referencia = $('#referencia').val();
            var bairro = $('#bairro').val();
            var cidade = $('#cidade').val();
            var estado = $('#estado').val();
            var payment_id = $('#payment_id').val();
            var number = $('input[name="cardNumber"]').val().replace('.', '').replace('.', '').replace('.', '').replace('.', '');
            var embossing = $('input[name="embossing"]').val();
            var mes = $('select[name="expirationMonth"]').val();
            var ano = $('select[name="expirationYear"]').val();
            var cvv = $('input[name="cvv"]').val();
            var installment = 1;
            var installmentValue = _total;
            var nomeCard = embossing;
            var cepCard = $('#cepCard').val();
            var enderecoCard = $('#enderecoCard').val();
            var numeroCard = $('#numeroCard').val();
            var complementoCard = $('#complementoCard').val();
            var referenciaCard = $('#refCard').val();
            var bairroCard = $('#bairroCard').val();
            var cidadeCard = $('#cidadeCard').val();
            var estadoCard = $('#estadoCard').val();
            var creditCardHolderPhone = $('#creditCardHolderPhone').val();
            var senderHash = $('#senderHash').val();
            var creditCardHolderCPF = $('#creditCardHolderCPF').val();
            var creditCardHolderBirthDate = $('#creditCardHolderBirthDate').val();
            var cardToken;
            var paymentMethod = $('#paymentMethod').val();
            var politica = $('input[name="politica"]:checked').val();

            if(paymentMethod != 'boleto'){
                var params = {
                    cardNumber: number,
                    cvv: cvv,
                    expirationMonth: mes,
                    expirationYear: ano,
                    brand: payment_id,
                    success: function(response) {
                        //token gerado, esse deve ser usado na chamada da API do Checkout Transparente
                        cardToken = response.card.token;

                        if(cardToken != ''){
                            $.ajax({
                                method: 'POST',
                                url: '{{ url("/assinaturas/".$assinaturas->code) }}',
                                data: {
                                    'name' : nome,
                                    'email' : email,
                                    'password' : password,
                                    'password_confirmation' : password_confirmed,
                                    'cpf' : cpf,
                                    'celular' : celular,
                                    'telefone' : telefone,
                                    'cep' : cep,
                                    'address' : address,
                                    'numero' : numero,
                                    'complemento' : complemento,
                                    'referencia' : referencia,
                                    'bairro' : bairro,
                                    'cidade' : cidade,
                                    'estado' : estado,
                                    'politica': politica,
                                    'payment_id': payment_id,
                                    'number': number,
                                    'embossing': embossing,
                                    'mes': mes,
                                    'ano': ano,
                                    'cvv': cvv,
                                    'paymentMethod': paymentMethod,
                                    'installment': installment,
                                    'installmentValue': installmentValue,
                                    'cardToken': cardToken,
                                    'nomeCard': nomeCard,
                                    'cepCard' : cepCard,
                                    'addressCard' : enderecoCard,
                                    'numeroCard' : numeroCard,
                                    'complementoCard' : complementoCard,
                                    'referenciaCard' : referenciaCard,
                                    'bairroCard' : bairroCard,
                                    'cidadeCard' : cidadeCard,
                                    'estadoCard' : estadoCard,
                                    'creditCardHolderPhone' : creditCardHolderPhone,
                                    'senderHash' : senderHash,
                                    'creditCardHolderCPF' : creditCardHolderCPF,
                                    'creditCardHolderBirthDate' : creditCardHolderBirthDate
                                }
                            }).done(function (data) {
                                if(data.success) {
                                    if(data.linkBoleto != ''){
                                        window.open(data.linkBoleto, "Boleto Empreenda Revista");
                                    }
                                    window.location.href = data.url;
                                } else {
                                    btn.html('<i class="fa fa-fw fa-lock"></i> Finalizar Compra');
                                    btn.removeAttr('disabled');
                                    $('#loading .loader .text').html('');

                                    console.log(data.error);

                                    $.each(data.error, function(index, value){
                                        $('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                            value +
                                            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                            '    <span aria-hidden="true">&times;</span>' +
                                            '  </button>' +
                                            '</div>').appendTo($('#assinantes'));
                                    });

                                    $('.error-payment').show();
                                    $('.error-payment .text-error').html(data.error.message);
                                }
                            }).fail(function (e) {
                                console.log(e);

                                btn.html('<i class="fa fa-fw fa-lock"></i> Finalizar Compra');
                                btn.removeAttr('disabled');
                                $('#loading .loader .text').html('');


                                $('.error-payment').show();
                                $('.error-payment .text-error').html(e.error.message);

                                $.notify({
                                    icon: 'icon-alert',
                                    message: 'Erro ao finalizar a compra.',
                                });
                            });
                        }

                    },
                    error: function(response) {
                        //tratamento do erro

                        console.log(response);

                        var err;

                        if(response.errors){
                           err = response.errors; console.log('tem errors')
                        } else {
                            err = response.error;
                        }

                        console.log('err '+err);

                        $.each(err, function(index, value){
                            var msg;
                            console.log('index ' + index);
                            if(index == 10000){
                                msg = "Bandeira do cartão inválida";
                            } else if(index == 10001){
                                msg = "O número do cartão está incompleto, verifique";
                            } else if(index == 10004){
                                msg = "O CVV é obrigatório";
                            } else if(index == 30405){
                                msg = "Preencha o mês e ano de expiração do cartão";
                            } else if(index == 30404){
                                msg = "Devido ao tempo de inatividade na página, é necessário atualiza-la";
                            } else if(index == 30400){
                                msg = "Data de expiração do cartão inválida";
                            } else {
                                msg = value;
                            }
                            $('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                msg +
                                '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                '    <span aria-hidden="true">&times;</span>' +
                                '  </button>' +
                                '</div>').appendTo($('#assinantes'));
                        });

                        btn.html('Enviar <i class="far fa-paper-plane"></i>');
                        btn.removeAttr('disabled');
                        $('#loading .loader .text').html('');


                        $('.error-payment').show();
                        $.notify({
                            icon: 'icon-alert',
                            message: 'Erro ao finalizar a pagamento.',
                        });
                    }
                };

                var resp = PagSeguroDirectPayment.createCardToken(params);
            } else {
                $.ajax({
                    method: 'POST',
                    url: '{{ url("/assinaturas/".$assinaturas->code) }}',
                    data: {
                        'name' : nome,
                        'email' : email,
                        'password' : password,
                        'password_confirmed' : password_confirmed,
                        'cpf' : cpf,
                        'celular' : celular,
                        'telefone' : telefone,
                        'cep' : cep,
                        'address' : address,
                        'numero' : numero,
                        'complemento' : complemento,
                        'referencia' : referencia,
                        'bairro' : bairro,
                        'cidade' : cidade,
                        'estado' : estado,
                        'payment_id': payment_id,
                        'number': number,
                        'embossing': embossing,
                        'mes': mes,
                        'ano': ano,
                        'cvv': cvv,
                        'paymentMethod': paymentMethod,
                        'installment': installment,
                        'installmentValue': installmentValue,
                        'cardToken': cardToken,
                        'politica': politica,
                        'nomeCard': nomeCard,
                        'cepCard' : cepCard,
                        'addressCard' : enderecoCard,
                        'numeroCard' : numeroCard,
                        'complementoCard' : complementoCard,
                        'referenciaCard' : referenciaCard,
                        'bairroCard' : bairroCard,
                        'cidadeCard' : cidadeCard,
                        'estadoCard' : estadoCard,
                        'creditCardHolderPhone' : creditCardHolderPhone,
                        'senderHash' : senderHash,
                        'creditCardHolderCPF' : creditCardHolderCPF,
                        'creditCardHolderBirthDate' : creditCardHolderBirthDate
                    }
                }).done(function (data) {
                    if(data.success) {
                        window.location.href = data.url;
                    } else {
                        btn.html('Enviar  <i class="far fa-paper-plane"></i>');
                        btn.removeAttr('disabled');
                        $('#loading .loader .text').html('');


                        $.each(data.error, function(index, value){
                            $('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                value +
                                '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                '    <span aria-hidden="true">&times;</span>' +
                                '  </button>' +
                                '</div>').appendTo($('#assinantes'));
                        });

                    }
                }).fail(function (e) {
                    console.log(e);

                    btn.html('Enviar <i class="far fa-paper-plane"></i>');
                    btn.removeAttr('disabled');
                    $('#loading .loader .text').html('');

                    $('.error-payment').show();
                    $('.error-payment .text-error').html(e.error.message);

                    $.notify({
                        icon: 'icon-alert',
                        message: 'Erro ao finalizar a compra.',
                    });
                });
            }

            return false;
        });
    </script>
@else
    <script>
        /*===== Ajax =====*/
        $.ajaxSetup({
            beforeSend: function (xhr, type) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            }
        });
    </script>
@endif

@yield('script')
</body>
</html>
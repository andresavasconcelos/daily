@extends('layout_site.app')

@section('style')
    <style>
        .btn-orange{
            background-color: #d97a2c !important;
        }

        .btn-orange input{
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
    </style>
@endsection

@section('script')
    <script>
        $('#cepCard').mask('00000-000');
        $('#creditCardHolderPhone').mask('(00) 00000-0000');
        $('#creditCardHolderCPF').mask('000.000.000-00');
        $('#creditCardHolderBirthDate').mask('00/00/0000');
        $('#card_number').mask('0000.0000.0000.0000');
        $('#cnpj').mask('00.000.000/0000-00');

        $('input[name="pfpj"]').on('change', function(){

            var _val = $('input[name="pfpj"]:checked').val();

            if( _val == "1"){
                console.log('entrou no if');
                $('#cpfInput').removeClass('d-none');
                $('#cnpjInput').addClass('d-none');

            } else if(_val == "2") {
                console.log('entrou no else');
                $('#cpfInput').addClass('d-none');
                $('#cnpjInput').removeClass('d-none');
            }
        });

        $('#cep').on('blur', function(){

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#endereco").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#estado").val("...");


                    //Consulta o webservice viacep.com.br/
                    $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                        if (!("erro" in dados)) {

                            $("#endereco").val(dados.logradouro).focus();
                            $("#bairro").val(dados.bairro).focus();
                            $("#cidade").val(dados.localidade).focus();
                            $("#estado").val(dados.uf).focus();
                            $('#numero').focus();
                        } else {

                            alert("CEP não encontrado.");
                        }
                    });
                } else {

                    alert("Formato de CEP inválido.");
                }
            } else {

                alert("Preencha um cep válido");
            }

        });

        $('#cepCard').on('blur', function(){

            console.log('perdeu o focus');

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#enderecoCard").val("...");
                    $("#bairroCard").val("...");
                    $("#cidadeCard").val("...");
                    $("#estadoCard").val("...");


                    //Consulta o webservice viacep.com.br/
                    $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                        if (!("erro" in dados)) {

                            $("#enderecoCard").val(dados.logradouro).focus();
                            $("#bairroCard").val(dados.bairro).focus();
                            $("#cidadeCard").val(dados.localidade).focus();
                            $("#estadoCard").val(dados.uf).focus();
                            $('#numeroCard').focus();
                        } else {

                            alert("CEP não encontrado.");
                        }
                    });
                } else {

                    alert("Formato de CEP inválido.");
                }
            } else {

                alert("Preencha um cep válido");
            }
        });
    </script>
@endsection
@section('content')
    {{--*****MODAL*****--}}
    <div class="modal fade" id="modalPolitica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Política de Assinatura</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>São partes neste instrumento, de um lado, <strong>Empreenda Revista</strong> legalmente constituída, com sede em Mauá, Estado de São Paulo, na Rua Cedral 91, inscrita no CNPJ sob número 10.378.146/0001-29, doravante, de outro lado, a pessoa física ou jurídica identificada no Cadastramento Eletrônico pelo seu Código de Assinante, doravante identificada simplesmente como <strong>ASSINANTE</strong>.</p>
                    <p>
                        <strong>1. OBJETO DO CONTRATO</strong>
                        <br />
                        Este contrato tem por objetivo estabelecer os termos e condições do ajuste firmado entre a <strong>Empreenda Revista</strong> e o <strong>ASSINANTE</strong> para o envio das publicações impressas e/ou acesso das publicações digitais por ele contratadas.
                    </p>
                    <p>1.1 As informações relativas a contratação de suas publicações em formato digital encontra-se disponíveis ao <strong>ASSINANTE</strong> no site: www.empreendarevista.com.br/assinaturas</p>
                    <p><strong>2. CÓDIGO DA ASSINATURA</strong>
                        <br />
                        A <strong>Empreenda</strong> concederá ao <strong>ASSINANTE</strong> um “Código de Assinante” que corresponderá à sua identificação junto ao Serviço de Atendimento ao Cliente <strong>Empreenda</strong>. Todo assinante tem um código pessoal e intransferível. Ele tem <span>nove dígitos</span> e o <strong>ASSINANTE</strong> pode encontrá-lo na carta de boas-vindas enviada após a confirmação do seu pedido. O seu código de assinante está também na etiqueta colada na capa ou no envelope plástico que envolve a publicação.
                    </p>
                    <p>
                        <strong>3. ENTREGA</strong>
                        <br />
                        O início da entrega dos exemplares se dá no prazo máximo de 04 a 06 semanas da contratação, ressalvada a possibilidade de ações promocionais da <strong>Empreenda</strong>, que assegurem o início da entrega em data inferior à regra aqui estabelecida. Para que o prazo de início da entrega dos exemplares seja observado, o <strong>ASSINANTE</strong> deverá informar de maneira completa todos os dados de seu endereço: a) Logradouro (Ex.: rua, avenida, praça, etc.); b) Número do imóvel; c) Eventual complemento (Ex.: apto., casa, fundos, baixos, etc.); d) bairro; e) Cidade; f) Estado; g) Código de Endereçamento Postal – CEP.
                    </p>
                    <p>
                        <strong>4. FORMAS DE CONTRATAÇÃO:</strong>
                        <br />
                        A <strong>Empreenda</strong> disponibiliza ao <strong>ASSINANTE</strong> as seguintes formas de contratação de suas publicações:
                        <br />
                        <strong>a) VIA INTERNET</strong>
                    </p>
                    <p>
                        <strong>5. TIPOS DE ASSINATURA</strong>
                        <br />
                        A <strong>Empreenda Revista</strong> mantêm quatro tipos diferentes de assinatura de suas publicações, classificadas em função da forma de sua contratação pelo <strong>ASSINANTE</strong>:
                        <br />
                        a) <strong>ASSINATURAS NOVAS</strong> – Assinaturas que estão sendo efetuadas pela primeira vez em relação a um mesmo assinante;
                        <br />
                        b) <strong>ASSINATURAS RENOVADAS</strong> – Assinaturas que já foram efetuadas por um mesmo assinante em relação a uma mesma publicação;
                        <br />
                        c) <strong>ASSINATURA PRESENTE</strong> – Assinaturas contratadas por um determinado consumidor com a intenção de que as publicações sejam entregues a outra pessoa, por ele presenteada;
                    </p>
                    <p>
                        <strong>6. FORMAS DE PAGAMENTO</strong>
                        <br />
                        O preço de cada assinatura das publicações é fixado sob duas condições de venda, conforme a modalidade de cobrança escolhida pelo <strong>ASSINANTE</strong>, quais sejam, cartão de crédito ou débito em conta, e boleto bancário.
                    </p>
                    <p>
                        <strong>7. CANCELAMENTO</strong>
                        <br />
                        Este produto ou serviço poderá ser cancelado no prazo de 7 (sete) dias, a contar da adesão ao contrato ou do ato de recebimento do produto ou serviço, com direito à devolução dos valores pagos, monetariamente atualizados. A <strong>Empreenda Revista</strong> também assegura ao <strong>ASSINANTE</strong> a possibilidade de cancelamento do contrato a qualquer tempo, mediante devolução do valor proporcional aos exemplares já recebidos.
                    </p>
                    <p>
                        <span class="bgred">8. CLUBE DO ASSINANTE</span>
                        <br />
                        O Clube do Assinante é um site exclusivo para o <strong>ASSINANTE Empreenda Revista</strong>, que traz um rol de benefícios e vantagens ao usuário, tais como a possibilidade de obtenção de descontos com parceiros da Empreenda e participações em eventos.
                        <br />
                        <span>Para participar do Clube, o ASSINANTE deve se cadastrar no site www.empreendarevista.com.br/clubeempreenda, não sendo necessário qualquer pagamento.</span>
                    </p>
                    <p>
                        <strong>9. BANCO DE DADOS</strong>
                        <br />
                        O <strong>ASSINANTE</strong> se declara ciente de que, a partir da contratação da assinatura de uma publicação <strong>Empreenda Revista</strong> o mesmo passa a fazer parte de seu banco de dados, por meio do qual poderá vir a receber informações e promoções por meio de boleto proposta, da <strong>Emprenda</strong> e de outras empresas idôneas com as quais a mesma possua relacionamento. Se acaso o <strong>ASSINANTE</strong> não tiver o interesse em receber essas informações, fica assegurado ao mesmo o direito de manifestar sua oposição, bastando que tal decisão seja comunicada para o Serviço de Atendimento ao Cliente <strong>Empreenda</strong>. A <strong>Empreenda</strong> assegura a todos os seus assinantes a inviolabilidade e o segredo de seus dados cadastrais. Todas as suas informações são armazenadas dentro dos mais rígidos critérios de segurança no banco de dados da <strong>Empreenda</strong> e são tratadas de acordo com o código de ética da ABEMD - Associação Brasileira de Marketing Direto. Em nenhuma hipótese são fornecidas informações pessoais para terceiros, somente dados genéricos utilizados para envio de mala direta, e-mail,
                    </p>
                    <p>
                        <span>
                            <strong>10. NUMEROS EXTRAVIADOS OU NÃO RECEBIDOS</strong>
                            <br />
                            Caso o exemplar de sua assinatura não tenha sido entregue ou tenha se extraviado é assegurado ao <strong>ASSINANTE</strong> o direito de requerer a entrega de novo exemplar, o que poderá ser solicitado junto ao Serviço de Atendimento ao Cliente <strong>Empreenda revista</strong>, via contato telefônico ou website.
                        </span>
                    </p>
                    <p>
                        <strong>12. PRAZO</strong>
                        <br />
                        Este contrato é celebrado pelo prazo de 3 (três) a 12 (doze meses), conforme opção do <strong>ASSINANTE</strong>, sendo prorrogado por períodos iguais ou diferentes, por meio da modalidade de renovação facilitada. Para tanto, será enviado com a devida antecedência, aviso sobre essa facilidade.
                        <br />
                        No período que antecede o término de sua assinatura, a <strong>Empreenda Revista</strong> enviará ao <strong>ASSINANTE</strong> comunicações para relembrá-lo do serviço, nas quais irão constar todas as informações relativas ao novo período de vigência contratual.
                    </p>
                    <p>
                        <strong>14. RESCISÃO</strong>
                        O contrato poderá ser rescindido na hipótese de infração contratual, caso a parte infratora não corrija o inadimplemento, após notificação. Caso o <strong>ASSINANTE</strong> não pague o débito no prazo estipulado em notificação, o contrato poderá ser rescindido com a imediata suspensão da entrega/acesso dos exemplares da respectiva publicação.
                    </p>
                    <p>
                        <strong>15. ALTERAÇÕES DO CONTRATO</strong>
                        As alterações a este contrato que importem em ônus financeiro ao <strong>ASSINANTE</strong>, serão feitas mediante comunicação prévia ao mesmo, que poderá manifestar a sua concordância, por qualquer meio disponível, renegociar o contrato ou qualquer das partes poderá denunciá-lo, caso não se cheguem a um acordo.
                    </p>
                    <p>
                        <strong>16. FORO</strong>
                        Fica assegurado ao <strong>ASSINANTE</strong> o direito de caso necessário, recorrer ao Foro da Comarca em que residir para quaisquer dúvidas oriundas deste instrumento.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <section class="sectionAssinaturas">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    @if ($errors->any())
                        {{ implode('', $errors->all('<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                      :message
                                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>')) }}
                    @endif

                    <div class="card cardAssinatura">
                        <div class="row rowTitle">
                            <div class="container">
                                <h1>ASSINATURA</h1>
                            </div>
                        </div>
                        <form method="POST" action="{{ url('/assinanturas/'.$assinaturas->code) }}" id="assinantes" class="send-payment">
                            <input type="hidden" id="installmentValue" value="{{ $assinaturas->valor }}">
                            <input type="hidden" name="payment_id" id="payment_id">
                            <input type="hidden" name="paymentMethod" value="creditCard" id="paymentMethod">
                            <input type="hidden" name="senderHash" id="senderHash">
                            {{ csrf_field() }}
                            <div class="row">

                                <div class="col-lg-12 col-12 text-center m-2">
                                    <div class="form-group">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default btn-orange active form-check-label">
                                                <input class="form-check-input" name="pfpj" value="1" type="radio" checked autocomplete="off"> Pessoa Física
                                            </label>

                                            <label class="btn btn-default btn-orange form-check-label">
                                                <input class="form-check-input" name="pfpj" value="2" type="radio" autocomplete="off"> Pessoa Jurídica
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="md-form mt-0">
                                        <input type="text" id="nome" class="form-control" name="name">
                                        <label for="nome">Nome Completo</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="md-form mt-0">
                                        <input type="text" id="email" class="form-control" name="email">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="md-form mt-0">
                                        <input type="password" id="senha" class="form-control" name="password">
                                        <label for="senha">Senha</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="md-form mt-0">
                                        <input type="password" id="confirmSenha" class="form-control" name="password_confirmation">
                                        <label for="confirmSenha">Confirmar senha</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-12" id="cpfInput">
                                    <div class="md-form mt-0">
                                        <input type="text" id="cpf" class="cpf form-control" name="cpf">
                                        <label for="cpf">CPF</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 d-none" id="cnpjInput">
                                    <div class="md-form mt-0">
                                        <input type="text" id="cnpj" class="cnpj form-control" name="cnpj">
                                        <label for="cnpj">CNPJ</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="md-form mt-0">
                                        <input type="tel" id="celular" class="cel form-control" name="celular">
                                        <label for="celular">Celular</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="md-form mt-0">
                                        <input type="tel" id="telefone" class="tel form-control" name="telefone">
                                        <label for="telefone">Telefone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-12">
                                    <div class="md-form mt-0">
                                        <input type="text" id="cep" class="cep form-control" name="cep">
                                        <label for="cep">CEP</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="md-form mt-0">
                                        <input type="text" id="endereco" class="form-control" name="address">
                                        <label for="endereco">Endereço</label>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <div class="md-form mt-0">
                                        <input type="text" id="numero" class="form-control" name="numero">
                                        <label for="numero">Número</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-12">
                                    <div class="md-form mt-0">
                                        <input type="text" id="complemento" class="form-control" name="complemento">
                                        <label for="complemento">Complemento</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="md-form mt-0">
                                        <input type="text" id="referencia" class="form-control" name="referencia">
                                        <label for="referencia">Referêcia</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="md-form mt-0">
                                        <input type="text" id="bairro" class="form-control" name="bairro">
                                        <label for="bairro">Bairro</label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="md-form mt-0">
                                        <input type="text" id="cidade" class="form-control" name="cidade">
                                        <label for="cidade">Cidade</label>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <div class="md-form mt-0">
                                        <input type="text" id="estado" class="form-control" name="estado">
                                        <label for="estado">Estado</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h2>PAGAMENTO</h2>
                                </div>
                            </div>

                            <div class="classic-tabs mx-2 tabsPagamentos">
                                <ul class="nav tabs-cyan" id="myClassicTabShadow" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link  waves-light active show" id="tab-cartao" data-toggle="tab" href="#tab-cartao-shadow" role="tab" aria-controls="tab-cartao-shadow" aria-selected="true"><i class="far fa-credit-card"></i></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link waves-light" id="tab-boleto" data-toggle="tab" href="#tab-boleto-shadow" role="tab" aria-controls="tab-boleto-shadow" aria-selected="false"><i class="fas fa-barcode"></i></a>
                                    </li>
                                </ul>
                                <div class="tab-content card" id="myClassicTabContentShadow">
                                    <div class="tab-pane fade active show" id="tab-cartao-shadow" role="tabpanel" aria-labelledby="tab-cartao">
                                        <div class="row">
                                            <div class="col-lg-8 col-12">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <div class="form-group">
                                                            <div class="md-form mt-0">
                                                                <input type="text" id="card_number" class="form-control" name="cardNumber">
                                                                <label for="card_number">Número do cartão</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <div class="form-group">
                                                            <div class="md-form mt-0">
                                                                <label for="embossing">Nome impresso no cartão</label>
                                                                <input type="text" class="form-control" id="embossing" name="embossing">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-12">
                                                        <div class="form-group">
                                                            <div class="md-form mt-0">
                                                                <input type="text" id="cvv" class="form-control" name="cvv">
                                                                <label for="cvv" class="allTtooltips" data-toggle="tooltip" data-placement="right" title="Código de verificação do cartão">CVV</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-12">
                                                        <div class="form-group">
                                                            <select class="browser-default custom-select" name="expirationMonth">
                                                                <option selected>Mês de expiração</option>
                                                                <option value="1">01</option>
                                                                <option value="2">02</option>
                                                                <option value="3">03</option>
                                                                <option value="4">04</option>
                                                                <option value="5">05</option>
                                                                <option value="6">06</option>
                                                                <option value="7">07</option>
                                                                <option value="8">08</option>
                                                                <option value="9">09</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-12">
                                                        <div class="form-group">
                                                            <select class="browser-default custom-select" name="expirationYear">
                                                                <option selected>Ano de expiração</option>
                                                                @for($i=0; $i <= 20; $i++)
                                                                    <option value="{{ \Carbon\Carbon::now()->format('Y') + $i }}">{{ \Carbon\Carbon::now()->format('Y') + $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-12 mb-5">
                                                <div class="brand" id="payment_methods" >

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h2>ENDEREÇO DE COBRANÇA</h2>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" value="1" id="sameAddress">
                                                        <label class="custom-control-label" for="sameAddress">Mesmo endereço residencial</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-12">
                                                <div class="md-form mt-0">
                                                    <input type="text" id="cepCard" class="cep form-control" name="cepCard">
                                                    <label for="cepCard">CEP</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="md-form mt-0">
                                                    <input type="text" id="enderecoCard" class="form-control" name="addressCard">
                                                    <label for="enderecoCard">Endereço</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-12">
                                                <div class="md-form mt-0">
                                                    <input type="text" id="numeroCard" class="form-control" name="numeroCard">
                                                    <label for="numeroCard">Número</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-12">
                                                <div class="md-form mt-0">
                                                    <input type="text" id="complementoCard" class="form-control" name="complementoCard">
                                                    <label for="complementoCard">Complemento</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-12">
                                                <div class="md-form mt-0">
                                                    <input type="text" id="refCard" class="form-control" name="refCard">
                                                    <label for="refCard">Referêcia</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-12">
                                                <div class="md-form mt-0">
                                                    <input type="text" id="bairroCard" class="form-control" name="bairroCard">
                                                    <label for="bairroCard">Bairro</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12">
                                                <div class="md-form mt-0">
                                                    <input type="text" id="cidadeCard" class="form-control" name="cidadeCard">
                                                    <label for="cidadeCard">Cidade</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-12">
                                                <div class="md-form mt-0">
                                                    <input type="text" id="estadoCard" class="form-control" name="estadoCard">
                                                    <label for="estadoCard">Estado</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h2>DADOS DO CARTÃO</h2>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <div class="md-form mt-0">
                                                    <input type="text" id="creditCardHolderPhone" class="form-control" name="creditCardHolderPhone">
                                                    <label for="creditCardHolderPhone">Telefone para contato</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="md-form mt-0">
                                                    <input type="text" id="creditCardHolderCPF" class="form-control" name="creditCardHolderCPF">
                                                    <label for="creditCardHolderCPF">CPF</label>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <div class="md-form mt-0">
                                                    <input type="text" id="creditCardHolderBirthDate" class="form-control" name="creditCardHolderBirthDate">
                                                    <label for="creditCardHolderBirthDate">Data de Nasc.</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-boleto-shadow" role="tabpanel" aria-labelledby="tab-boleto">
                                        <p>Pagamento via boleto bancário</p>
                                        <small class="text-danger"><strong>Ao pagar com boleto, será acrecido uma taxa de R$1,00</strong></small>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary btnPolitica" data-toggle="modal" data-target="#modalPolitica">
                                Política de assinatura
                            </button>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="1" name="politica" class="custom-control-input" id="defaultUnchecked">
                                <label class="custom-control-label" for="defaultUnchecked">Li e aceito os Termos e condições</label>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-info btn-rounded btnAssinar" type="submit">Enviar <i class="far fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
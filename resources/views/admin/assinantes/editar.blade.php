@extends('layout_admin.app')

@section('scripts')


@endsection

@section('content')
    @foreach($assinante->assinatura as $assinatura)
        <div class="modal fade" id="assinatura{{$assinatura->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form id="editarAssinatura{{$assinatura->id}}" action="{{ url('/admin/assinatura/'.$assinatura->id.'/editar') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Assinatura {{ $assinatura->codigo_assinatura }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for="">Data de Efetivação</label>
                                    <input type="date" class="form-control" name="data_efetivacao" value="{{ $assinatura->data_efetivacao }}">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="">Data de expiração</label>
                                    <input type="date" class="form-control" name="data_expiracao" value="{{ $assinatura->data_expiracao }}">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="">Código da assinatura</label>
                                    <input type="text" class="form-control" name="codigo_assinatura" value="{{ $assinatura->codigo_assinatura }}">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="">Situação do pagamento</label>
                                    <select name="situacao" class="form-control" id="situacao">
                                        <option value="">Selecione</option>
                                        <option {{ $assinatura->situacao == 0 ? "selected" : "" }} value="0">Inativa</option>
                                        <option {{ $assinatura->situacao == 1 ? "selected" : "" }} value="1">Ativa</option>
                                        <option {{ $assinatura->situacao == 2 ? "selected" : "" }} value="2">Expirada</option>
                                        <option {{ $assinatura->situacao == 3 ? "selected" : "" }} value="3">Cancelada</option>
                                    </select>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" id="situacao">
                                        <option value="">Selecione</option>
                                        <option {{ $assinatura->status == 0 ? "selected" : "" }} value="1">Aguardando pagamento</option>
                                        <option {{ $assinatura->status == 2 ? "selected" : "" }} value="2">Em análise</option>
                                        <option {{ $assinatura->status == 3 ? "selected" : "" }} value="3">Pedido Pago</option>
                                        <option {{ $assinatura->status == 4 ? "selected" : "" }} value="4">Pedido em separação</option>
                                        <option {{ $assinatura->status == 5 ? "selected" : "" }} value="5">Em disputa</option>
                                        <option {{ $assinatura->status == 6 ? "selected" : "" }} value="6">Pedido Devolvido</option>
                                        <option {{ $assinatura->status == 7 ? "selected" : "" }} value="7">Cancelado</option>
                                    </select>

                                </div>
                                <div class="col-4 mb-3">
                                    <label for="">Forma de pagamento</label>
                                    <select name="paymentMethod" id="paymentMethod" class="form-control">
                                        <option value="">Selecione</option>
                                        <option value="boleto" {{ $assinatura->paymentMethod == "boleto" ? "selected" : "" }}>Boleto bancário</option>
                                        <option value="creditCard" {{ $assinatura->paymentMethod == "creditCard" ? "selected" : "" }}>Cartão de crédito</option>
                                    </select>
                                </div>
                                @if($assinatura->paymentMethod == "boleto")
                                <div class="col-4 mb-3">
                                    <label for="">Rever boleto</label>
                                    <a href="{{ $assinatura->url_boleto }}" target="_blank" class="btn btn-primary">Baixar Boleto</a>
                                </div>
                                @endif
                                @if(count(\App\AssinaturaEnviada::getEnvios($assinatura->id)) > 0)
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="">Edições enviadas:</label><br />

                                        @foreach(\App\AssinaturaEnviada::getEnvios($assinatura->id) as $assinaturaEnviada)
                                            <label class="checkbox">
                                                <input type="checkbox" {{ $assinaturaEnviada->enviado == 1 ? 'disabled checked' : '' }} name="edicao[]" value="{{ $assinaturaEnviada->edicao }}"> {{ $assinaturaEnviada->edicao }}
                                            </label>
                                        @endforeach

                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy"></i> Editar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    <section class="content-header">
        <h1>
            Assinante
            {{--<small>Cardapio completo</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/painel') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url('admin/assinantes') }}"> /Assinantes</a></li>
            <li class="active">/Assinante</li>
        </ol>
    </section>
    <section class="content">
        <div class="col-12 col-lg-12">
            @if ($errors->any())
                {!! implode('', $errors->all('
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  :message
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>')) !!}
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="card border-primary mb-3">
            <form action="{{ url('admin/assinante/'.$assinante->id.'/editar') }}" method="post">
                {{ csrf_field() }}
                <div class="card-header">{{ $assinante->name }}</div>
                <div class="card-body text-primary">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Nome:</label>
                                <input type="text" name="name" class="form-control" value="{{ $assinante->name }}" >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="text" name="email" class="form-control" value="{{ $assinante->email }}" >
                            </div>
                        </div>
                        @if($assinante->cpf != '')
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">CPF:</label>
                                    <input type="text" name="cpf" class="form-control" value="{{ $assinante->cpf }}" >
                                </div>
                            </div>
                        @endif
                        @if($assinante->cnpj != '')
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">CNPJ:</label>
                                    <input type="text" name="cnpj" class="form-control" value="{{ $assinante->cnpj }}" >
                                </div>
                            </div>
                        @endif
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Celular:</label>
                                <input type="text" class="form-control" name="celular" value="{{ $assinante->celular != '' ? $assinante->celular : 'N/I'}}" >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Telefone:</label>
                                <input type="text" class="form-control" name="telefone" value="{{ $assinante->telefone != '' ? $assinante->telefone : 'N/I'}}" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">CEP:</label>
                                <input type="text" class="form-control" name="cep" value="{{ $assinante->cep }}" >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Endereço:</label>
                                <input type="text" class="form-control" name="address" value="{{ $assinante->address }}" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Número:</label>
                                <input type="text" class="form-control" name="numero" value="{{ $assinante->numero }}" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Complemento:</label>
                                <input type="text" class="form-control" name="complemento" value="{{ $assinante->complemento }}" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Bairro:</label>
                                <input type="text" class="form-control" name="bairro" value="{{ $assinante->bairro }}" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Cidade:</label>
                                <input type="text" class="form-control" name="cidade" value="{{ $assinante->cidade }}" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Estado:</label>
                                <input type="text" class="form-control" name="estado" value="{{ $assinante->estado }}" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-orange btn-sm"><i class="fa fa-floppy"></i> Salvar</button>
                </div>
            </form>
        </div>

        <div class="card border-primary">
            <div class="card-header">Assinaturas</div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Data de efetivação</th>
                        <th>Data de expiração</th>
                        <th>Cod. da assinatura</th>
                        <th>Situação</th>
                        <th>Envios</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($assinante->assinatura as $assinatura)
                        <tr>
                            <td>{{ $assinatura->data_efetivacao != null ? \Carbon\Carbon::parse($assinatura->data_efetivacao)->format('d/m/Y') : "N/I" }}</td>
                            <td>{{ $assinatura->data_expiracao != null ? \Carbon\Carbon::parse($assinatura->data_expiracao)->format('d/m/Y') : "N/I" }}</td>
                            <td>{{ $assinatura->codigo_assinatura }}</td>
                            <td>{{ \App\Assinatura::SITUACAO[$assinatura->situacao] }}</td>
                            <td>{{ count(\App\AssinaturaEnviada::getEnvios($assinatura->id, 1)) }} / {{ \App\Assinatura::getProduto($assinatura->id_produto)->vigencia }}</td>
                            <td>{{ $assinatura->status != 0 ? \App\Assinatura::STATUS_ORDER[$assinatura->status] : "Aguardando pagamento"}}</td>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#assinatura{{$assinatura->id}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
@extends('admin.layouts.app')

@section('title', 'Detalhar cliente')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Detalhar cliente</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('cliente') }}">Clientes</a></li>
                    <li class="active">Detalhar cliente</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Detalhes do cliente

                        {{--<div class="panel-action">--}}
                            {{--<a class="btn btn-danger delete-button submit-form" style="margin-top:-8px;display:none"><i class="fa fa-trash"></i> Deletar</a>--}}
                            {{--<a href="{{ url('admin/clientescliente }}" class="btn btn-info text-white" style="margin-top:-8px;"><i class="fa fa-plus"></i> Criar produto</a>--}}
                        {{--</div>--}}
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <h2 class="m-t-0">{{ $cliente->name }}</h2>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="well">
                                        <h3>
                                            Dados Cadastrais
                                            <a class="btn btn-info btn-circle pull-right" href="{{ url('admin/cliente/'.$cliente->id.'/editar') }}"><i class="fa fa-edit"></i></a>
                                        </h3>
                                        <p>
                                            @if(!empty($cliente->document == 'CPF'))
                                                CPF: <span style="font-weight:500">{{ $cliente->cpf }}</span><br />
                                            @else
                                                CNPJ: <span style="font-weight:500">{{ $cliente->cnpj }}</span><br />
                                                Insc. Est.: <span style="font-weight:500">{{ $cliente->insc_estadual }}</span><br />
                                                Razão Social: <span style="font-weight:500">{{ $cliente->razao_social }}</span><br />
                                            @endif
                                            <hr>
                                            Email: <span style="font-weight:500">{{ $cliente->email }}</span><br />
                                            @if(!empty($cliente->genre))
                                                Sexo: <span style="font-weight:500">{{ ($cliente->genre == 'M') ? 'Masculino' : 'Feminino' }}</span><br />
                                            @endif
                                            @if(!empty($cliente->cell))
                                                Celular: <span style="font-weight:500">{{ $cliente->cell }}</span><br />
                                            @endif
                                            @if(!empty($cliente->phone))
                                                Telefone Fixo: <span style="font-weight:500">{{ $cliente->phone }}</span><br />
                                            @endif
                                            @if(!empty($cliente->phone_work))
                                                Telefone Comercial: <span style="font-weight:500">{{ $cliente->phone_work }}</span><br />
                                            @endif
                                            @if(!empty($cliente->data_nasc) && $cliente->data_nasc != '0000-00-00')
                                                Data Nascimento: <span style="font-weight:500">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $cliente->data_nasc)->format('d/m/Y') }}</span><br />
                                            @endif
                                        </p>
                                    </div>

                                    {{--<button class="btn btn-primary waves-effect waves-light">--}}
                                        {{--<span>Redefinir senha</span>--}}
                                    {{--</button>--}}
                                    {{--<button class="btn btn-danger waves-effect waves-light">--}}
                                        {{--<span>Desativar cliente</span>--}}
                                    {{--</button>--}}
                                </div>
                                <div class="col-md-6">
                                    <div class="well">
                                        <h3>Endereços</h3>
                                        <form action="{{ url('admin/cliente/'.$cliente->id.'/endereco/alterar/principal') }}" method="POST">
                                            {{ csrf_field() }}
                                            <p>
                                                @foreach($enderecos as $endereco)
                                                <div class="endereco p-b-10 {{ ($loop->first) ? '' : 'p-t-20' }}" style="{{ ($loop->last) ? '' : 'border-bottom:2px dotted #edeff0' }}">
                                                    @if($endereco->tipo == 'APTO')
                                                        <h3>
                                                            Apartamento
                                                            <span class="pull-right">
                                                                <a class="btn btn-info btn-circle waves-effect waves-light" href="{{ url('admin/cliente/'.$cliente->id.'/endereco/'.$endereco->id.'/editar') }}"><i class="fa fa-edit"></i></a>
                                                                @if(!$endereco->is_main)
                                                                <a class="btn btn-danger btn-circle waves-effect waves-light" href="{{ url('admin/cliente/'.$cliente->id.'/endereco/'.$endereco->id.'/deletar') }}"><i class="fa fa-trash"></i></a>
                                                                @endif
                                                            </span>
                                                        </h3>
                                                    @elseif($endereco->tipo == 'CASA')
                                                        <h3>
                                                            Casa
                                                            <span class="pull-right">
                                                                <a class="btn btn-info btn-circle waves-effect waves-light" href="{{ url('admin/cliente/'.$cliente->id.'/endereco/'.$endereco->id.'/editar') }}"><i class="fa fa-edit"></i></a>
                                                                @if(!$endereco->is_main)
                                                                <a class="btn btn-danger btn-circle waves-effect waves-light" href="{{ url('admin/cliente/'.$cliente->id.'/endereco/'.$endereco->id.'/deletar') }}"><i class="fa fa-trash"></i></a>
                                                                @endif
                                                            </span>
                                                        </h3>
                                                    @elseif($endereco->tipo == 'COM')
                                                        <h3>
                                                            Comercial
                                                            <span class="pull-right">
                                                                <a class="btn btn-info btn-circle waves-effect waves-light" href="{{ url('admin/cliente/'.$cliente->id.'/endereco/'.$endereco->id.'/editar') }}"><i class="fa fa-edit"></i></a>
                                                                @if(!$endereco->is_main)
                                                                <a class="btn btn-danger btn-circle waves-effect waves-light" href="{{ url('admin/cliente/'.$cliente->id.'/endereco/'.$endereco->id.'/deletar') }}"><i class="fa fa-trash"></i></a>
                                                                @endif
                                                            </span>
                                                        </h3>
                                                    @elseif($endereco->tipo == 'OUTRO')
                                                        <h3>
                                                            {{ $endereco->qual }}
                                                            <span class="pull-right">
                                                                <a class="btn btn-info btn-circle waves-effect waves-light" href="{{ url('admin/cliente/'.$cliente->id.'/endereco/'.$endereco->id.'/editar') }}"><i class="fa fa-edit"></i></a>
                                                                @if(!$endereco->is_main)
                                                                <a class="btn btn-danger btn-circle waves-effect waves-light" href="{{ url('admin/cliente/'.$cliente->id.'/endereco/'.$endereco->id.'/deletar') }}"><i class="fa fa-trash"></i></a>
                                                                @endif
                                                            </span>
                                                        </h3>
                                                    @endif
                                                    {{ $endereco->nome }}<br />
                                                    {{ $endereco->endereco }}{{ (!empty($endereco->numero)) ? ', '.$endereco->numero : '' }}{{ (!empty($endereco->complemento)) ? ', '.$endereco->complemento : '' }}<br />
                                                    {{ $endereco->cep }} - {{ $endereco->bairro }}<br />
                                                    {{ $endereco->cidade }}/{{ $endereco->estado }}

                                                    <div class="form-group m-t-10 p-b-5 text-center">
                                                        <div class="col-md-12">
                                                            <div class="radio radio-primary radio-inline">
                                                                <input id="is_main_{{ $endereco->id }}" name="is_main" type="radio" value="{{ $endereco->id }}" {{ ($endereco->is_main) ? 'checked' : '' }} onchange="submit(this)">
                                                                <label for="is_main_{{ $endereco->id }}"> Selecionar como principal </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach

                                                <a class="btn btn-primary btn-block btn-outline waves-effect waves-light btn-lg btn-rounded" href="{{ url('admin/cliente/'.$cliente->id.'/endereco/criar') }}">
                                                    <i class="fa fa-plus-circle"></i> <span>Novo endereço</span>
                                                </a>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Pedidos
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <p>Não existem pedidos cadastrados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    @if(session('status'))
        <div class="alert alert-success alert-dismissable alert-fixed">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
            <i class="ti-check"></i> {{ session('status') }}
        </div>
    @endif
@endsection

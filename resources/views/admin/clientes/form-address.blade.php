@extends('admin.layouts.app')

@section('title', $title['title'].' endereço')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{ $title['title'] }} endereço</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('cliente') }}">Clientes</a></li>
                    <li><a href="{{ url('/admin/cliente/'.$cliente_id.'/detalhar') }}">Detalhar Cliente</a></li>
                    <li class="active">{{ $title['title'] }} endereço</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>


        <form class="form-material form-horizontal" role="form" method="POST" action="{{ (isset($endereco->id)) ? url('admin/cliente/'.$cliente_id.'/endereco/'.$endereco->id.'/salvar') : url('admin/cliente/'.$cliente_id.'/endereco/salvar') }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Dados Endereço
                        </div>

                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">

                                <div class="form-group{{ ($errors->has('qual')) ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        <label for="tipo">Tipo de endereço</label>
                                        <select class="form-control form-control-line select2 type_address" name="tipo" id="tipo">
                                            <option value="APTO" {{ (isset($endereco->id) && $endereco->tipo == 'APTO') ? 'selected' : '' }}>Apartamento</option>
                                            <option value="CASA" {{ (isset($endereco->id) && $endereco->tipo == 'CASA') ? 'selected' : '' }}>Casa</option>
                                            <option value="COM" {{ (isset($endereco->id) && $endereco->tipo == 'COM') ? 'selected' : '' }}>Comercial</option>
                                            <option value="OUTRO" {{ (isset($endereco->id) && $endereco->tipo == 'OUTRO' || old('tipo') == 'OUTRO') ? 'selected' : '' }}>Outro</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="is_qual" style="{{ (isset($endereco->id) && $endereco->tipo == 'OUTRO' or $errors->has('qual')) ? 'display:block' : 'display:none' }}">
                                        <label for="qual">Qual?</label>
                                        <input class="form-control form-control-line" name="qual" id="qual" value="{{ $endereco->qual or '' }}" placeholder="Qual?"/>
                                        @if ($errors->has('qual'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('qual') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ ($errors->has('nome')) ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="nome">Nome do destinatário</label>
                                        <input type="text" class="form-control form-control-line" name="nome" id="nome" value="{{ $endereco->nome or '' }}">
                                        @if ($errors->has('nome'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('nome') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ ($errors->has('cep')) ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        <label for="cep">CEP</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-line cep" name="cep" id="cep" value="{{ $endereco->cep or '' }}" placeholder="00000-000">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary" id="consulta-cep" data-loading-text="Consultando...">
                                                    <i class="fa fa-search"></i> Consultar
                                                </button>
                                            </div>
                                        </div>
                                        <span class="help-block text-danger" id="error-cep">
                                            {{ $errors->first('cep') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group{{ ($errors->has('endereco') or $errors->has('numero')) ? ' has-error' : '' }}">
                                    <div class="col-md-5">
                                        <label for="endereco">Endereço</label>
                                        <input type="text" class="form-control form-control-line" name="endereco" id="endereco" value="{{ $endereco->endereco or '' }}">
                                        @if ($errors->has('endereco'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('endereco') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-1">
                                        <label for="numero">Número</label>
                                        <input type="text" class="form-control form-control-line" name="numero" id="numero" value="{{ $endereco->numero or '' }}">
                                        @if ($errors->has('numero'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('numero') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label for="complemento">Complemento</label>
                                        <input type="text" class="form-control form-control-line" name="complemento" id="complemento" value="{{ $endereco->complemento or '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="referencia">Informações de referência</label>
                                        <input type="text" class="form-control form-control-line" name="referencia" id="referencia" value="{{ $endereco->referencia or '' }}">
                                    </div>
                                </div>

                                <div class="form-group{{ ($errors->has('bairro') or $errors->has('cidade')) ? ' has-error' : '' }}">
                                    <div class="col-md-5">
                                        <label for="bairro">Bairro</label>
                                        <input type="text" class="form-control form-control-line" name="bairro" id="bairro" value="{{ $endereco->bairro or '' }}">
                                        @if ($errors->has('bairro'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('bairro') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cidade">Cidade</label>
                                        <input type="text" class="form-control form-control-line" name="cidade" id="cidade" value="{{ $endereco->cidade or '' }}">
                                        @if ($errors->has('cidade'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('cidade') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label for="estado">Estado</label>
                                        <select type="text" class="form-control form-control-line select2" name="estado" id="estado">
                                            @foreach(\App\UsersAddress::ESTADOS as $uf => $val)
                                            <option value="{{ $uf }}" {{ (isset($endereco->id) && $endereco->estado == $uf) ? 'selected' : '' }}>{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success waves-effect waves-light">
                <i class="fa fa-check"></i> Salvar {{ ($title['title'] == 'Editar') ? 'alterações' : '' }}
            </button>
            <a class="btn btn-default waves-effect waves-light" href="{{ url('admin/cliente/'.$cliente_id.'/detalhar') }}">
                <i class="fa fa-close"></i> Cancelar
            </a>
        </form>
    </div>
    <!-- /.container-fluid -->

    @if(session('status'))
        <div class="alert alert-success alert-dismissable alert-fixed">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
            <i class="ti-check"></i> {{ session('status') }}
        </div>
    @endif
@endsection

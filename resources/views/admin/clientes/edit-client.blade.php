@extends('admin.layouts.app')

@section('title', 'Editar cliente')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Editar cliente</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('cliente') }}">Clientes</a></li>
                    <li><a href="{{ url('/admin/cliente/'.$cliente->id.'/detalhar') }}">Detalhar Cliente</a></li>
                    <li class="active">Editar cliente</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>


        <form class="form-material form-horizontal" role="form" method="POST" action="{{ url('admin/cliente/'.$cliente->id.'/salvar') }}">
            {{ csrf_field() }}
            <input type="hidden" name="document" value="{{ $cliente->document }}">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Dados Cadastrais
                        </div>

                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">

                                <div class="form-group{{ ($errors->has('name') or $errors->has('email')) ? ' has-error' : '' }}">
                                    <div class="col-md-6">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control form-control-line" name="name" id="name" value="{{ $cliente->name }}">
                                        @if ($errors->has('name'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('name') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control form-control-line" name="email" id="email" value="{{ $cliente->email }}">
                                        @if ($errors->has('email'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if($cliente->document == 'CNPJ')
                                    <div class="form-group{{ ($errors->has('cnpj') or $errors->has('razao_social') or $errors->has('insc_estadual')) ? ' has-error' : '' }}">
                                        <div class="col-md-3">
                                            <label for="cnpj">CNPJ</label>
                                            <input type="text" class="form-control form-control-line cnpj" name="cnpj" id="cnpj" value="{{ $cliente->cnpj }}" placeholder="00.000.000/0000-00">
                                            @if ($errors->has('cnpj'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('cnpj') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label for="razao_social">Razão Social</label>
                                            <input type="text" class="form-control form-control-line" name="razao_social" id="razao_social" value="{{ $cliente->razao_social }}">
                                            @if ($errors->has('razao_social'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('razao_social') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label for="insc_estadual">Inscrição Estadual</label>
                                            <input type="text" class="form-control form-control-line" name="insc_estadual" id="insc_estadual" value="{{ $cliente->insc_estadual }}">
                                            @if ($errors->has('insc_estadual'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('insc_estadual') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group{{ ($errors->has('cpf')) ? ' has-error' : '' }}">
                                        <div class="col-md-3">
                                            <label for="cpf">CPF</label>
                                            <input type="text" class="form-control form-control-line cpf" name="cpf" id="cpf" value="{{ $cliente->cpf }}" placeholder="000.000.000-00">
                                            @if ($errors->has('cpf'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('cpf') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <label>Sexo:</label><br />
                                            <div class="radio radio-primary radio-inline">
                                                <input id="masculino" name="genre" type="radio" value="M" {{ ($cliente->genre == 'M') ? 'checked' : '' }}>
                                                <label for="masculino"> Masculino </label>
                                            </div>
                                            <div class="radio radio-primary radio-inline">
                                                <input id="feminino" name="genre" type="radio" value="F" {{ ($cliente->genre == 'F') ? 'checked' : '' }}>
                                                <label for="feminino"> Feminino </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="data_nasc">Data de nascimento</label>
                                            <div class="input-group">
                                                <input type="text" name="data_nasc" id="data_nasc" class="form-control form-control-line date datepicker" placeholder="00/00/0000" value="{{ ($cliente->data_nasc != '0000-00-00') ? \Carbon\Carbon::createFromFormat('Y-m-d', $cliente->data_nasc)->format('d/m/Y') : '' }}">
                                                <span class="input-group-addon"><i class="icon-calender"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group{{ ($errors->has('cpf')) ? ' has-error' : '' }}">
                                    <div class="col-md-4">
                                        <label for="cell">Celular</label>
                                        <input type="text" class="form-control form-control-line phone" name="cell" id="cell" value="{{ $cliente->cell }}" placeholder="(00) 00000-0000">
                                        @if ($errors->has('cell'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('cell') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone">Telefone fixo</label>
                                        <input type="text" class="form-control form-control-line phone" name="phone" id="phone" value="{{ $cliente->phone }}" placeholder="(00) 00000-0000">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone_work">Telefone comercial</label>
                                        <input type="text" class="form-control form-control-line phone" name="phone_work" id="phone_work" value="{{ $cliente->phone_work }}" placeholder="(00) 00000-0000">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success waves-effect waves-light">
                <i class="fa fa-check"></i> Salvar alterações
            </button>
            <a class="btn btn-default waves-effect waves-light" href="{{ url('admin/cliente/'.$cliente->id.'/detalhar') }}">
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

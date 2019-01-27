@extends('admin.layouts.app')

@section('title', $titles['title2'].' Variação')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{ $titles['title1'] }} variação</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/variacoes') }}">Variações</a></li>
                    <li class="active">{{ $titles['title2'] }} variação</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $titles['title1'] }} variação
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <form class="form-material form-horizontal" role="form" method="POST" action="{{ (isset($variacao->id)) ? url('admin/variacao/'.$variacao->id.'/salvar') : url('admin/variacao/salvar') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ ($errors->has('name')) ? ' has-error' : '' }}">
                                    <div class="col-md-10">
                                        <label for="name">Nome da Variação</label>
                                        <input type="text" class="form-control form-control-line" name="name" id="name" value="{{ $variacao->name or '' }}">
                                        @if ($errors->has('name'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('name') }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-2">
                                        <br />
                                        <button class="btn btn-success">
                                            <i class="fa fa-check"></i> {{ $titles['title2'] }} variação
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($variacao->id))
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ (isset($opcao->id)) ? 'Editar' : 'Criar' }} opção da Variação
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <form class="form-material form-horizontal" role="form" method="POST" action="{{ (isset($opcao->id)) ? url('admin/variacao/'.$variacao->id.'/opcao/'.$opcao->id.'/salvar') : url('admin/variacao/'.$variacao->id.'/opcao/criar') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group{{ ($errors->has('name')) ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control form-control-line" name="name" id="name" value="{{ $opcao->name or '' }}">
                                        @if ($errors->has('name'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('name') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ ($errors->has('value')) ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="value">Valor</label>
                                        <input type="text" class="form-control form-control-line" name="value" id="value" value="{{ $opcao->value or '' }}">
                                        @if ($errors->has('value'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('value') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label>{{ (isset($opcao->id)) ? 'Nova ' : '' }}Imagem</label>
                                        @if(isset($opcao->id))
                                            @if($opcao->image)
                                                <input type="file" name="image" class="dropify" data-default-file="{{ asset($opcao->image) }}" />
                                            @else
                                                <input type="file" name="image" class="dropify" />
                                            @endif
                                        @else
                                            <input type="file" name="image" class="dropify" />
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check"></i> {{ (isset($opcao->id)) ? 'Editar' : 'Criar' }} opção
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Opções da Variação

                        <div class="panel-action">
                            <a class="btn btn-danger delete-button submit-form" style="margin-top:-8px;display:none"><i class="fa fa-trash"></i> Deletar</a>
                            @if(isset($opcao->id))
                            <a href="{{ url('admin/variacao/'.$variacao->id.'/editar') }}" class="btn btn-info text-white" style="margin-top:-8px;"><i class="fa fa-plus"></i> Criar opção de variação</a>
                            @endif
                        </div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <form id="form-del" action="{{ url('admin/variacao/'.$variacao->id.'/opcao/remover') }}" method="POST">
                            {{ csrf_field() }}

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="position:relative;left:10px;" width="55">
                                            <div class="checkbox">
                                                <input id="checkall" type="checkbox" class="select-all open-delete">
                                                <label for="checkall">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th width="70" class="text-center">
                                            <i class="ti-image" style="font-size:24px"></i>
                                        </th>
                                        <th>Nome</th>
                                        <th>Valor</th>
                                        <th width="230">Produtos vinculados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($opcoes->total() < 1)
                                    <tr class="vt-middle">
                                        <td colspan="7" class="text-center">
                                            Ainda não existe nenhuma opção de variação cadastrada.
                                        </td>
                                    </tr>
                                @endif
                                @foreach($opcoes as $opc)
                                    <tr class="vt-middle">
                                        <td style="position:relative;left:10px;" width="55">
                                            <div class="checkbox">
                                                <input id="option{{ $opc->id }}" name="options[]" type="checkbox" class="open-delete" value="{{ $opc->id }}">
                                                <label for="option{{ $opc->id }}">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td align="center">
                                            @if($opc->image)
                                                <img src="{{ asset($opc->image) }}" alt="{{ $opc->name }}"  width="36" height="36">
                                            @else
                                                <i class="ti-image" style="font-size:24px"></i>
                                            @endif
                                        </td>
                                        <td><a href="{{ url('admin/variacao/'.$variacao->id.'/opcao/'.$opc->id.'/editar') }}" class="text-muted"><strong>{{ $opc->name }}</strong></a></td>
                                        <td class="text-center">{{ $opc->value }}</td>
                                        <td align="center">
                                            @php $count = \App\ProdutosVariacoes::getOptProductsLinked($opc->id) @endphp
                                            @if($count > 1)
                                                <span class="label label-table label-inverse">{{ $count }} produtos vinculados</span>
                                            @else
                                                <span class="label label-table label-inverse">{{ $count }} produto vinculado</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>

                        <span class="m-l-10">{{ $opcoes->links('vendor.pagination.bootstrap-4') }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- /.container-fluid -->

    <div class="delete-button delete-box">
        <button type="button" class="btn btn-danger btn-lg submit-form" style="margin-top:-8px;"><i class="fa fa-trash"></i> Deletar</>
    </div>
@endsection

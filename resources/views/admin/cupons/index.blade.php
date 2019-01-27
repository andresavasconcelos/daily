@extends('admin.layouts.app')

@section('title', 'Cupons de Desconto')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Cupons de Desconto</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/cupons') }}">Cupons de Desconto</a></li>
                    <li class="active">Listar Cupons de Desconto</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($cupons->total() > 1)
                            {{ $cupons->total() }} cupons no total - <small>Página {{ $cupons->currentPage() }} de {{ $cupons->lastPage() }}</small>
                        @else
                            {{ $cupons->total() }} cupom no total - <small>Página {{ $cupons->currentPage() }} de {{ $cupons->lastPage() }}</small>
                        @endif

                        <div class="panel-action">
                            <a class="btn btn-danger delete-button submit-form" style="margin-top:-8px;display:none"><i class="fa fa-trash"></i> Deletar</a>
                            <a href="{{ url('admin/cupom/criar') }}" class="btn btn-info text-white" style="margin-top:-8px;"><i class="fa fa-plus"></i> Criar cupom</a>
                        </div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <form id="form-del" action="{{ url('admin/cupom/remover') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="50" style="position:relative;left:10px;">
                                                <div class="checkbox">
                                                    <input id="checkall" type="checkbox" class="select-all open-delete">
                                                    <label for="checkall">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th width="50%">Cupom</th>
                                            <th>Quantidade</th>
                                            <th>Validade</th>
                                            <th>Utilizados</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($cupons->total() < 1)
                                        <tr class="vt-middle">
                                            <td colspan="7" class="text-center">
                                                Ainda não existe nenhum cupom de desconto cadastrado.<br /><br />
                                                <a href="{{ url('admin/cupom/criar') }}" class="btn btn-info">
                                                    <i class="fa fa-plus"></i> Criar o primeiro cupom de desconto
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($cupons as $cupom)
                                        <tr class="vt-middle">
                                            <td style="position:relative;left:10px;">
                                                <div class="checkbox">
                                                    <input id="option{{ $cupom->id }}" name="options[]" type="checkbox" class="open-delete" value="{{ $cupom->id }}">
                                                    <label for="option{{ $cupom->id }}">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/cupom/'.$cupom->id.'/editar') }}" class="text-muted">
                                                    <strong>{{ $cupom->code }}</strong><br />
                                                    <small>{{ $cupom->description }}</small>
                                                </a>
                                            </td>
                                            <td>{{ $cupom->qty }} unidades</td>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $cupom->data_end)->format('d/m/Y') }}</td>
                                            <td>
                                                @if($cupom->hits > 0)
                                                    {{ $cupom->hits }} usado
                                                @elseif($cupom->hits > 1)
                                                    {{ $cupom->hits }} usados
                                                @else
                                                    nenhum
                                                @endif
                                            </td>
                                            <td align="center">
                                                <span class="label label-{{ ($cupom->status) ? 'info' : 'inverse' }}">{{ ($cupom->status) ? 'Ativo' : 'Inativo' }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <span class="m-l-10">{{ $cupons->links('vendor.pagination.bootstrap-4') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <div class="delete-button delete-box">
        <a class="btn btn-danger btn-lg submit-form" style="margin-top:-8px;"><i class="fa fa-trash"></i> Deletar</a>
    </div>
    @if(session('status'))
        <div class="alert alert-success alert-dismissable alert-fixed">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
            <i class="ti-check"></i> {{ session('status') }}
        </div>
    @endif
@endsection

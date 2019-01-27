@extends('admin.layouts.app')

@section('title', 'Categorias')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Categorias</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li class="active">Catergorias</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($categorias->total() > 1)
                            {{ $categorias->total() }} categorias
                        @else
                            {{ $categorias->total() }} categoria
                        @endif

                        <div class="panel-action">
                            <a class="btn btn-danger delete-button submit-form" style="margin-top:-8px;display:none"><i class="fa fa-trash"></i> Deletar</a>
                            <a href="{{ url('admin/categoria/criar') }}" class="btn btn-info text-white" style="margin-top:-8px;"><i class="fa fa-plus"></i> Criar categoria</a>
                        </div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <form id="form-del" action="{{ url('admin/categoria/remover') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="position:relative;left:10px;" width="55">
                                                <div class="checkbox">
                                                    <input id="checkall" type="checkbox" class="select-all open-delete">
                                                    <label for="checkall">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>Nome</th>
                                            <th width="120">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($categorias->total() < 1)
                                        <tr class="vt-middle">
                                            <td colspan="7" class="text-center">
                                                Ainda não existe nenhuma categoria cadastrada.<br /><br />
                                                <a href="{{ url('admin/categoria/criar') }}" class="btn btn-info">
                                                    <i class="fa fa-plus"></i> Criar a primeira categoria
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($categorias as $categoria)
                                        <tr class="vt-middle">
                                            <td style="position:relative;left:10px;">
                                                <div class="checkbox">
                                                    <input id="option{{ $categoria->id }}" name="options[]" type="checkbox" class="open-delete" value="{{ $categoria->id }}">
                                                    <label for="option{{ $categoria->id }}">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/categoria/'.$categoria->id.'/editar') }}" class="text-muted">
                                                    <strong>{{ $categoria->title }}</strong>
                                                    @if($categoria->featured)
                                                    <a class="text-muted" data-toggle="tooltip" data-placement="right" title="Destaque">
                                                        <i class="fa fa-star" style="color:#FFBF66;"></i>
                                                    </a>
                                                    @endif
                                                </a>
                                            </td>
                                            <td align="center">
                                                <span class="label label-{{ ($categoria->status) ? 'success' : 'danger' }}">{{ ($categoria->status) ? 'Ativo' : 'Inativo' }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <span class="m-l-10">{{ $categorias->links('vendor.pagination.bootstrap-4') }}</span>
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
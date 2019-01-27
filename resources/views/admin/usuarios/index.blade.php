@extends('admin.layouts.app')

@section('title', 'Usuarios')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Usuarios</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/usuarios') }}">Usuarios</a></li>
                    <li class="active">Listar Usuarios</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <form class="form-material form-horizontal">
                        <div class="form-group m-b-0">
                            <div class="col-md-4">
                                <input type="text" class="form-control form-control-line" name="q" value="{{ Request::get('q') }}" placeholder="Nome ou E-mail do usuário">
                            </div>

                            <div class="col-md-2">
                                <select class="form-control form-control-line select2" name="filtro">
                                    <option value="">- Filtro -</option>
                                    <option value="ativo" {{ (Request::get('filtro') == 'ativo') ? 'selected' : '' }}>Ativos</option>
                                    <option value="inativo" {{ (Request::get('filtro') == 'inativo') ? 'selected' : '' }}>Inativos</option>
                                </select>
                            </div>

                            <div class="col-md-3 text-right">
                                <a href="{{ url('admin/usuarios') }}" class="btn btn-default">
                                    <i class="fa fa-times"></i> Limpar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-filter"></i> Filtrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($usuarios->total() > 1)
                            {{ $usuarios->total() }} usuarios no total - <small>Página {{ $usuarios->currentPage() }} de {{ $usuarios->lastPage() }}</small>
                        @else
                            {{ $usuarios->total() }} usuario no total - <small>Página {{ $usuarios->currentPage() }} de {{ $usuarios->lastPage() }}</small>
                        @endif

                        <div class="panel-action">
                            <a class="btn btn-danger delete-button submit-form" style="margin-top:-8px;display:none"><i class="fa fa-trash"></i> Deletar</a>
                            <a href="{{ url('admin/usuario/criar') }}" class="btn btn-info text-white" style="margin-top:-8px;"><i class="fa fa-plus"></i> Criar usuário</a>
                        </div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <form id="form-del" action="{{ url('admin/usuario/remover') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="position:relative;left:10px;" width="50">
                                                <div class="checkbox">
                                                    <input id="checkall" type="checkbox" class="select-all open-delete">
                                                    <label for="checkall">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th width="80" class="text-center">
                                                <i class="ti-image" style="font-size:24px"></i>
                                            </th>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($usuarios->total() < 1)
                                        <tr class="vt-middle">
                                            <td colspan="7" class="text-center">
                                                Ainda não existe nenhum usuário cadastrado.<br /><br />
                                                <a href="{{ url('admin/usuario/criar') }}" class="btn btn-info">
                                                    <i class="fa fa-plus"></i> Criar o primeiro usuário
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($usuarios as $user)
                                        <tr class="vt-middle">
                                            <td style="position:relative;left:10px;">
                                                <div class="checkbox">
                                                    <input id="option{{ $user->id }}" name="options[]" type="checkbox" class="open-delete" value="{{ $user->id }}">
                                                    <label for="option{{ $user->id }}">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td align="center">
                                                @if($user->photo)
                                                    <img src="{{ asset($user->photo) }}" alt="{{ $user->photo }}" width="50" class="img-circle">
                                                @else
                                                    <i class="ti-image" style="font-size:24px"></i>
                                                @endif
                                            </td>
                                            <td><a href="{{ url('admin/usuario/'.$user->id.'/editar') }}" class="text-muted"><strong>{{ $user->name }}</strong></a></td>
                                            <td>{{ $user->email }}</td>
                                            <td align="center">
                                                <span class="label label-{{ ($user->status) ? 'info' : 'inverse' }}">{{ ($user->status) ? 'Ativo' : 'Inativo' }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <span class="m-l-10">{{ $usuarios->links('vendor.pagination.bootstrap-4') }}</span>
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

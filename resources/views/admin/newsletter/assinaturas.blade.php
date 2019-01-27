@extends('admin.layouts.app')

@section('title', 'Assinaturas / Newsletter')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Assinaturas</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li class="active">Assinaturas</li>
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
                                <input type="text" class="form-control form-control-line" name="q" value="{{ Request::get('q') }}" placeholder="Nome ou E-mail">
                            </div>

                            <div class="col-md-3">
                                <select class="form-control form-control-line select2" name="listagem">
                                    <option value="alfabetica" {{ (Request::get('listagem') == 'alfabetica') ? 'selected' : '' }}>Ordem alfabética</option>
                                    <option value="ultimos" {{ (Request::get('listagem') == 'ultimos') ? 'selected' : '' }}>Últimos cadastrados</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select class="form-control form-control-line select2" name="filtro">
                                    <option value="">- Filtro -</option>
                                    <option value="ativo" {{ (Request::get('filtro') == 'ativo') ? 'selected' : '' }}>Ativos</option>
                                    <option value="inativo" {{ (Request::get('filtro') == 'inativo') ? 'selected' : '' }}>Inativos</option>
                                </select>
                            </div>

                            <div class="col-md-3 text-right">
                                <a href="{{ url('admin/newsletter/assinaturas') }}" class="btn btn-default">
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
                        @if($news->total() > 1)
                            {{ $news->total() }} assinaturas no total - <small>Página {{ $news->currentPage() }} de {{ $news->lastPage() }}</small>
                        @else
                            {{ $news->total() }} assinatura no total - <small>Página {{ $news->currentPage() }} de {{ $news->lastPage() }}</small>
                        @endif

                        <div class="panel-action">
                            <a class="btn btn-danger delete-button submit-form" style="margin-top:-8px;display:none"><i class="fa fa-trash"></i> Deletar</a>
                            {{--<a href="{{ url('admin/newsletter/assinaturas/exportar') }}" class="btn btn-info text-white" style="margin-top:-8px;"><i class="fa fa-download"></i> Exportar em CSV</a>--}}

                            <form class="form-material form-horizontal" role="form" action="{{ url('admin/newsletter/assinaturas/exportar') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="form-group m-b-0 p-t-0" style="margin-top:-18px">
                                    <div class="input-group m-t-10">
                                        <select id="file_type" name="file_type" class="form-control form-control-line select2">
                                            <option value="xlsx">XLSX</option>
                                            <option value="xls">XLS</option>
                                            <option value="csv">CSV</option>
                                        </select>
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn waves-effect waves-light btn-info">
                                                <i class="fa fa-download"></i> Exportar
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <form id="form-del" action="{{ url('admin/newsletter/assinaturas/remover') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="55" style="position:relative;left:10px;">
                                                <div class="checkbox">
                                                    <input id="checkall" type="checkbox" class="select-all open-delete">
                                                    <label for="checkall">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th width="120">Data</th>
                                            <th>Email</th>
                                            <th>Nome</th>
                                            <th>Tipo</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($news->total() < 1)
                                        <tr class="vt-middle">
                                            <td colspan="5" class="text-center">
                                                Ainda não existe nenhuma assinatura cadastrada.
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($news as $newsletter)
                                        <tr class="vt-middle">
                                            <td style="position:relative;left:10px;">
                                                <div class="checkbox">
                                                    <input id="option{{ $newsletter->id }}" name="options[]" type="checkbox" class="open-delete" value="{{ $newsletter->id }}">
                                                    <label for="option{{ $newsletter->id }}">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $newsletter->created_at)->format('d/m/y H:i') }}</td>
                                            <td>{{ $newsletter->email }}</td>
                                            <td>{{ $newsletter->name }}</td>
                                            <td class="text-center">
                                                <span class="label label-{{ ($newsletter->type_access == 'CLI') ? 'success' : 'primary' }}">{{ ($newsletter->type_access == 'CLI') ? 'Cliente' : 'Visitante' }}</span>
                                            </td>
                                            <td align="center">
                                                <span class="label label-{{ ($newsletter->status) ? 'info' : 'inverse' }}">{{ ($newsletter->status) ? 'Ativo' : 'Inativo' }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <span class="m-l-10">{{ $news->links('vendor.pagination.bootstrap-4') }}</span>
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

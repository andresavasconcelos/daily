@extends('admin.layouts.app')

@section('title', 'Enviar / Newsletter')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Fila de Envio</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li class="active">Fila de Envio</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($filas->total() > 1)
                            {{ $filas->total() }} envios no total - <small>Página {{ $filas->currentPage() }} de {{ $filas->lastPage() }}</small>
                        @else
                            {{ $filas->total() }} envio no total - <small>Página {{ $filas->currentPage() }} de {{ $filas->lastPage() }}</small>
                        @endif
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="150">Envio iniciado</th>
                                        <th width="150">Envio finalizado</th>
                                        <th>Assunto</th>
                                        <th width="100">Status</th>
                                        <th>Processado</th>
                                        <th>Assinantes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($filas->total() < 1)
                                    <tr class="vt-middle">
                                        <td colspan="6" class="text-center">
                                            Ainda não foi feito nenhum envio.
                                        </td>
                                    </tr>
                                @endif
                                @foreach($filas as $fila)
                                    <tr class="vt-middle">
                                        <td>{{ ($fila->data_start) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $fila->data_start)->format('d/m/Y H:i') : '----' }}</td>
                                        <td>{{ ($fila->data_end) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $fila->data_end)->format('d/m/Y H:i') : '----' }}</td>
                                        <td>{{ \App\NewsletterModels::getSubject($fila->id_model) }}</td>
                                        <td align="center">
                                            @if($fila->status == 0)
                                                <span class="label label-inverse">{{ \App\NewsletterSend::STATUS[$fila->status] }}</span>
                                            @elseif($fila->status == 1)
                                                <span class="label label-info }}">{{ \App\NewsletterSend::STATUS[$fila->status] }}</span>
                                            @elseif($fila->status == 2)
                                                <span class="label label-danger">{{ \App\NewsletterSend::STATUS[$fila->status] }}</span>
                                            @elseif($fila->status == 3)
                                                <span class="label label-success">{{ \App\NewsletterSend::STATUS[$fila->status] }}</span>
                                            @elseif($fila->status == 4)
                                                <span class="label label-warning">{{ \App\NewsletterSend::STATUS[$fila->status] }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $fila->proccessed }}</td>
                                        <td>{{ $fila->subscribers }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <span class="m-l-10">{{ $filas->links('vendor.pagination.bootstrap-4') }}</span>
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

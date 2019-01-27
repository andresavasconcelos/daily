@extends('layout_admin.app')
@section('scripts')
    <script>
        $(document).ready(function () {
            var table = $('#tabelaEventos').DataTable({
                "order": [[ 5, "desc"]],
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "aoColumns": [
                    { "bSearchable": true },
                    { "bSearchable": true },
                    { "bSearchable": false },
                    { "bSearchable": false },
                    { "bSearchable": false },
                    { "bSearchable": false },
                    { "bSearchable": false },
                    { "bSearchable": false },
                    { "bSearchable": false },
                    { "bSearchable": false },
                    { "bSearchable": false },
                    { "bSearchable": false }
                ],
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "<i class='fa fa-arrow-right'></i>",
                        "sPrevious": "<i class='fa fa-arrow-left'></i>",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                }
            });
        });


    </script>
@endsection

@section('content')

    <section class="content-header">
        <h1>
            Eventos
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/painel') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">/Eventos</li>
        </ol>
    </section>

    <section class="content">

        @if(session()->has('success'))

            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session()->get('success') }}
            </div>

        @endif

        @if(session()->has('error'))

            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session()->get('error') }}
            </div>

        @endif


        <div class="row">
            <div class="col-12">

                <div class="text-right mb-3">
                    @if(Request("titulo") != "" || Request("data") != "")
                        <a href="{{ url("/admin/eventos") }}" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Limpar filtro</a>
                    @endif
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-chevron-down"></i> Filtrar
                    </a>

                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form action="{{ url("admin/eventos") }}" method="get" id="filtro">
                                <div class="row">
                                    <div class="col-4 col-lg-4">
                                        <div class="form-group">
                                            <input type="text" id="titulo" placeholder="Titulo" name="titulo" value="{{ Request("titulo") }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-4 col-lg-4">
                                        <div class="form-group">
                                            <input type="date" id="data" name="data" placeholder="data" value="{{ Request("data") }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-12 text-right">
                                        <button type="submit" class="btn btn-primary">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista Eventos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="tabelaEventos" class="table">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Resenha</th>
                                <th style="width: 12%;">Data</th>
                                <th>Destaque</th>
                                <th>Ação</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($eventos as $evento)
                                <tr>
                                    <td>{{ $evento->titulo }}</td>
                                    <td>{{ $evento->resenha }}</td>
                                    <td>{{ $evento->data}}</td>
                                    @if( $evento->is_featured == 0 )
                                        <td class="">Não</td>
                                    @elseif( $evento->is_featured == 1 )
                                        <td class="">Sim <i class="fa fa-star" aria-hidden="true"></i></td>
                                    @endif
                                    <td>
                                        {{--<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detalhesAssinantes{{ $materia->id }}"><i class="fa fa-eye"></i> Detalhes</button>--}}
                                        <a href="{{ url('/admin/evento/'.$evento->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Galeria</a>
                                        <a href="{{ url('/admin/evento/editar/'.$evento->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Editar</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layout_admin.app')
@section('scripts')
    <script>
        $(document).ready(function () {
            var table = $('#tabelaMaterias').DataTable({
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

    {{--@foreach($materias as $materia)--}}
        {{--<!-- Modal -->--}}
        {{--<div class="modal fade detalhesAssinantes" id="detalhesAssinantes{{ $materia->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
            {{--<div class="modal-dialog modal-lg" role="document">--}}
                {{--<div class="modal-content">--}}
                    {{--<div class="modal-header">--}}
                        {{--<h5 class="modal-title" id="exampleModalLabel">Informações de {{ $materia->name }}</h5>--}}
                        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                            {{--<span aria-hidden="true">&times;</span>--}}
                        {{--</button>--}}
                    {{--</div>--}}
                    {{--<div class="modal-body">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="">Nome:</label>--}}
                                    {{--<input type="text" class="form-control" value="{{ $materia->name }}" disabled>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="">Email:</label>--}}
                                    {{--<input type="text" class="form-control" value="{{ $materia->email }}" disabled>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--@if($materia->cpf != '')--}}
                                {{--<div class="col-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="">CPF:</label>--}}
                                        {{--<input type="text" class="form-control" value="{{ $materia->cpf }}" disabled>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                            {{--@if($materia->cnpj != '')--}}
                                {{--<div class="col-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="">CNPJ:</label>--}}
                                        {{--<input type="text" class="form-control" value="{{ $materia->cnpj }}" disabled>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                            {{--<div class="col-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="">Celular:</label>--}}
                                    {{--<input type="text" class="form-control" value="{{ $materia->celular != '' ? $materia->celular : 'N/I'}}" disabled>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="">Telefone:</label>--}}
                                    {{--<input type="text" class="form-control" value="{{ $materia->telefone != '' ? $materia->telefone : 'N/I'}}" disabled>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="">CEP:</label>--}}
                                    {{--<input type="text" class="form-control" value="{{ $materia->cep }}" disabled>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="">Endereço:</label>--}}
                                    {{--<input type="text" class="form-control" value="{{ $materia->address }}" disabled>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="">Número:</label>--}}
                                    {{--<input type="text" class="form-control" value="{{ $materia->numero }}" disabled>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="">Complemento:</label>--}}
                                    {{--<input type="text" class="form-control" value="{{ $materia->complemento }}" disabled>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="">Bairro:</label>--}}
                                    {{--<input type="text" class="form-control" value="{{ $materia->bairro }}" disabled>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="">Cidade:</label>--}}
                                    {{--<input type="text" class="form-control" value="{{ $materia->cidade }}" disabled>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="">Estado:</label>--}}
                                    {{--<input type="text" class="form-control" value="{{ $materia->estado }}" disabled>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--@endforeach--}}

    <section class="content-header">
        <h1>
            Matérias
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/painel') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{ url('admin/materias') }}">/Matérias</a></li>
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

                    @if(Request("name") != "" || Request("email") != "" || Request("cpf") != "" || Request("cnpj") != "" || Request("status") != "")
                        <a href="{{ url("/admin/materias") }}" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Limpar filtro</a>
                    @endif

                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-chevron-down"></i> Filtrar
                    </a>

                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form action="{{ url("admin/materias") }}" method="get" id="filtro">
                                <div class="row">
                                    <div class="col-4 col-lg-4">
                                        <div class="form-group">
                                            <input type="text" id="name" placeholder="Nome" name="name" value="{{ Request("name") }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-4 col-lg-4">
                                        <div class="form-group">
                                            <input type="email" id="email" placeholder="Email" name="email" value="{{ Request("email") }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-4 col-lg-4">
                                        <div class="form-group">
                                            <input type="text" id="cpf" name="cpf" placeholder="cpf" value="{{ Request("cpf") }}" class="form-control cpf">
                                        </div>
                                    </div>

                                    <div class="col-4 col-lg-4">
                                        <div class="form-group">
                                            <input type="text" id="cnpj" name="cnpj" placeholder="cnpj" value="{{ Request("cnpj") }}" class="form-control">
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
                        <h3 class="card-title">Lista Matérias</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="tabelaMaterias" class="table">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Resenha</th>
                                <th>destaque</th>
                                <th>status</th>
                                <th>Ação</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($materias as $materia)
                                <tr>
                                    <td>{{ $materia->titulo }}</td>
                                    <td>{{ $materia->resenha }}</td>
                                    @if( $materia->is_featured == 0 )
                                        <td class="">Não</td>
                                    @elseif( $materia->is_featured == 1 )
                                        <td class="">Sim <i class="fa fa-star" aria-hidden="true"></i></td>
                                    @endif
                                    @if( $materia->status == 0 )
                                        <td class="">Inativo</td>
                                    @elseif( $materia->status == 1 )
                                        <td class="">Ativo</td>
                                    @endif
                                    <td>
                                        {{--<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detalhesAssinantes{{ $materia->id }}"><i class="fa fa-eye"></i> Detalhes</button>--}}
                                        <a href="{{ url('/admin/materia/editar/'.$materia->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Editar</a>
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

@extends('layout_admin.app')
@section('scripts')
    <script>
        $(document).ready(function () {
            var table = $('#tabelaAssinantes').DataTable({
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

    @foreach($assinantes as $assinante)
        <!-- Modal -->
        <div class="modal fade detalhesAssinantes" id="detalhesAssinantes{{ $assinante->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Informações de {{ $assinante->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nome:</label>
                                    <input type="text" class="form-control" value="{{ $assinante->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Email:</label>
                                    <input type="text" class="form-control" value="{{ $assinante->email }}" disabled>
                                </div>
                            </div>
                            @if($assinante->cpf != '')
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">CPF:</label>
                                    <input type="text" class="form-control" value="{{ $assinante->cpf }}" disabled>
                                </div>
                            </div>
                            @endif
                            @if($assinante->cnpj != '')
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">CNPJ:</label>
                                    <input type="text" class="form-control" value="{{ $assinante->cnpj }}" disabled>
                                </div>
                            </div>
                            @endif
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Celular:</label>
                                    <input type="text" class="form-control" value="{{ $assinante->celular != '' ? $assinante->celular : 'N/I'}}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Telefone:</label>
                                    <input type="text" class="form-control" value="{{ $assinante->telefone != '' ? $assinante->telefone : 'N/I'}}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">CEP:</label>
                                    <input type="text" class="form-control" value="{{ $assinante->cep }}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Endereço:</label>
                                    <input type="text" class="form-control" value="{{ $assinante->address }}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Número:</label>
                                    <input type="text" class="form-control" value="{{ $assinante->numero }}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Complemento:</label>
                                    <input type="text" class="form-control" value="{{ $assinante->complemento }}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Bairro:</label>
                                    <input type="text" class="form-control" value="{{ $assinante->bairro }}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Cidade:</label>
                                    <input type="text" class="form-control" value="{{ $assinante->cidade }}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Estado:</label>
                                    <input type="text" class="form-control" value="{{ $assinante->estado }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <section class="content-header">
        <h1>
            Assinantes
            {{--<small>Cardapio completo</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/painel') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">/Assinantes</li>
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
                        <a href="{{ url("/admin/assinantes") }}" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Limpar filtro</a>
                    @endif

                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-chevron-down"></i> Filtrar
                    </a>

                    <a href="{{ url('/admin/assinantes/exportar?name='.Request('name').'&email='.Request('email').'&cpf='.Request('cpf').'&cnpj='.Request('cnpj').'&status='.Request('status')) }}" class="btn btn-primary"><i class="fa fa-download"></i> Exportar para excel</a>


                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form action="{{ url("admin/assinantes") }}" method="get" id="filtro">
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

                                    <div class="col-4 col-lg-4">
                                        <div class="form-group">
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Status de pagamento</option>

                                                @foreach(\App\Assinatura::STATUS_ORDER as $key => $status)
                                                    <option {{ Request("status") == $key ? "selected" : "" }} value="{{ $key }}">{{ $status }}</option>
                                                @endforeach
                                            </select>
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
                        <h3 class="card-title">Lista assinantes</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="tabelaAssinantes" class="table">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Email</th>
                                    {{--<th>CPF</th>--}}
                                    {{--<th>CNPJ</th>--}}
                                    <th>Celular</th>
                                    <th>Telefone</th>
                                    <th>Qtd. Assinaturas</th>
                                    <th>Data Cadastro</th>
                                    <th>Ação</th>
                                    {{--<th>CEP</th>--}}
                                    {{--<th>Endereço</th>--}}
                                    {{--<th>Complemento</th>--}}
                                    {{--<th>Bairro</th>--}}
                                    {{--<th>Cidade</th>--}}
                                    {{--<th>Estado</th>--}}
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($assinantes as $assinante)
                                    <tr>
                                        <td>{{ $assinante->name }}</td>
                                        <td>{{ $assinante->email }}</td>
                                        {{--<td>{{ $assinante->cpf }}</td>--}}
                                        {{--<td>{{ $assinante->cnpj }}</td>--}}
                                        <td>{{ $assinante->celular }}</td>
                                        <td>{{ $assinante->telefone }}</td>
                                        <td>{{ $assinante->qtdAssinaturas }}</td>
                                        <td>{{ $assinante->created_at }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detalhesAssinantes{{ $assinante->id }}"><i class="fa fa-eye"></i> Detalhes</button>
                                            <a href="{{ url('/admin/assinante/'.$assinante->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Editar</a>
                                        </td>
                                        {{--<td>{{ $assinante->cep }}</td>--}}
                                        {{--<td>{{ $assinante->address }}</td>--}}
                                        {{--<td>{{ $assinante->complemento }}</td>--}}
                                        {{--<td>{{ $assinante->bairro }}</td>--}}
                                        {{--<td>{{ $assinante->cidade }}</td>--}}
                                        {{--<td>{{ $assinante->estado }}</td>--}}
                                        {{--<td>{{ $pedido->forma_pagamento == "Cartão" ? $pedido->forma_pagamento." - ".$pedido->bandeira : $pedido->forma_pagamento }}</td>--}}
                                        {{--@if($pedido->status == 0)--}}
                                            {{--<td class="tdAzul">Novo Pedido <i class="fa fa-star" aria-hidden="true"></i></td>--}}
                                        {{--@elseif($pedido->status == 1)--}}
                                            {{--<td class="tdAmarelo">Em preparo</td>--}}
                                        {{--@elseif($pedido->status == 2)--}}
                                            {{--<td class="tdVerdeEscuro">Finalizado</td>--}}
                                        {{--@elseif($pedido->status == 3)--}}
                                            {{--<td class="verdeClaro">Entregue</td>--}}
                                        {{--@endif--}}
                                        {{--<td><a href="{{ url('admin/pedido/'.$assinante->id.'/detalhes') }}" class="btn btnMarrom">Detalhes</a></td>--}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $assinantes->appends(["name" => Request::input("name"), "email" => Request::input("email")])->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layout_admin.app')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <section class="content-header">
                    <h1>
                        Ediçao
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home /</a></li>
                        <li class="active"> Edição /</li>
                        <li class="active"> Adicionar</li>
                    </ol>
                </section>

                @foreach($errors->all() as $message)
                    <div class="col-md-12 col-xs-12">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ $message }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-10 offset-lg-1">
                <section class="content pgAdicionar">
                    <div class="card-header">
                        <h3 class="card-title">ADICIONAR EDIÇÃO</h3>
                    </div>

                    <form action="{{ url('/admin/edicao/adicionar') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input type="text" class="form-control" id="titulo" placeholder="" name="titulo" value="{{ old('titulo') }}">
                        </div>

                        <div class="form-group">
                            <label for="descricao">Editorial:</label>
                            <textarea class="form-control conteudo" name="descricao" id="descricao" cols="30" rows="10">{{ old('descricao') }}</textarea>
                        </div>

                        <div class="col-md-12 col-xs-12">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Imagem:</label>
                                            <input type="file" name="imagem" id="exampleInputFile" class="dropify">
                                            <input type="hidden" name="imagem" class="file" value="{{ old('imagem') }}">
                                            <p class="textAlerta"><small>*As imagens devem ter dimensão: 546x723(L/A) e máximo 2mb</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="row rowBotoes">
                                <button type="submit" class="btn btn-default">Adicionar</button>
                                <a href="{{ url('/admin/edicoes') }}" class="btn btn-default btnMarrom pull-right">Voltar</a>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
@endsection


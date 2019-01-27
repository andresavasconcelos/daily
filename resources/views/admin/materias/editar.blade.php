@extends('layout_admin.app')

@section('scripts')
    <script>
        function uploadFoto(event) {
            var file = event.target;
            var reader = new FileReader();

            reader.readAsDataURL(file.files[0]);

            reader.onloadend = function (){
                $('.file').val(reader.result);
                $('#imgPreview').attr('src', reader.result);
            }
        }
    </script>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <section class="content-header">
                    <h1>
                        Matéria
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home /</a></li>
                        <li class="active"> Matéria /</li>
                        <li class="active"> Editar</li>
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
                        <h3 class="card-title">EDITAR MATÉRIA</h3>
                    </div>

                    <form action="{{ url('admin/materia/editar/'.$editMateria->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="">Edição da Revista:</label>
                        <select class="custom-select" name="id_revista" id="inputGroupSelect01">
                            <option>Selecione</option>
                            @foreach($revistas as $revista)
                                <option value="{{ $revista->id }}" {{ $revista->id == $editMateria->id_revista ? 'selected' : '' }}>{{ $revista->titulo }}</option>
                            @endforeach
                        </select>

                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input type="text" class="form-control" id="titulo" placeholder="" name="titulo" value="{{ $editMateria->titulo }}">
                        </div>

                        <div class="form-group">
                            <label for="resenha">Resenha:</label>
                            <input type="text" class="form-control" id="resenha" placeholder="" name="resenha" value="{{ $editMateria->resenha }}">
                        </div>

                        <div class="form-group">
                            <label for="conteudo">Conteúdo:</label>
                            <textarea class="form-control conteudo" name="conteudo" id="conteudo" cols="30" rows="10">{{ $editMateria->conteudo }}</textarea>
                        </div>

                        <div class="col-md-12 col-xs-12">
                            <div class="row">
                                <label for="">Destaque:</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="0" name="is_featured" {{ $editMateria->is_featured == 0 ? 'checked' : '' }}>
                                        Não
                                    </label>
                                    <label>
                                        <input type="radio" value="1" name="is_featured" {{ $editMateria->is_featured == 1 ? 'checked' : '' }}>
                                        Sim
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xs-12">
                            <div class="row">
                                <label for="">Status:</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="1" name="status" {{ $editMateria->status == 1 ? 'checked' : '' }}>
                                        Ativo
                                    </label>
                                    <label>
                                        <input type="radio" value="0" name="status" {{ $editMateria->status == 0 ? 'checked' : '' }}>
                                        Inativo
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Imagem:</label>
                                            <input type="file" id="exampleInputFile" class="dropify" onchange="uploadFoto(event)">
                                            <input type="hidden" name="imagem" class="file" value="{{ $editMateria->imagem }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-md-offset-1 col-xs-12">
                                    <div class="row">
                                        <div class="divImgPreview">
                                            <img id="imgPreview" src="{{ $editMateria->imagem }}" class="img-responsive" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="row rowBotoes">
                                <button type="submit" class="btn btn-default">Editar</button>
                                <a href="{{ url('/admin/materias') }}" class="btn btn-default btnMarrom pull-right">Voltar</a>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
@endsection


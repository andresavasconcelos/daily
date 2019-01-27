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
                        <h3 class="card-title">ADICIONAR MATÉRIA</h3>
                    </div>

                    <form action="{{ url('/admin/materia/adicionar') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="">Edição da Revista:</label>
                        <select class="custom-select" name="id_revista" id="inputGroupSelect01">
                            <option>Selecione</option>
                            @foreach($revistas as $revista)
                                <option value="{{ $revista->id }}">{{ $revista->titulo }}</option>
                            @endforeach
                        </select>

                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input type="text" class="form-control" id="titulo" placeholder="" name="titulo" value="{{ old('titulo') }}">
                        </div>

                        <div class="form-group">
                            <label for="resenha">Resenha:</label>
                            <input type="text" class="form-control" id="resenha" placeholder="" name="resenha" value="{{ old('resenha') }}">
                        </div>

                        <div class="form-group">
                            <label for="conteudo">Conteúdo:</label>
                            <textarea class="form-control conteudo" name="conteudo" id="conteudo" cols="30" rows="10">{{ old('conteudo') }}</textarea>
                        </div>

                        <div class="col-md-12 col-xs-12">
                            <div class="row">
                                <label for="">Destaque:</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="0" name="is_featured" checked>
                                        Não
                                    </label>
                                    <label>
                                        <input type="radio" value="1" name="is_featured">
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
                                        <input type="radio" value="1" name="status" checked>
                                        Ativo
                                    </label>
                                    <label>
                                        <input type="radio" value="0" name="status">
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
                                            <input type="hidden" name="imagem" class="file" value="{{ old('imagem') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-md-offset-1 col-xs-12">
                                    <div class="row">
                                        <div class="divImgPreview">
                                            <img id="imgPreview" src="" class="img-responsive" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="row rowBotoes">
                                <button type="submit" class="btn btn-default">Adicionar</button>
                                <a href="{{ url('/admin/materias') }}" class="btn btn-default btnMarrom pull-right">Voltar</a>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
@endsection


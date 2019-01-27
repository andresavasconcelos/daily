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
                        Eventos
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('admin/painel') }}"><i class="fa fa-dashboard"></i> Home /</a></li>
                        <li><a href="{{ url('admin/eventos') }}" class="active"> Eventos /</a></li>
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
                        <h3 class="card-title">ADICIONAR EVENTOS</h3>
                    </div>

                    <form action="{{ url('/admin/evento/adicionar') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input type="text" class="form-control" id="titulo" placeholder="Digite o Título Aqui" name="titulo" value="{{ old('titulo') }}">
                        </div>

                        <div class="form-group">
                            <label for="resenha">Resenha:</label>
                            <input type="text" class="form-control" id="resenha" placeholder="Digite a Resenha Aqui" name="resenha" value="{{ old('resenha') }}">
                        </div>

                        <div class="form-group">
                            <label for="texto">Conteúdo:</label>
                            <textarea class="form-control conteudo" name="texto" id="texto" placeholder="Digite o Texto Aqui" cols="30" rows="10">{{ old('texto') }}</textarea>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="conteudo">Data:</label>
                                    <input type="date" class="form-control" name="data" id="data"  value="{{ old('data') }}">
                                </div>
                                <div class="col-lg-6">
                                    <label for="conteudo">Hora:</label>
                                    <input type="time" class="form-control" name="hora" id="hora"  value="{{ old('hora') }}">
                                </div>
                            </div>
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

                        <div class="form-group">
                            <label for="link">Link:</label>
                            <input type="url" class="form-control" id="link" placeholder="https://www.seulink.com/" name="link" value="{{ old('link') }}">
                            <span class="text-danger">* não esqueça de colocar https://www.</span>
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
                                <a href="{{ url('/admin/eventos') }}" class="btn btn-default btnMarrom pull-right">Voltar</a>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
@endsection


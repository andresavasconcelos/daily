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
                        Bonus
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('admin/painel') }}"><i class="fa fa-dashboard"></i> Home /</a></li>
                        <li><a href="{{ url('admin/bonus') }}" class="active"> Bonus /</a></li>
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
                        <h3 class="card-title">ADICIONAR BÔNUS</h3>
                    </div>

                    <form action="{{ url('/admin/bonus/adicionar') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input type="text" class="form-control" id="titulo" placeholder="Digite o Título Aqui" name="titulo" value="{{ old('titulo') }}">
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <textarea class="form-control conteudo" name="descricao" id="descricao" cols="30" rows="10">{{ old('descricao') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="link">Link:</label>
                            <input type="url" class="form-control" id="link" placeholder="https://www.seulink.com/" name="link" value="{{ old('link') }}">
                            <span class="text-danger">* não esqueça de colocar https://www.</span>
                        </div>

                        <div class="col-xs-12">
                            <div class="row rowBotoes">
                                <button type="submit" class="btn btn-default">Adicionar</button>
                                <a href="{{ url('/admin/bonus') }}" class="btn btn-default btnMarrom pull-right">Voltar</a>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
@endsection


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
    <script>
        CKEDITOR.replace( 'atividade' );
    </script>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <section class="content-header">
                    <h1>
                       Editar Daily
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('admin/painel') }}"><i class="fa fa-dashboard"></i> Home /</a></li>
                        <li><a href="{{ url('admin/dailies') }}" class="active"> Daily /</a></li>
                        <li class="active"> Editar Daily</li>
                    </ol>
                </section>

                @if(session()->has('success'))

                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session()->get('success') }}
                    </div>

                @endif
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
                        <h3 class="card-title">Editar Daily</h3>
                    </div>

                    <form action="{{ url('/admin/daily/editar/'.$editDaily->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="data">Data:</label>
                            <input type="date" class="form-control" id="data" placeholder="Digite o Título Aqui" name="data" value="{{ $editDaily->data }}">
                        </div>

                        <div class="form-group">
                            <label for="id_funcionario">Funcionário:</label>
                            <input type="text" class="form-control" id="id_funcionario" placeholder="Digite o Título Aqui" name="id_funcionario" value="{{ $editDaily->id_funcionario }}">
                        </div>

                        <div class="form-group">
                            <label for="tarefa">Tarefa:</label>
                            <input type="text" class="form-control" id="tarefa" placeholder="Digite o Título Aqui" name="tarefa" value="{{ $editDaily->tarefa }}">
                        </div>

                        <div class="form-group">
                            <label for="atividade">Atividade:</label>
                            <textarea class="form-control texto" name="atividade" id="atividade" placeholder="Digite o Texto Aqui" cols="30" rows="10">{{ $editDaily->id_funcionario }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="atividade">Observação:</label>
                            <input type="text" class="form-control" id="atividade" placeholder="Digite o Título Aqui" name="atividade" value="{{ $editDaily->atividade }}">
                        </div>

                        <div class="col-xs-12">
                            <div class="row rowBotoes">
                                <button type="submit" class="btn btn-default">Adicionar</button>
                                <a href="{{ url('/admin/dailies') }}" class="btn btn-default btnMarrom pull-right">Voltar</a>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
@endsection


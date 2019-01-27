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
        CKEDITOR.replace( 'observacao' );
    </script>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <section class="content-header">
                    <h1>
                       Editar Funcionário
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('admin/painel') }}"><i class="fa fa-dashboard"></i> Home /</a></li>
                        <li><a href="{{ url('admin/funcionarios') }}" class="active"> Funcionario /</a></li>
                        <li class="active"> Editar Funcionário</li>
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
                        <h3 class="card-title">Editar Funcionário</h3>
                    </div>

                    <form action="{{ url('/admin/funcionario/editar/'.$editFuncionario->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" placeholder="Digite o Título Aqui" name="nome" value="{{ $editFuncionario->nome }}">
                        </div>

                        <div class="form-group">
                            <label for="observacao">Observação:</label>
                            <textarea class="form-control texto" name="observacao" id="observacao" placeholder="Digite o Texto Aqui" cols="30" rows="10">{{ $editFuncionario->observacao }}</textarea>
                        </div>

                        <div class="col-md-12 col-xs-12">
                            <div class="row">
                                <label for="">Status:</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="1" name="status" {{ $editFuncionario->status == 1 ? 'checked' : '' }}>
                                        Ativo
                                    </label>
                                    <label>
                                        <input type="radio" value="0" name="status" {{ $editFuncionario->status == 0 ? 'checked' : '' }}>
                                        Inativo
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="row rowBotoes">
                                <button type="submit" class="btn btn-default">Editar</button>
                                <a href="{{ url('/admin/funcionarios') }}" class="btn btn-default btnMarrom pull-right">Voltar</a>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
@endsection


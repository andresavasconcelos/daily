@extends('admin.layouts.app')

@section('title', $titles['title2'].' Usuário')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{ $titles['title1'] }} usuário</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/usuarios') }}">Usuários</a></li>
                    <li class="active">{{ $titles['title2'] }} usuário</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $titles['title1'] }} usuário
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <form class="form-material form-horizontal" role="form" method="POST" action="{{ (isset($user->id)) ? url('admin/usuario/'.$user->id.'/salvar') : url('admin/usuario/salvar') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="status">Usuário ativo?</label>
                                        <select class="form-control form-control-line select2" name="status" id="status">
                                            <option value="1" {{ (isset($user->status) && $user->status == '1') ? 'selected' : '' }}>Sim</option>
                                            <option value="0" {{ (isset($user->status) && $user->status == '0') ? 'selected' : '' }}>Não</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group{{ ($errors->has('name')) ? ' has-error' : '' }}">
                                            <div class="col-md-8">
                                                <label for="name">Nome do usuário</label>
                                                <input type="text" class="form-control form-control-line" name="name" id="name" value="{{ $user->name or '' }}">
                                                @if ($errors->has('name'))
                                                    <span class="help-block text-danger">
                                                        {{ $errors->first('name') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <div class="col-md-8">
                                                <label for="email">E-mail</label>
                                                <input type="email" class="form-control form-control-line" name="email" id="email" value="{{ $user->email or '' }}">
                                                @if ($errors->has('email'))
                                                    <span class="help-block text-danger">
                                                        {{ $errors->first('email') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <div class="col-md-8">
                                                <label for="password">Senha</label>
                                                <input type="password" class="form-control form-control-line" name="password" id="password">

                                                @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8">
                                                <label for="password-confirm">Confirmar Senha</label>
                                                <input type="password" class="form-control form-control-line" name="password_confirmation" id="password-confirm">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>{{ (isset($user->id)) ? 'Nova ' : '' }}Foto</label>
                                            @if(isset($user->id))
                                                @if($user->photo)
                                                    <input type="file" name="photo" class="dropify" data-default-file="{{ asset($user->photo) }}" />
                                                @else
                                                    <input type="file" name="photo" class="dropify" />
                                                @endif
                                            @else
                                                <input type="file" name="photo" class="dropify" />
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check"></i> {{ $titles['title2'] }} usuário
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <div class="delete-button delete-box">
        <button type="button" class="btn btn-danger btn-lg submit-form" style="margin-top:-8px;"><i class="fa fa-trash"></i> Deletar</>
    </div>
@endsection

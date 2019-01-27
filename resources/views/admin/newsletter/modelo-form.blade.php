@extends('admin.layouts.app')

@section('title', $titles['title2'].' modelo / Newsletter')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{ $titles['title1'] }} modelo</h4>
            </div>

            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/newsletter/modelos') }}">Modelos</a></li>
                    <li class="active">{{ $titles['title2'] }} modelo</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <form class="form-material form-horizontal" role="form" method="POST" action="{{ (isset($model->id)) ? url('admin/newsletter/modelo/'.$model->id.'/salvar') : url('admin/newsletter/modelo/salvar') }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $titles['title1'] }} modelo
                        </div>

                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="form-group{{ ($errors->has('name') OR $errors->has('subject')) ? ' has-error' : '' }}">
                                    <div class="col-md-6">
                                        <label for="name">Nome do Modelo</label>
                                        <input type="text" class="form-control form-control-line" name="name" id="name" value="{{ $model->name or '' }}">
                                        @if ($errors->has('name'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('name') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="subject">Assunto do Modelo</label>
                                        <input type="text" class="form-control form-control-line" name="subject" id="subject" value="{{ $model->subject or '' }}">
                                        @if ($errors->has('subject'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('subject') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ ($errors->has('senders_name') OR $errors->has('senders_email')) ? ' has-error' : '' }}">
                                    <div class="col-md-6">
                                        <label for="senders_name">Nome do Remetente</label>
                                        <input type="text" class="form-control form-control-line" name="senders_name" id="senders_name" value="{{ $model->senders_name or '' }}">
                                        @if ($errors->has('senders_name'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('senders_name') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="senders_email">Email do Remetente</label>
                                        <input type="email" class="form-control form-control-line" name="senders_email" id="senders_email" value="{{ $model->senders_email or '' }}">
                                        @if ($errors->has('senders_email'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('senders_email') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ ($errors->has('content')) ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="content">Conteúdo do Modelo</label>
                                        <textarea class="form-control form-control-line" rows="20" name="content" id="content">{{ $model->content or '' }}</textarea>
                                        @if ($errors->has('content'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('content') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="inlinecss">Estilos do Modelo</label>
                                        <textarea class="form-control form-control-line" rows="10" name="inlinecss" id="inlinecss">{{ $model->inlinecss or '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-success">
                <i class="fa fa-check"></i> {{ $titles['title2'] }} modelo
            </button>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
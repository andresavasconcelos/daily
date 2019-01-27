@extends('admin.layouts.app')

@section('title', $titles['title2'].' Marca')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{ $titles['title1'] }} marca</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/marcas') }}">Marcas</a></li>
                    <li class="active">{{ $titles['title2'] }} marca</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $titles['title1'] }} marca
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <form class="form-material form-horizontal" role="form" method="POST" action="{{ (isset($marca->id)) ? url('admin/marca/'.$marca->id.'/salvar') : url('admin/marca/salvar') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group{{ ($errors->has('name') || $errors->has('alias')) ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="name">Nome da marca</label>
                                        <input type="text" class="form-control form-control-line" name="name" id="name" value="{{ $marca->name or '' }}" autocomplete="off">
                                        @if ($errors->has('name') || $errors->has('alias'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('name') }}<br />
                                                {{ $errors->first('alias') }}
                                            </span>
                                        @endif

                                        <div class="control-url">
                                            <span class="control">
                                                https://depositodalingerie.com.br/marca/<span class="url-slug">{{ $marca->alias or '' }}</span>
                                            </span>
                                            <span class="fa fa-pencil ks-icon" id="url-edit" data-toogle="tooltip" data-placement="top" title="Edita o link da marca na loja."></span>
                                            <span class="fa fa-remove ks-icon" id="url-remove" data-toogle="tooltip" data-placement="top" title="Cancelar as alterações feitas no link da marca."></span>
                                            <span class="fa fa-check text-success" id="check" style="font-size:18px;background-color:transparent;display:none"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" id="form-group-url" style="display:none">
                                    <div class="col-sm-12">
                                        <label>Url:</label>
                                        <div class="input-group">
                                            <input type="hidden" name="base" id="base" value="products_brands">
                                            <input type="text" name="alias" id="alias" maxlength="255" class="form-control form-control-line" value="{{ $marca->alias or '' }}">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary" id="url-validate" data-loading-text="Validando...">Validar</button>
                                            </span>
                                        </div>
                                        <span class="help-block text-danger" id="error-url"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="description">Descrição</label>
                                        <textarea class="form-control form-control-line" rows="5" name="description" id="description">{{ $marca->description or '' }}</textarea>
                                        <div class="help-block">
                                            <small>A descrição da marca será mostrada na página da marca, logo abaixo do menu lateral. Este conteúdo é de extrema importância para os motores de busca.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>{{ (isset($marca->id)) ? 'Nova ' : '' }}Logo</label>
                                        @if(isset($marca->id))
                                            @if($marca->logo)
                                                <input type="file" name="logo" class="dropify" data-default-file="{{ asset($marca->logo) }}" />
                                            @else
                                                <input type="file" name="logo" class="dropify" />
                                            @endif
                                        @else
                                            <input type="file" name="logo" class="dropify" />
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check"></i> {{ $titles['title2'] }} marca
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

    {{--<div class="ks-column ks-page">--}}
        {{--<div class="ks-header">--}}
            {{--<section class="ks-title">--}}
                {{--<h3>Editar Marca</h3>--}}

                {{--<a class="btn btn-default" href="{{ url('/admin/marcas') }}">--}}
                    {{--<i class="fa fa-arrow-left"></i> Voltar--}}
                {{--</a>--}}
            {{--</section>--}}
        {{--</div>--}}

        {{--<div class="ks-content">--}}
            {{--<div class="ks-body tables-page">--}}
                {{--<div class="container-fluid ks-rows-section">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-lg-5">--}}
                            {{--<div class="card panel panel-default">--}}
                                {{--<h5 class="card-header">--}}
                                    {{--Editar Marca--}}
                                {{--</h5>--}}

                                {{--<div class="card-block">--}}
                                    {{--<form class="form-ajax" role="form" method="POST" action="{{ url('admin/marca/'.$marca->id.'/salvar') }}">--}}
                                        {{--{{ csrf_field() }}--}}

                                        {{--<div class="form-group row">--}}
                                            {{--<div class="col-sm-12">--}}
                                                {{--<label>Nome da Marca:</label>--}}
                                                {{--<input type="text" name="name" class="form-control" value="{{ $marca->name }}">--}}
                                                {{--<span class="help-block text-danger"></span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                        {{--<div class="form-group row">--}}
                                            {{--<div class="col-sm-6">--}}
                                                {{--<label>Logo:</label>--}}
                                                {{--<button class="btn btn-primary ks-btn-file">--}}
                                                    {{--<span class="fa fa-cloud-upload ks-icon"></span>--}}
                                                    {{--<span class="ks-text">Escolher imagem</span>--}}
                                                    {{--<input type="file" name="logo">--}}
                                                {{--</button>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-sm-6 text-right">--}}
                                                {{--@if($marca->logo)--}}
                                                    {{--<img src="{{ asset($marca->logo) }}" width="100">--}}
                                                {{--@else--}}
                                                    {{--<img src="{{ asset('admin/images/placeholders/placeholder-256x256.png') }}" width="70" height="70">--}}
                                                {{--@endif--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                        {{--<div class="row">--}}
                                            {{--<div class="col-lg-12">--}}
                                                {{--<button class="btn btn-success ladda-button" data-style="expand-left">--}}
                                                    {{--<span class="ladda-label">--}}
                                                        {{--<i class="fa fa-save ks-icon"></i> Salvar--}}
                                                    {{--</span>--}}
                                                {{--</button>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

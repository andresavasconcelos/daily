@extends('admin.layouts.app')

@section('title', $titles['title2'].' Categoria')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{ $titles['title1'] }} categoria</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/categorias') }}">Catergorias</a></li>
                    <li class="active">{{ $titles['title2'] }} categoria</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <form class="form-material form-horizontal" role="form" method="POST" action="{{ (isset($categoria->id)) ? url('admin/categoria/'.$categoria->id.'/salvar') : url('admin/categoria/salvar') }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $titles['title1'] }} categoria
                        </div>

                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="status">Categoria ativa?</label>
                                        <select class="form-control form-control-line select2" name="status" id="status">
                                            <option value="1" {{ (isset($categoria->status) && $categoria->status == '1') ? 'selected' : '' }}>Sim</option>
                                            <option value="0" {{ (isset($categoria->status) && $categoria->status == '0') ? 'selected' : '' }}>Não</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="featured">Categoria em destaque?</label>
                                        <select class="form-control form-control-line select2" name="featured" id="featured">
                                            <option value="0" {{ (isset($categoria->featured) && $categoria->featured == '0') ? 'selected' : '' }}>Não</option>
                                            <option value="1" {{ (isset($categoria->featured) && $categoria->featured == '1') ? 'selected' : '' }}>Sim</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="category_id">Categoria Pai</label>
                                        <select class="form-control form-control-line select2" name="category_id" id="category_id">
                                            <option value="{{ (isset($categoria->id_parent)) ? '0' : '' }}">[ Raiz ]</option>
                                            @foreach($categorias as $cat)
                                                @if(isset($categoria->id))
                                                    @if($categoria->id != $cat->id)
                                                        <option value="{{ $cat->id }}" {{ (isset($categoria->id_parent) && $categoria->id_parent == $cat->id) ? 'selected' : '' }}>{{ $cat->title }}</option>
                                                    @endif
                                                @else
                                                    <option value="{{ $cat->id }}" {{ (isset($categoria->id_parent) && $categoria->id_parent == $cat->id) ? 'selected' : '' }}>{{ $cat->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group{{ ($errors->has('title') or $errors->has('alias')) ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="title">Nome</label>
                                        <input type="text" class="form-control form-control-line" name="title" id="title" value="{{ $categoria->title or '' }}" autocomplete="off">
                                        @if ($errors->has('title') or $errors->has('alias'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('title') }}<br />
                                                {{ $errors->first('alias') }}
                                            </span>
                                        @endif

                                        <div class="control-url">
                                            <span class="control">
                                                https://depositodalingerie.com.br/categoria/<span class="url-slug">{{ $categoria->alias or '' }}</span>
                                            </span>
                                            <span class="fa fa-pencil ks-icon" id="url-edit" data-toogle="tooltip" data-placement="top" title="Edita o link do produto na loja."></span>
                                            <span class="fa fa-remove ks-icon" id="url-remove" data-toogle="tooltip" data-placement="top" title="Cancela as alterações feitas no link do produto."></span>
                                            <span class="fa fa-check text-success" id="check" style="font-size:18px;background-color:transparent;display:none"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" id="form-group-url" style="display:none">
                                    <div class="col-sm-12">
                                        <label>Url:</label>
                                        <div class="input-group">
                                            <input type="hidden" name="base" id="base" value="categories">
                                            <input type="text" name="alias" id="alias" maxlength="255" class="form-control form-control-line" value="{{ $categoria->alias or '' }}">
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
                                        <textarea class="form-control form-control-line" rows="7" name="description" id="description">{{ $categoria->description or '' }}</textarea>
                                        <div class="help-block">
                                            <small>A descrição da categoria será mostrada na página da categoria, logo abaixo do menu. Este conteúdo é de extrema importância para os motores de busca entenderem do que se trata sua categoria.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Otimização para buscadores (SEO)

                            <div class="panel-action">
                                <a href="#" data-perform="panel-collapse">
                                    <i class="ti-plus"></i>
                                </a>
                            </div>
                        </div>

                        <div class="panel-wrapper collapse">
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="tag_title">Tag Title</label>
                                        <input type="text" class="form-control form-control-line" name="tag_title" id="tag_title" value="{{ $categoria->tag_title or '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="tag_description">Meta Tag Description</label>
                                        <textarea class="form-control form-control-line" rows="5" name="tag_description" id="tag_description">{{ $categoria->tag_description or '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="tag_keywords">Meta Tag Keywords</label>
                                        <input type="text" class="form-control form-control-line" name="tag_keywords" id="tag_keywords" value="{{ $categoria->tag_keywords or '' }}">
                                        <div class="help-block"><small>Separe as palavras por vírgula.</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-success">
                <i class="fa fa-check"></i> {{ $titles['title2'] }} categoria
            </button>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
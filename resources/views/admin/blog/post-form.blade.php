@extends('admin.layouts.app')

@section('title', $titles['title2'].' Post')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{ $titles['title1'] }} Post</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/blog') }}">Blog</a></li>
                    <li class="active">{{ $titles['title2'] }} Post</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <form class="form-material form-horizontal" role="form" method="POST" action="{{ (isset($post->id)) ? url('admin/blog/post/'.$post->id.'/salvar') : url('admin/blog/post/salvar') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $titles['title1'] }} Post
                        </div>

                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="status">Post ativo?</label>
                                        <select class="form-control form-control-line select2" name="status" id="status">
                                            <option value="1" {{ (isset($post->status) && $post->status == '1') ? 'selected' : '' }}>Sim</option>
                                            <option value="0" {{ (isset($post->status) && $post->status == '0') ? 'selected' : '' }}>Não</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label>{{ (isset($post->id)) ? 'Nova ' : '' }}Imagem</label>
                                        @if(isset($post->id))
                                            @if($post->cover)
                                                <input type="file" name="cover" class="dropify" data-default-file="{{ asset($post->cover) }}" />
                                            @else
                                                <input type="file" name="cover" class="dropify" />
                                            @endif
                                        @else
                                            <input type="file" name="cover" class="dropify" />
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ ($errors->has('title') || $errors->has('alias')) ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="title">Título</label>
                                        <input type="text" class="form-control form-control-line" name="title" id="title" value="{{ $post->title or '' }}" autocomplete="off">
                                        @if ($errors->has('title') || $errors->has('alias'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('title') }}<br />
                                                {{ $errors->first('alias') }}
                                            </span>
                                        @endif

                                        <div class="control-url">
                                            <span class="control">
                                                https://depositodalingerie.com.br/blog/<span class="url-slug">{{ $post->alias or '' }}</span>
                                            </span>
                                            <span class="fa fa-pencil ks-icon" id="url-edit" data-toogle="tooltip" data-placement="top" title="Edita o link da Post na loja."></span>
                                            <span class="fa fa-remove ks-icon" id="url-remove" data-toogle="tooltip" data-placement="top" title="Cancelar as alterações feitas no link do Post."></span>
                                            <span class="fa fa-check text-success" id="check" style="font-size:18px;background-color:transparent;display:none"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" id="form-group-url" style="display:none">
                                    <div class="col-sm-12">
                                        <label>Url:</label>
                                        <div class="input-group">
                                            <input type="hidden" name="base" id="base" value="posts">
                                            <input type="text" name="alias" id="alias" maxlength="255" class="form-control form-control-line" value="{{ $post->alias or '' }}">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary" id="url-validate" data-loading-text="Validando...">Validar</button>
                                            </span>
                                        </div>
                                        <span class="help-block text-danger" id="error-url"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="subtitle">Subtítulo</label>
                                        <textarea class="form-control form-control-line" rows="3" name="subtitle" id="subtitle">{{ $post->subtitle or '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="content">Conteúdo</label>
                                        <textarea class="form-control form-control-line tinymce" rows="5" name="content" id="content">{{ $post->content or '' }}</textarea>
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
                                        <input type="text" class="form-control form-control-line" name="tag_title" id="tag_title" value="{{ $post->tag_title or '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="tag_description">Meta Tag Description</label>
                                        <textarea class="form-control form-control-line" rows="5" name="tag_description" id="tag_description">{{ $post->tag_description or '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="tag_keywords">Meta Tag Keywords</label>
                                        <input type="text" class="form-control form-control-line" name="tag_keywords" id="tag_keywords" value="{{ $post->tag_keywords or '' }}">
                                        <div class="help-block"><small>Separe as palavras por vírgula.</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> {{ $titles['title2'] }} Post
            </button>
        </form>
    </div>
    <!-- /.container-fluid -->

    <div class="delete-button delete-box">
        <button type="button" class="btn btn-danger btn-lg submit-form" style="margin-top:-8px;"><i class="fa fa-trash"></i> Deletar</button>
    </div>
@endsection

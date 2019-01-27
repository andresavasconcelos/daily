@extends('admin.layouts.produto-modal')

@section('title', $titles['title2'].' Produto')

@section('contentModal')
    <form class="form-material form-horizontal" role="form" method="POST" action="{{ url('admin/produto/variacao/'.$produto->id.'/salvar') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        {{--Informações principais--}}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Informações principais
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                {{-- Upload de Imagens --}}
                                <div class="col-md-4">
                                    <div class="wrapper-dropzone">
                                        <div id="dropzone">
                                            <h3 class="text-muted">
                                                <strong>Solte o arquivo aqui para fazer upload...</strong>
                                            </h3>
                                            <div class="image"></div>
                                        </div>
                                    @if(isset($produto->id) && $imagens->count())
                                        <div class="image-widget sortable" data-url="{{ url('admin/produto/'.$produto->id.'/imagem/ordenar') }}">
                                    @else
                                        <div class="image-widget sortable">
                                    @endif
                                            <div class="row">
                                                @if(isset($produto->id) && $imagens->count())
                                                    @foreach($imagens as $image)
                                                        <div class="col-md-4 image ui-sortable-handle" data-id="{{ $image->id }}">
                                                            <div class="inner">
                                                                <img src="{{ asset($image->image) }}">
                                                                <a href="{{ url('admin/produto/'.$produto->id.'/imagem/'.$image->id.'/remover') }}" class="imagem-remover" title="Excluir" alt="Excluir" data-url="{{ url('admin/produto/'.$produto->id.'/imagem/'.$image->id.'/remover') }}">
                                                                    <i class="fa fa-close"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-4 image">
                                                        <div class="inner empty image-produto">
                                                            <i class="ti-image big"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 image">
                                                        <div class="inner empty">
                                                            <i class="ti-image big"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 image">
                                                        <div class="inner empty">
                                                            <i class="ti-image big"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 image">
                                                        <div class="inner empty">
                                                            <i class="ti-image big"></i>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="upload-wrapper none" style="margin:10px 0;">
                                            <span class="upload mensagem" style="margin-bottom:5px;display:block;">Upload das imagens em progresso...</span>
                                            <div class="progress" id="uploadProgressbar" style="height:auto">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                                    0%
                                                </div>
                                            </div>
                                        </div>

                                        <div class="error-files" style="display:none">
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <strong>Tipo de Arquivo inválido</strong><br />Tipos de Arquivos aceitos: JPG, PNG, GIF<br />tamanho máximo: <strong>3MB</strong>
                                            </div>
                                        </div>

                                        <div class="image-upload-widget">
                                            <small>Máx. 10 imagens. Tamanho máx. <strong>3MB</strong>. Para maior qualidade envie imagens no formato <strong>JPG</strong>.</small>
                                            <input id='uploadImagemProduto' type="file" name="files[]" data-url="{{ url('admin/produto/criar/imagem') }}{{ (isset($produto->id)) ? '/'.$produto->id : '' }}" multiple="multiple" />
                                        </div>
                                    </div>
                                </div>
                                {{-- /Upload de Imagens --}}

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="hidden" name="type" value="SIMPLE">
                                        <div class="col-md-4">
                                            <label for="featured">Em destaque?</label>
                                            <select class="form-control form-control-line select2" name="featured" id="featured">
                                                <option value="0" {{ (isset($produto->featured) && $produto->featured == '0') ? 'selected' : '' }}>Não</option>
                                                <option value="1" {{ (isset($produto->featured) && $produto->featured == '1') ? 'selected' : '' }}>Sim</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="new">Selo de "Novo"?</label>
                                            <select class="form-control form-control-line select2" name="new" id="new">
                                                <option value="0" {{ (isset($produto->new) && $produto->new == '0') ? 'selected' : '' }}>Não</option>
                                                <option value="1" {{ (isset($produto->new) && $produto->new == '1') ? 'selected' : '' }}>Sim</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="status">Produto ativado?</label>
                                            <select class="form-control form-control-line select2" name="status" id="status">
                                                <option value="1" {{ (isset($produto->status) && $produto->status == '1') ? 'selected' : '' }}>Sim</option>
                                                <option value="0" {{ (isset($produto->status) && $produto->status == '0') ? 'selected' : '' }}>Não</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group{{ ($errors->has('title') or $errors->has('alias')) ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="title">Nome do produto</label>
                                            <input type="text" class="form-control form-control-line" name="title" id="title" value="{{ $produto->title or '' }}" autocomplete="off">
                                            @if ($errors->has('title') or $errors->has('alias'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('title') }}<br />
                                                    {{ $errors->first('alias') }}
                                                 </span>
                                            @endif

                                            <div class="control-url">
                                                <span class="control">
                                                    http://fautriz.com.br/produto/<span class="url-slug">{{ $produto->alias or '' }}</span>
                                                </span>
                                                <span class="fa fa-pencil" id="url-edit" data-toogle="tooltip" data-placement="top" title="Edita o link do produto na loja."></span>
                                                <span class="fa fa-remove" id="url-remove" data-toogle="tooltip" data-placement="top" title="Cancela as alterações feitas no link do produto."></span>
                                                <span class="fa fa-check text-success" id="check" style="font-size:18px;background-color:transparent;display:none"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group-url" style="display:none">
                                        <div class="col-md-12">
                                            <label for="alias">Url:</label>
                                            <div class="input-group">
                                                <input type="hidden" name="base" id="base" value="products">
                                                <input type="text" name="alias" id="alias" maxlength="255" class="form-control form-control-line" value="{{ $produto->alias or '' }}">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-primary" id="url-validate" data-loading-text="Validando...">Validar</button>
                                                </span>
                                            </div>
                                            <span class="help-block text-danger" id="error-url"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="code">Código do Produto (SKU)</label>
                                            <input type="text" name="code" id="code" class="form-control form-control-line" value="{{ $produto->code or '' }}">
                                            <span class="help-block"><small>Este é o código de identificação única do produto.</small></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="visibility">Visibilidade</label>
                                            <select class="form-control form-control-line select2" name="visibility" id="visibility">
                                                <option value="1" {{ (isset($produto->visibility) && $produto->visibility == '1') ? 'selected' : '' }}>Exibir individualmente</option>
                                                <option value="0" {{ (isset($produto->visibility) && $produto->visibility == '0') ? 'selected' : '' }}>Não exibir individualmente</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="custo">Preço de custo</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">R$</span>
                                                <input id="input-group-text" type="text" name="custo" id="custo" class="form-control form-control-line money" placeholder="0,00" value="{{ $produto->custo or '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="price">Preço de venda</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">R$</span>
                                                <input id="input-group-text" type="text" name="price" id="price" class="form-control form-control-line money" placeholder="0,00" value="{{ $produto->price or '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="offer_price">Preço promocional</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">R$</span>
                                                <input id="input-group-text" type="text" name="offer_price" id="offer_price" class="form-control form-control-line money" placeholder="0,00" value="{{ $produto->offer_price or '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="offer_start">Promoção de</label>
                                            <div class="input-group">
                                                <input type="text" name="offer_start" id="offer_start" class="form-control form-control-line date datepicker" placeholder="00/00/0000" value="{{ (isset($produto->offer_start)) ? date('d/m/Y', strtotime($produto->offer_start)) : '' }}">
                                                <span class="input-group-addon"><i class="icon-calender"></i></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="offer_end">Promoção até</label>
                                            <div class="input-group">
                                                <input type="text" name="offer_end" id="offer_end" class="form-control form-control-line date datepicker" placeholder="00/00/0000" value="{{ (isset($produto->offer_end)) ? date('d/m/Y', strtotime($produto->offer_end)) : '' }}">
                                                <span class="input-group-addon"><i class="icon-calender"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        @foreach($prod_variations_dist_simple as $variation)
                                            <div class="col-md-3">
                                                @php $name = \App\Variacoes::getNameVariation($variation->id_variation) @endphp
                                                <label for="id_variations">{{ $name }}</label>
                                                <select class="form-control form-control-line select2" name="id_variations[{{ $variation->id_variation }}]" id="id_variations">
                                                    @foreach(\App\VariationsOptions::getOptions($variation->id_variation) as $var)
                                                        <option value="{{ $var->id }}" {{ (\App\ProdutosVariacoes::getVariationId($produto->id, $produto->id_parent, $variation->id_variation) == $var->id) ? 'selected' : '' }}>{{ $var->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--Peso e dimensões--}}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Peso e dimensões <small class="text-muted">Os valores devem ser preenchidos considerando o pacote que será enviado, ou seja, embalagem com produto</small>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="weight">Peso <i class="ic-img ic-weight"></i></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-line peso" name="weight" id="weight" placeholder="0,000" value="{{ $produto->weight or '' }}">
                                        <span class="input-group-addon">kg</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="dimension_heigth">Altura <i class="ic-img ic-height"></i></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-line" name="dimension_heigth" id="dimension_heigth" value="{{ $produto->dimension_heigth or '' }}">
                                        <span class="input-group-addon">cm</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="dimension_width">Largura <i class="ic-img ic-width"></i></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-line" name="dimension_width" id="dimension_width" value="{{ $produto->dimension_width or '' }}">
                                        <span class="input-group-addon">cm</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="dimension_length">Profundidade <i class="ic-img ic-length"></i></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-line" name="dimension_length" id="dimension_length" value="{{ $produto->dimension_length or '' }}">
                                        <span class="input-group-addon">cm</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--Informações gerais--}}
        <div class="row" id="info-gerais">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Informações gerais
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="id_brand">Marca</label>
                                            <select class="form-control form-control-line select2" name="id_brand" id="id_brand">
                                                <option value="">Selecione</option>
                                                @foreach($marcas as $marca)
                                                    <option value="{{ $marca->id }}" {{ (isset($produto->id_brand) && $marca->id == $produto->id_brand) ? 'selected' : '' }}>{{ $marca->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="new_brand">Ou crei uma nova:</label>
                                            <input type="text" name="new_brand" id="new_brand" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="video">URL do vídeo do produto no Youtube</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-youtube-play text-danger"></i></span>
                                                <input class="form-control form-control-line" name="video" id="video" value="{{ $produto->video or '' }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="categories">Selecionar categorias</label>
                                            <ul id="tree">
                                                @foreach($categorias as $categoria)
                                                    <li>
                                                        <input type="checkbox" name="categories[]" value="{{ $categoria['id'] }}" {{ ($categoria['checked']) ? 'checked' : '' }}> {{ $categoria['text'] }}

                                                        @foreach($categoria['children'] as $childen)
                                                            <ul>
                                                                <li>
                                                                    <input type="checkbox" name="categories[]" value="{{ $childen['id'] }}" {{ ($childen['checked']) ? 'checked' : '' }}> {{ $childen['text'] }}

                                                                    @foreach($childen['children'] as $childen2)
                                                                        <ul>
                                                                            <li>
                                                                                <input type="checkbox" name="categories[]" value="{{ $childen2['id'] }}" {{ ($childen2['checked']) ? 'checked' : '' }}> {{ $childen2['text'] }}

                                                                                @foreach($childen2['children'] as $childen3)
                                                                                    <ul>
                                                                                        <li>
                                                                                            <input type="checkbox" name="categories[]" value="{{ $childen3['id'] }}" {{ ($childen3['checked']) ? 'checked' : '' }}> {{ $childen3['text'] }}

                                                                                            @foreach($childen3['children'] as $childen4)
                                                                                                <ul>
                                                                                                    <li><input type="checkbox" name="categories[]" value="{{ $childen4['id'] }}" {{ ($childen4['checked']) ? 'checked' : '' }}> {{ $childen4['text'] }}</li>
                                                                                                </ul>
                                                                                            @endforeach
                                                                                        </li>
                                                                                    </ul>
                                                                                @endforeach
                                                                            </li>
                                                                        </ul>
                                                                    @endforeach
                                                                </li>
                                                            </ul>
                                                        @endforeach
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="description">Descrição do produto</label>
                                    <textarea rows="10" class="form-control form-control-line tinymce" name="description" id="description">{{ $produto->description or '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--Otimização para buscadores (SEO)--}}
        <div class="row" id="seo">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Otimização para buscadores (SEO)
                        <span class="label label-inverse m-l-5">
                            <a class="text-white" href="https://static.googleusercontent.com/media/www.google.com/pt-BR//intl/pt-BR/webmasters/docs/guia-otimizacao-para-mecanismos-de-pesquisa-pt-br.pdf" target="_blank">
                                <i class="fa fa-question-circle"></i> Guia
                            </a>
                        </span>

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
                                    <label for="meta_title">Tag Title</label>
                                    <input type="text" class="form-control form-control-line" name="meta_title" id="meta_title" value="{{ $produto->meta_title or '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="meta_description">Meta Tag Description</label>
                                    <textarea class="form-control form-control-line" rows="5" name="meta_description" id="meta_description">{{ $produto->meta_description or '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="meta_keywords">Meta Tag Keywords</label>
                                    <input type="text" class="form-control form-control-line" name="meta_keywords" id="meta_keywords" value="{{ $produto->meta_keywords or '' }}">
                                    <div class="help-block"><small>Separe as palavras por vírgula.</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--Estoque--}}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Estoque
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="manage_stock">Gerenciar o estoque deste produto?</label>
                                    <select class="form-control form-control-line select2" name="manage_stock" id="manage_stock">
                                        <option value="0" {{ (isset($produto->manage_stock) && $produto->manage_stock == 0) ? 'selected' : '' }}>Não</option>
                                        <option value="1" {{ (isset($produto->manage_stock) && $produto->manage_stock == 1) ? 'selected' : '' }}>Sim</option>
                                    </select>
                                </div>
                                <div class="col-md-4" id="disp-pct" style="{{ (empty($produto->inventory)) ? '' : 'display:none' }}">
                                    <label for="in_stock">Qual a disponibilidade dos produtos?</label>
                                    <select class="form-control form-control-line select2" name="in_stock" id="in_stock">
                                        <option value="1" {{ (isset($produto->in_stock) && $produto->in_stock == 1) ? 'selected' : '' }}>Disponível em estoque</option>
                                        <option value="0" {{ (isset($produto->in_stock) && $produto->in_stock == 0) ? 'selected' : '' }}>Indisponível</option>
                                    </select>
                                </div>
                                <div class="col-md-4" id="qtd-inv" style="{{ (!empty($produto->inventory)) ? '' : 'display:none' }}">
                                    <label for="inventory">Quantidade de produtos em estoque</label>
                                    <input type="text" class="form-control form-control-line" name="inventory" id="inventory" value="{{ $produto->inventory or '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br />

        <div class="create-box">
            <button type="button" class="btn btn-danger btn-lg" onclick="fechaModal()" style="margin-top:-8px;margin-right:5px;">
                <i class="fa fa-close"></i> Fechar janela
            </button>

            <button type="submit" class="btn btn-success btn-lg" data-name="{{ $titles['title2'] }}" style="margin-top:-8px;">
                <i class="fa fa-check"></i> {{ (old('type') == 'VARIABLE') ? 'Continuar Cadastro' : $titles['title2'].' produto' }}
            </button>
        </div>
    </form>

    @if(session('status'))
        <div class="alert alert-success alert-dismissable alert-fixed">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
            <i class="ti-check"></i> {{ session('status') }}
        </div>
    @endif

    <script>
        function fechaModal() {
            window.close();
        }
    </script>
@endsection
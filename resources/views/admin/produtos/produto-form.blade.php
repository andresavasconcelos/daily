@extends('admin.layouts.app')

@section('title', $titles['title2'].' Produto')

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#selectType').val($("#type").val());
        });


        $('#type').on('change', function(){
           $('#selectType').val($("#type").val());
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{ $titles['title1'] }} produto</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/produtos') }}">Produtos</a></li>
                    <li class="active">{{ $titles['title2'] }} Produto</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <form class="form-material form-horizontal form-produto" role="form" method="POST" action="{{ (isset($produto->id)) ? url('admin/produto/'.$produto->id.'/salvar') : url('admin/produto/salvar') }}" enctype="multipart/form-data">
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
                                            @if(isset($produto->type) && $produto->type == 'SIMPLE' && is_null($produto->id_parent))
                                            <div class="col-md-3">
                                                <label for="type">Com variação?</label>
                                                <select class="form-control form-control-line select2" name="type" id="type" {{ (isset($produto->type) && $produto->type == 'VARIABLE') ? 'disabled' : '' }}>
                                                    <option value="SIMPLE" {{ (isset($produto->type) && $produto->type == 'SIMPLE' || old('type') == 'SIMPLE') ? 'selected' : '' }}>Não</option>
                                                    <option value="VARIABLE" {{ (isset($produto->type) && $produto->type == 'VARIABLE' || old('type') == 'VARIABLE') ? 'selected' : '' }}>Sim</option>
                                                </select>
                                                <input type="hidden" name="type" id="selectType" value="">
                                            </div>
                                            @else
                                            <div class="col-md-3">
                                                <label for="type">Com variação?</label>
                                                <select class="form-control form-control-line select2" name="type" id="type" {{ (isset($produto->type)) ? 'disabled' : '' }}>
                                                    <option value="SIMPLE" {{ (isset($produto->type) && $produto->type == 'SIMPLE' || old('type') == 'SIMPLE') ? 'selected' : '' }}>Não</option>
                                                    <option value="VARIABLE" {{ (isset($produto->type) && $produto->type == 'VARIABLE' || old('type') == 'VARIABLE') ? 'selected' : '' }}>Sim</option>
                                                </select>
                                                <input type="hidden" name="type" id="selectType" value="">
                                            </div>
                                            @endif
                                            <div class="col-md-3">
                                                <label for="featured">Em destaque?</label>
                                                <select class="form-control form-control-line select2" name="featured" id="featured">
                                                    <option value="0" {{ (isset($produto->featured) && $produto->featured == '0') ? 'selected' : '' }}>Não</option>
                                                    <option value="1" {{ (isset($produto->featured) && $produto->featured == '1') ? 'selected' : '' }}>Sim</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="new">Selo de "Novo"?</label>
                                                <select class="form-control form-control-line select2" name="new" id="new">
                                                    <option value="0" {{ (isset($produto->new) && $produto->new == '0') ? 'selected' : '' }}>Não</option>
                                                    <option value="1" {{ (isset($produto->new) && $produto->new == '1') ? 'selected' : '' }}>Sim</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
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
                                                        https://fautriz.com.br/produto/<span class="url-slug">{{ $produto->alias or '' }}</span>
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
                                            @if(isset($produto->type) && $produto->type == 'SIMPLE')
                                            <div class="col-md-6" id="hide-visibility-var">
                                                <label for="visibility">Visibilidade</label>
                                                <select class="form-control form-control-line select2" name="visibility" id="visibility">
                                                    <option value="1" {{ (isset($produto->visibility) && $produto->visibility == '1') ? 'selected' : '' }}>Exibir individualmente</option>
                                                    <option value="0" {{ (isset($produto->visibility) && $produto->visibility == '0') ? 'selected' : '' }}>Não exibir individualmente</option>
                                                </select>
                                            </div>
                                            @endif
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
                                            <div class="col-md-3">
                                                <label for="offer_start">Promoção de</label>
                                                <div class="input-group">
                                                    <input type="text" name="offer_start" id="offer_start" class="form-control form-control-line date datepicker" placeholder="00/00/0000" value="{{ (isset($produto->offer_start)) ? date('d/m/Y', strtotime($produto->offer_start)) : '' }}">
                                                    <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="offer_end">Promoção até</label>
                                                <div class="input-group">
                                                    <input type="text" name="offer_end" id="offer_end" class="form-control form-control-line date datepicker" placeholder="00/00/0000" value="{{ (isset($produto->offer_end)) ? date('d/m/Y', strtotime($produto->offer_end)) : '' }}">
                                                    <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        @if(isset($produto->type) && $produto->type == 'SIMPLE')
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
                                        @endif
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

            {{--Produto Atributo--}}
            <div class="row" id="atributo" style="{{ (isset($produto->type) && $produto->type == 'VARIABLE' || old('type') == 'VARIABLE') ? '' : 'display:none' }}">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Variações do produto
                        </div>

                        <div class="panel-wrapper collapse in">
                            @if(isset($produto->type) && $produto->type == 'VARIABLE')

                                @if(session('error_var'))
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                        <i class="ti-alert"></i> {{ session('status') }}
                                    </div>
                                @endif

                                <div class="table-resposive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="70" class="text-center">
                                                    <i class="ti-image" style="font-size:24px"></i>
                                                </th>
                                                @foreach($prod_variations_dist as $variation)
                                                    <th>{{ \App\Variacoes::getNameVariation($variation->id_variation) }}</th>
                                                @endforeach
                                                <th>Código</th>
                                                <th>Visibilidade</th>
                                                <th>Preço</th>
                                                <th width="150">Estoque</th>
                                                <th width="200">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(is_null($prod_variations))
                                                <tr>
                                                    <td colspan="{{ $prod_variations_dist->count() + 6 }}">
                                                        Ainda não há variações adicionadas para este produto.<br />
                                                        Para adicionar uma nova opção de produto, utilize o botão abaixo.
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach($prod_variations as $parent)
                                                <tr>
                                                    <td align="center">
                                                        @if(is_null(\App\ProdutosImagens::getImage($parent->id)))
                                                            <i class="ti-image" style="font-size:24px"></i>
                                                        @else
                                                            <img src="{{ asset(\App\ProdutosImagens::getImage($parent->id)) }}" alt="{{ $parent->title }}" width="36" height="36">
                                                        @endif
                                                    </td>
                                                    @foreach($prod_variations_dist as $var)
                                                        @php $name = \App\Variacoes::getNameVariation($var->id_variation) @endphp
                                                        <td>{{ \App\VariationsOptions::getNameVariationOption($parent->$name) }}</td>
                                                    @endforeach
                                                    <td>{{ $parent->code }}</td>
                                                    <td>
                                                        @if($parent->visibility)
                                                            <span class="label label-info">Exibir individualmente</span>
                                                        @else
                                                            <span class="label label-inverse">Não exibir individualmente</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-right">
                                                        @if($parent->price)
                                                            @if(!empty($parent->offer_price) && $parent->offer_price != '0.00')
                                                                <s>de @money($parent->price, 'BRL')</s><br />
                                                                <strong>por @money($parent->offer_price, 'BRL')</strong>
                                                            @else
                                                                <strong>@money($parent->price, 'BRL')</strong>
                                                            @endif
                                                        @else
                                                            <strong>-</strong>
                                                        @endif
                                                    </td>
                                                    <td align="center">
                                                        @if($parent->manage_stock == 0 && $parent->in_stock == 1)
                                                            <span class="label label-success">Disponível</span>
                                                        @elseif($parent->manage_stock == 1 && $parent->inventory > 1)
                                                            <span class="label label-success">{{ $parent->inventory }} em estoque</span>
                                                        @else
                                                            <span class="label label-danger">Indisponível</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-circle" onclick="openPopup{{ $parent->id }}()" data-toggle="tooltip" data-placement="top" title="Editar esta variação">
                                                            <i class="fa fa-edit"></i>
                                                        </button>

                                                        <script>
                                                            function openPopup{{ $parent->id }}() {
                                                                window.open("{{ url('admin/produto/variacao/' . $parent->id . '/editar') }}", "_blank", "scrollbars=yes,resizable=yes,width=1000,height=600");
                                                            }
                                                        </script>

                                                        <a href="{{ url('admin/produto/'.$produto->id.'/editar') }}"
                                                           onclick="event.preventDefault();
                                                            document.getElementById('variation-remove').submit();" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="top" title="Excluir esta variação">
                                                            <i class="fa fa-trash"></i>
                                                        </a>

                                                        <a href="{{ url('admin/produto/'.$produto->id.'/variacao/'.$parent->id.'/duplicar') }}" class="btn btn-inverse btn-circle" data-toggle="tooltip" data-placement="top" title="Duplicar esta variação">
                                                            <i class="fa fa-files-o"></i>
                                                        </a>
                                                        <span class="label label-{{ ($parent->status) ? 'success' : 'inverse' }}">{{ ($parent->status) ? 'Ativo' : 'Inativo' }}</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div id="variacoes_new-edit" class="p-3" style="{{ (isset($parentId) && !is_null($parentId)) ? 'display:block' : 'display:none' }}">
                                    <input type="hidden" id="is_opt" name="new_option" value="{{ (isset($parentId->id) && $parentId->id) ? 1 : 0 }}">
                                    <input type="hidden" name="id_parent" value="{{ (isset($parentId->id) && $type_edit == 'editar') ? $parentId->id : '' }}">
                                    <input type="hidden" name="type_edit" value="{{ (isset($type_edit)) ? $type_edit : '' }}">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="status_var">Variação ativa?</label>
                                                    <select class="form-control form-control-line select2" name="status_var" id="status_var">
                                                        <option value="1" {{ (isset($parentId->status) && $parentId->status == '1') ? 'selected' : '' }}>Sim</option>
                                                        <option value="0" {{ (isset($parentId->status) && $parentId->status == '0') ? 'selected' : '' }}>Não</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="visibility">Visibilidade</label>
                                                    <select class="form-control form-control-line select2" name="visibility" id="visibility">
                                                        <option value="0" {{ (isset($parentId->visibility) && $parentId->visibility == '0') ? 'selected' : '' }}>Não exibir individualmente</option>
                                                        <option value="1" {{ (isset($parentId->visibility) && $parentId->visibility == '1') ? 'selected' : '' }}>Exibir individualmente</option>
                                                    </select>
                                                </div>
                                                <div id="visiChange" style="{{ (isset($parentId) && $parentId->visibility == 1) ? 'display:block' : 'display:none' }}">
                                                    <div class="col-md-3">
                                                        <label for="featured_var">Variação em destaque?</label>
                                                        <select class="form-control form-control-line select2" name="featured_var" id="featured_var">
                                                            <option value="0" {{ (isset($parentId->featured) && $parentId->featured == '0') ? 'selected' : '' }}>Não</option>
                                                            <option value="1" {{ (isset($parentId->featured) && $parentId->featured == '1') ? 'selected' : '' }}>Sim</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="new_var">Selo de "Novo"?</label>
                                                        <select class="form-control form-control-line select2" name="new_var" id="new_var">
                                                            <option value="0" {{ (isset($parentId->new) && $parentId->new == '0') ? 'selected' : '' }}>Não</option>
                                                            <option value="1" {{ (isset($parentId->new) && $parentId->new == '1') ? 'selected' : '' }}>Sim</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                @foreach($prod_variations_dist as $variation)
                                                <div class="col-md-3">
                                                    @php $name = \App\Variacoes::getNameVariation($variation->id_variation) @endphp
                                                    <label for="id_variations">{{ $name }}</label>
                                                    <select class="form-control form-control-line select2" name="id_variations[{{ $variation->id_variation }}]" id="id_variations">
                                                        @foreach(\App\VariationsOptions::getOptions($variation->id_variation) as $var)
                                                            <option value="{{ $var->id }}" {{ (isset($parentId->id) && $parentId->$name == $var->id) ? 'selected' : '' }}>{{ $var->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{--<div class="col-md-3 pull-right">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<div class="col-md-12">--}}
                                                    {{--<label>Imagem</label>--}}
                                                    {{--<input type="file" name="image_var" class="dropify" data-height="100" data-default-file="{{ (isset($parentId->image_var) && $type_edit == 'editar') ? asset($parentId->image_var) : '' }}" />--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label for="code_var">Código</label>
                                            <input type="text" name="code_var" id="code_var" class="form-control form-control-line" value="{{ (isset($parentId->code) && $type_edit == 'editar') ? $parentId->code : '' }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="custo_var">Preço de custo</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">R$</span>
                                                <input id="input-group-text" type="text" name="custo_var" id="custo_var" class="form-control form-control-line money" placeholder="0,00" value="{{ $parentId->custo or $produto->custo }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="price_var">Preço de venda</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">R$</span>
                                                <input id="input-group-text" type="text" name="price_var" id="price_var" class="form-control form-control-line money" placeholder="0,00" value="{{ $parentId->price or $produto->price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="offer_price_var">Preço promocional</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">R$</span>
                                                <input id="input-group-text" type="text" name="offer_price_var" id="offer_price_var" class="form-control form-control-line money" placeholder="0,00" value="{{ $parentId->offer_price or $produto->offer_price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="offer_start_var">Promoção de</label>
                                            <div class="input-group">
                                                <input type="text" name="offer_start_var" id="offer_start_var" class="form-control form-control-line date datepicker" placeholder="00/00/0000" value="{{ (isset($parentId->offer_start_var)) ? date('d/m/Y', strtotime($parentId->offer_start_var)) : '' }}">
                                                <span class="input-group-addon"><i class="icon-calender"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="offer_end_var">Promoção até</label>
                                            <div class="input-group">
                                                <input type="text" name="offer_end_var" id="offer_end_var" class="form-control form-control-line date datepicker" placeholder="00/00/0000" value="{{ (isset($parentId->offer_end_var)) ? date('d/m/Y', strtotime($parentId->offer_end_var)) : '' }}">
                                                <span class="input-group-addon"><i class="icon-calender"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <label for="weight_var">Peso <i class="ic-img ic-weight"></i></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-line peso" name="weight_var" id="weight_var" placeholder="0,000" value="{{ $parentId->weight_var or $produto->weight }}">
                                                <span class="input-group-addon">kg</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="dimension_heigth_var">Altura <i class="ic-img ic-height"></i></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-line" name="dimension_heigth_var" id="dimension_heigth_var" value="{{ $parentId->dimension_heigth_var or $produto->dimension_heigth }}">
                                                <span class="input-group-addon">cm</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="dimension_width_var">Largura <i class="ic-img ic-width"></i></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-line" name="dimension_width_var" id="dimension_width_var" value="{{ $parentId->dimension_width_var or $produto->dimension_width }}">
                                                <span class="input-group-addon">cm</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="dimension_length_var">Profundidade <i class="ic-img ic-length"></i></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-line" name="dimension_length_var" id="dimension_length_var" value="{{ $parentId->dimension_length_var or $produto->dimension_length }}">
                                                <span class="input-group-addon">cm</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="manage_stock">Gerenciar o estoque deste produto?</label>
                                            <select class="form-control form-control-line select2" name="manage_stock" id="manage_stock">
                                                <option value="0" {{ (isset($parentId->manage_stock) && $parentId->manage_stock == 0) ? 'selected' : '' }}>Não</option>
                                                <option value="1" {{ (isset($parentId->manage_stock) && $parentId->manage_stock == 1) ? 'selected' : '' }}>Sim</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" id="disp-pct" style="{{ (empty($parentId->inventory)) ? '' : 'display:none' }}">
                                            <label for="in_stock">Qual a disponibilidade dos produtos?</label>
                                            <select class="form-control form-control-line select2" name="in_stock" id="in_stock">
                                                <option value="1" {{ (isset($parentId->in_stock) && $parentId->in_stock == 1) ? 'selected' : '' }}>Disponível em estoque</option>
                                                <option value="0" {{ (isset($parentId->in_stock) && $parentId->in_stock == 0) ? 'selected' : '' }}>Indisponível</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" id="qtd-inv" style="{{ (!empty($parentId->inventory)) ? '' : 'display:none' }}">
                                            <label for="inventory">Quantidade de produtos em estoque</label>
                                            <input type="text" class="form-control form-control-line" name="inventory" id="inventory" value="{{ $parentId->inventory or '' }}">
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-default" id="remvar">Cancelar</button>
                                    @if($type_edit == 'editar')
                                        <a href="{{ url('admin/produto/'.$produto->id.'/variacao/'.$parentId->id.'/duplicar') }}" class="btn btn-info"><i class="fa fa-files-o"></i> Duplicar</a>
                                    @endif
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i> Salvar
                                    </button>
                                </div>

                                <button type="button" class="btn btn-inverse m-3" id="addvar">
                                    <i class="fa fa-plus"></i> Adicionar uma nova variação
                                </button>
                            @else
                                <div class="panel-body">
                                    <div class="alert alert-info" role="alert">
                                        <i class="fa fa-info-circle"></i> Escolha abaixo quais são os tipos de variação que seu produto pode ter. Adicione todas as variações de uma única vez, depois clique em "Continuar cadastro".
                                    </div>

                                    @if(session('status_var_error'))
                                        <div class="alert alert-danger" role="alert">
                                            <i class="fa fa-exclamation-triangle"></i> {{ session('status_var_error') }}
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            @foreach($variacoes as $variacao)
                                                <div class="checkbox">
                                                    <input id="var_{{ $variacao->id }}" name="var[]" type="checkbox" value="{{ $variacao->id }}">
                                                    <label for="var_{{ $variacao->id }}"> {{ $variacao->name }} </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{--Informações gerais--}}
            <div class="row" id="info-gerais" style="{{ (old('type') == 'VARIABLE') ? 'display:none' : '' }}">
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
            <div class="row" id="seo" style="{{ (old('type') == 'VARIABLE') ? 'display:none' : '' }}">
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
            <div class="row" id="estoque" style="{{ (old('type') == 'VARIABLE') ? 'display:none' : '' }}">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Estoque
                        </div>

                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                @if(isset($produto->type) && $produto->type == 'VARIABLE' || old('type') == 'VARIABLE')
                                    <div class="alert alert-info" role="alert">
                                        <i class="fa fa-info-circle"></i> O estoque do produto com variações é definido em cada opção do produto.
                                    </div>
                                @else
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success" data-name="{{ $titles['title2'] }}">
                <i class="fa fa-check"></i> {{ (old('type') == 'VARIABLE') ? 'Continuar Cadastro' : $titles['title2'].' produto' }}
            </button>

            <div class="create-box">
                <button type="submit" class="btn btn-success btn-lg" data-name="{{ $titles['title2'] }}" style="margin-top:-8px;">
                    <i class="fa fa-check"></i> {{ (old('type') == 'VARIABLE') ? 'Continuar Cadastro' : $titles['title2'].' produto' }}
                </button>
            </div>
        </div>
        </form>
    </div>
    <!-- /.container-fluid -->

    @if((isset($produto->type) && $produto->type == 'VARIABLE') && isset($parent->id))
    <form id="variation-remove" action="{{ url('admin/produto/variacao/remover') }}" method="post" style="display:none;">
        {{ csrf_field() }}

        <input type="text" name="id" value="{{ $parent->id }}">
        <input type="text" name="id_product" value="{{ $produto->id }}">
    </form>
    @endif

    @if(session('status'))
        <div class="alert alert-success alert-dismissable alert-fixed">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
            <i class="ti-check"></i> {{ session('status') }}
        </div>
    @endif

    @if(session('statusError'))
        <div class="alert alert-danger alert-dismissable alert-fixed">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
            <i class="ti-close"></i> {{ session('statusError') }}
        </div>
    @endif
@endsection
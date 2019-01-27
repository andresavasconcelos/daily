@extends('admin.layouts.app')

@section('title', $titles['title2'].' Cupom de desconto')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{ $titles['title1'] }} cupom de desconto</h4>
            </div>

            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/cupons') }}">Cupons de Desconto</a></li>
                    <li class="active">{{ $titles['title2'] }} cupom de desconto</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <form class="form-material form-horizontal" role="form" method="POST" action="{{ (isset($cupom->id)) ? url('admin/cupom/'.$cupom->id.'/salvar') : url('admin/cupom/salvar') }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $titles['title1'] }} cupom de desconto
                        </div>

                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="form-group{{ ($errors->has('code')) ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        <label for="status">Cupom ativo?</label>
                                        <select class="form-control form-control-line select2" name="status" id="status">
                                            <option value="1" {{ (isset($cupom->status) && $cupom->status == '1') ? 'selected' : '' }}>Sim</option>
                                            <option value="0" {{ (isset($cupom->status) && $cupom->status == '0') ? 'selected' : '' }}>Não</option>
                                        </select>
                                    </div>
                                    <div class="col-md-9">
                                        <label for="code">Código do cupom</label>
                                        <input type="text" class="form-control form-control-line" name="code" id="code" value="{{ $cupom->code or '' }}">
                                        <span class="help-block"><small>O código do cupom é o que você dará para o seu cliente preencher no carrinho de compras.</small></span>
                                        @if ($errors->has('code'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('code') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ ($errors->has('description')) ? ' has-error' : '' }}"">
                                    <div class="col-md-12">
                                        <label for="description">Descrição do cupom</label>
                                        <textarea class="form-control form-control-line" rows="5" name="description" id="description">{{ $cupom->description or '' }}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('description') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ ($errors->has('value')) ? ' has-error' : '' }}"">
                                    <div class="col-md-3">
                                        <label for="type_coupon">Tipo de cupom</label>
                                        <select class="form-control form-control-line select2" name="type_coupon" id="type_coupon" maxlength="32">
                                            <option value="FIXO" {{ (isset($cupom->type_coupon) && $cupom->type_coupon == 'FIXO') ? 'selected' : '' }}>Valor fixo</option>
                                            <option value="PORC" {{ (isset($cupom->type_coupon) && $cupom->type_coupon == 'PORC') ? 'selected' : '' }}>Porcentagem</option>
                                            <option value="FRETE" {{ (isset($cupom->type_coupon) && $cupom->type_coupon == 'FRETE') ? 'selected' : '' }}>Frete grátis</option>
                                        </select>
                                    </div>
                                    <div class="col-md-9" id="val" style="{{ (isset($cupom->type_coupon) && $cupom->type_coupon == 'FRETE') ? 'display:none' : '' }}">
                                        <label for="value">Valor</label>
                                        <div class="input-group">
                                            <span class="input-group-addon fixo" style="{{ (isset($cupom->type_coupon) && $cupom->type_coupon == 'PORC') ? 'display:none' : 'display:table-cell' }}">R$</span>
                                            @if(isset($cupom->type_coupon) && $cupom->type_coupon == 'FIXO')
                                                @php $value = str_replace('.00', '', $cupom->value) @endphp
                                            @elseif(isset($cupom->type_coupon) && $cupom->type_coupon == 'PORC')
                                                @php $value = $cupom->value @endphp
                                            @else
                                                @php $value = '' @endphp
                                            @endif
                                            <input class="form-control form-control-line {{ (isset($cupom->type_coupon) && $cupom->type_coupon == 'PORC') ? '' : 'money' }}" id="value" name="value" type="text" value="{{ $value }}">
                                            <span class="input-group-addon porcentagem" style="{{ (isset($cupom->type_coupon) && $cupom->type_coupon == 'PORC') ? 'display:table-cell' : 'display:none' }}">%</span>
                                        </div>
                                        <span class="help-block"><small>Este é o valor que será aplicado pelo cupom.</small></span>
                                        @if ($errors->has('value'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('value') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="value_min">Valor minimo</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">R$</span>
                                            <input class="form-control form-control-line money" id="value_min" name="value_min" type="text" value="{{ $cupom->value_min or '' }}">
                                        </div>
                                        <span class="help-block"><small>Caso seja definido este é o valor mínimo para que o cupom seja aplicado. Se o valor dos produtos no carrinho não atingir este valor, o cupom não é aplicado.</small></span>
                                    </div>
                                </div>

                                <div class="form-group{{ ($errors->has('qty')) ? ' has-error' : '' }}"">
                                    <div class="col-md-12">
                                        <label for="qty">Quantidade de cupons</label>
                                        <input class="form-control form-control-line" id="qty" name="qty" type="text" value="{{ $cupom->qty or '' }}">
                                        <span class="help-block"><small>Define a quantidade de vezes que este cupom poderá ser usado. A cada vez que o cupom é usado este número é reduzido automaticamente.</small></span>
                                        @if ($errors->has('qty'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('qty') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-5">
                                        <label for="cumulative">Cupom acumulativo?</label><br />
                                        <select class="form-control form-control-line select2" name="cumulative" id="cumulative" style="width:246px">
                                            <option value="1" {{ (isset($cupom->cumulative) && $cupom->cumulative == '1') ? 'selected' : '' }}>Sim</option>
                                            <option value="0" {{ (isset($cupom->cumulative) && $cupom->cumulative == '0') ? 'selected' : '' }}>Não</option>
                                        </select>
                                        <span class="help-block"><small>Somar desconto com forma de pagamento ou outros descontos.</small></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="qty_by_client">Quantidade por cliente</label>
                                        <input class="form-control form-control-line" id="qty_by_client" name="qty_by_client" type="text" value="{{ $cupom->qty_by_client or '' }}">
                                        <span class="help-block"><small>Número máximo de vezes que um cliente pode usar este cupom. Para não limitar deixe o campo em branco.</small></span>
                                    </div>
                                </div>

                                <div class="form-group{{ ($errors->has('data_end')) ? ' has-error' : '' }}"">
                                    <div class="col-md-12">
                                        <label for="data_end">Validade</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-line datepicker" id="data_end" name="data_end" type="text" placeholder="00/00/0000" value="{{ (isset($cupom->data_end)) ? date('d/m/Y', strtotime($cupom->data_end)) : '' }}">
                                            <span class="input-group-addon"><i class="icon-calender"></i></span>
                                        </div>
                                        <span class="help-block"><small>Data até quando o cupom é válido. Para definir indeterminadamente deixe o campo em branco.</small></span>
                                        @if ($errors->has('data_end'))
                                            <span class="help-block text-danger">
                                                {{ $errors->first('data_end') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group m-b-0">
                                    <div class="col-md-5">
                                        <label for="apply_total">Aplicar no total?</label><br />
                                        <select class="form-control form-control-line select2" name="apply_total" id="apply_total" style="width:246px">
                                            <option value="0" {{ (isset($cupom->apply_total) && $cupom->apply_total == '0') ? 'selected' : '' }}>Não</option>
                                            <option value="1" {{ (isset($cupom->apply_total) && $cupom->apply_total == '1') ? 'selected' : '' }}>Sim</option>
                                        </select>
                                        <span class="help-block"><small>Aplicar desconto no total da compra (incluir por exemplo o frete).</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-success">
                <i class="fa fa-check"></i> {{ $titles['title2'] }} cupom de desconto
            </button>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
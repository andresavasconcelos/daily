@extends('admin.layouts.app')

@section('title', 'Painel')

@section('content')
	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Administração</h4>
			</div>

			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="#">Painel</a></li>
					<li class="active">Administração</li>
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="white-box">
					<h3 class="box-title">Página Painel</h3>

					<!-- .row -->
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="white-box">
								<h3 class="box-title">Vendas Diárias</h3>

								<div class="text-right">
									<span class="text-muted">Hoje</span>
									<h1>
										@if(is_null($diarias->total_sales))
                                            R$ 0,00
                                        @else
                                            <span class="text-success">@money($diarias->total_sales)</span>
                                        @endif
									</h1>
								</div>

								{{--<span class="text-success">20%</span>

								<div class="progress m-b-0">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Complete</span> </div>
								</div>--}}
							</div>
						</div>

						{{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="white-box">
								<h3 class="box-title">Vendas Semanais</h3>
								<div class="text-right"> <span class="text-muted">Renda Semanal</span>
									<h1><sup><i class="ti-arrow-down text-danger"></i></sup> R$ 5.000</h1> </div> <span class="text-danger">30%</span>
								<div class="progress m-b-0">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:30%;"> <span class="sr-only">230% Complete</span> </div>
								</div>
							</div>
						</div>--}}


						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="white-box">
								<h3 class="box-title">Vendas Mensais</h3>

								<div class="text-right">
									<span class="text-muted">Mensal</span>
									<h1>
                                        @if(is_null($mensais->total_sales))
                                            R$ 0,00
                                        @else
                                            <span class="text-success">@money($mensais->total_sales)</span>
                                        @endif
									</h1>
								</div>

								{{--<span class="text-success">20%</span>

								<div class="progress m-b-0">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Complete</span> </div>
								</div>--}}
							</div>
						</div>

						{{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="white-box">
								<h3 class="box-title">Vendas Anuais</h3>
								<div class="text-right"> <span class="text-muted">Rendimento Anual</span>
									<h1><sup><i class="ti-arrow-up text-inverse"></i></sup> R$ 9.000</h1> </div> <span class="text-inverse">80%</span>
								<div class="progress m-b-0">
									<div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">230% Complete</span> </div>
								</div>
							</div>
						</div>--}}

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="white-box">
								<h3 class="box-title">Vendas Anuais</h3>

								<div class="text-right">
									<span class="text-muted">Anual</span>
									<h1>
										{{--<sup><i class="ti-arrow-up text-success"></i></sup>--}}
                                        @if(is_null($anuais->total_sales))
                                            R$ 0,00
                                        @else
                                            <span class="text-success">@money($anuais->total_sales)</span>
                                        @endif
									</h1>
								</div>

								{{--<span class="text-success">20%</span>

								<div class="progress m-b-0">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Complete</span> </div>
								</div>--}}
							</div>
						</div>
					</div>
					<!-- /.row -->


				</div>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
@endsection

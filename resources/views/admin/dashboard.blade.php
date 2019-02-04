@extends('layout_admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ count($totalProjeto) }}</h3>
                            <p>Projeto</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion ion-person-add"></i>
                        </div>
                        <a href="{{ url('/admin/projetos') }}" class="small-box-footer">veja mais <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ count($daily) }}</h3>
                            <p>Daily</p>
                        </div>
                        <div class="icon">
                            <i class="fa ion-person-add"></i>
                        </div>
                        <a href="{{ url('/admin/dailies') }}" class="small-box-footer">veja mais <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

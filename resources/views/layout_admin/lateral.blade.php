
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('/admin/painel') }}" class="brand-link">
            <img src="{{ asset('images/logo_tmontec.png') }}"
                 alt="Logo Empreenda"
                 class="brand-image elevation-3 float-none"
                 style="opacity: .8">
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            {{--<div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
                {{--<div class="image">--}}
                    {{--<img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">--}}
                {{--</div>--}}
                {{--<div class="info">--}}
                    {{--<a href="#" class="d-block">{{ Auth::user()->name }}</a>--}}
                {{--</div>--}}
            {{--</div>--}}

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview">
                        <a href="{{ url('admin/painel') }}" class="nav-link">
                            <i class="fa fa-home nav-icon"></i>
                            <p>
                                Painel
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fa fa-folder-open nav-icon" aria-hidden="true"></i>
                            <p>
                                Projeto
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('admin/projetos') }}" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>Listar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/projeto/adicionar') }}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Adicionar</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fa fa-users nav-icon" aria-hidden="true"></i>
                            <p>
                                Funcionários
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('admin/funcionarios') }}" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>Listar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/funcionario/adicionar') }}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Adicionar</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fa fa-hourglass-start nav-icon" aria-hidden="true"></i>
                            <p>
                                Daily
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('admin/dailies') }}" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>Listar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/daily/adicionar') }}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Adicionar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/images/favicon.png') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - fautriz - CuboCommerce</title>

        <!-- Styles -->
        <link href="{{ asset('admin/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/plugins/bootstrap-extension/css/bootstrap-extension.css') }}" rel="stylesheet" type="text/css">
        <!-- Menu CSS -->
        <link href="{{ asset('admin/plugins/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
        <!-- animation CSS -->
        <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/spinners.css') }}" rel="stylesheet">
        <!-- color CSS -->
        <link href="{{ asset('admin/css/colors/blue-dark.css') }}" id="theme" rel="stylesheet">

        <!-- PLugins Pages -->
        <link href="{{ asset('admin/plugins/custom-select/custom-select.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/plugins/treeview/treeview.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};

            window._url = '{{ url('/') }}';
        </script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    @if(Request::path() === 'admin/login' || Request::path() === 'admin/login/resetar')
    <body>
    @else
    <body class="fix-sidebar fix-header">
    @endif
        <!-- Preloader -->
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>

        @if (Auth::guard('admins')->user())
        <div id="wrapper">
            <!-- Top Navigation -->
            <nav class="navbar navbar-default navbar-static-top m-b-0">
                <div class="navbar-header">
                    <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="ti-menu"></i>
                    </a>

                    <div class="top-left-part">
                        <a class="logo" href="{{ url('admin/painel') }}">
                            <b><img src="{{ asset('admin/images/eliteadmin-logo.png') }}" alt="home" /></b>
                            <span class="hidden-xs">
                                <strong>Cubo</strong>Commerce
                            </span>
                        </a>
                    </div>

                    <ul class="nav navbar-top-links navbar-left hidden-xs">
                        <li>
                            <a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light">
                                <i class="icon-arrow-left-circle ti-menu"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-top-links navbar-right pull-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#">
                                <i class="icon-bell"></i>
                                {{--<div class="notify">
                                    <span class="heartbit"></span>
                                    <span class="point"></span>
                                </div>--}}
                            </a>
                            <!-- notifications ->
                            <ul class="dropdown-menu mailbox animated bounceInDown">
                                <li>
                                    <div class="drop-title">4 novas notificações</div>
                                </li>
                                <li>
                                    <div class="message-center">
                                        <a href="#">
                                            <div class="user-img">
                                                <img src="{{ asset('admin/images/users/pawandeep.jpg') }}" alt="user" class="img-circle">
                                                <span class="profile-status online pull-right"></span>
                                            </div>

                                            <div class="mail-contnet">
                                                <h5>Pavan kumar</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:30 AM</span>
                                            </div>
                                        </a>

                                        <a href="#">
                                            <div class="user-img">
                                                <img src="{{ asset('admin/images/users/sonu.jpg') }}" alt="user" class="img-circle">
                                                <span class="profile-status busy pull-right"></span>
                                            </div>

                                            <div class="mail-contnet">
                                                <h5>Sonu Nigam</h5>
                                                <span class="mail-desc">I've sung a song! See you at</span>
                                                <span class="time">9:10 AM</span>
                                            </div>
                                        </a>

                                        <a href="#">
                                            <div class="user-img">
                                                <img src="{{ asset('admin/images/users/arijit.jpg') }}" alt="user" class="img-circle">
                                                <span class="profile-status away pull-right"></span>
                                            </div>

                                            <div class="mail-contnet">
                                                <h5>Arijit Sinh</h5>
                                                <span class="mail-desc">I am a singer!</span>
                                                <span class="time">9:08 AM</span>
                                            </div>
                                        </a>

                                        <a href="#">
                                            <div class="user-img">
                                                <img src="{{ asset('admin/images/users/pawandeep.jpg') }}" alt="user" class="img-circle">
                                                <span class="profile-status offline pull-right"></span>
                                            </div>

                                            <div class="mail-contnet">
                                                <h5>Pavan kumar</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:02 AM</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="text-center" href="javascript:void(0);">
                                        <strong>Ver todas as notificações</strong> <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                            <!- /notifications -->
                        </li>
                        <!-- /.dropdown -->

                        <!-- /.dropdown-user -->
                        <li class="dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                                @if(Auth::guard('admins')->user()->photo)
                                    <img src="{{ asset(Auth::guard('admins')->user()->photo) }}" alt="user-img" width="36" class="img-circle">
                                @else
                                    <img src="{{ asset('admin/images/users/no-photo.jpg') }}" alt="user-img" width="36" class="img-circle">
                                @endif
                                <b class="hidden-xs">{{ Auth::guard('admins')->user()->name }}</b>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated bounceInDown">
                                <li>
                                    <a href="{{ url('admin/usuario/'.Auth::guard('admins')->user()->id.'/editar') }}">
                                        <i class="ti-settings"></i>  Conta
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ url('admin/sair') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"></i>  Sair
                                    </a>
                                    <form id="logout-form" action="{{ url('admin/sair') }}" method="POST" style="display:none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <!-- /.dropdown-user -->
                    </ul>
                </div>
                <!-- /.navbar-header -->
                <!-- /.navbar-top-links -->
                <!-- /.navbar-static-side -->
            </nav>
            <!-- End Top Navigation -->

            <!-- Left navbar-header -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                    @php $currentUrl = Request::url() @endphp
                    <ul class="nav" id="side-menu">
                        <li class="nav-small-cap m-t-10">--- Menu</li>

                        <li>
                            <a href="{{ url('/admin/painel') }}" class="waves-effect {{ (str_contains($currentUrl, '/painel')) ? 'active' : '' }}">
                                <i class="icon-grid fa-fw"></i> <span class="hide-menu">Painel</span>
                            </a>
                        </li>

                        <li class="{{ (str_contains($currentUrl, ['/pedido', '/cliente', '/relatorio'])) ? 'active' : '' }}">
                            <a href="javascript:void(0)" class="waves-effect {{ (str_contains($currentUrl, ['/pedido', '/cliente', '/relatorio'])) ? 'active' : '' }}">
                                <i class="icon-basket-loaded fa-fw"></i> <span class="hide-menu">Vendas<span class="fa arrow"></span></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ url('/admin/pedidos') }}" class="{{ (str_contains($currentUrl, '/pedido')) ? 'active' : '' }}">Pedidos</a></li>
                                <li><a href="{{ url('/admin/clientes') }}" class="{{ (str_contains($currentUrl, '/cliente')) ? 'active' : '' }}">Clientes</a></li>
                                {{--<li><a href="{{ url('/admin/relatorios') }}" class="{{ (str_contains($currentUrl, '/relatorio')) ? 'active' : '' }}">Relatórios</a></li>--}}
                            </ul>
                        </li>

                        <li class="{{ (str_contains($currentUrl, ['/produto', '/categoria', '/variacoes', '/variacao', '/marca'])) ? 'active' : '' }}">
                            <a href="javascript:void(0)" class="waves-effect {{ (str_contains($currentUrl, ['/produto', '/categoria', '/variacoes', '/variacao', '/marca'])) ? 'active' : '' }}">
                                <i class="icon-layers fa-fw"></i> <span class="hide-menu">Produtos<span class="fa arrow"></span></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ url('/admin/produtos') }}" class="{{ (str_contains($currentUrl, '/produtos')) ? 'active' : '' }}">Listar</a></li>
                                <li><a href="{{ url('/admin/produto/criar') }}" class="{{ (str_contains($currentUrl, '/produto/criar')) ? 'active' : '' }}">Criar</a></li>
                                <li class="nav-small-cap m-t-0 m-l-30">--- Organizar</li>
                                <li><a href="{{ url('/admin/categorias') }}" class="{{ (str_contains($currentUrl, '/categoria')) ? 'active' : '' }}">Categorias</a></li>
                                <li><a href="{{ url('/admin/variacoes') }}" class="{{ (str_contains($currentUrl, ['/variacao', '/variacoes'])) ? 'active' : '' }}">Variações</a></li>
                                <li><a href="{{ url('/admin/marcas') }}" class="{{ (str_contains($currentUrl, '/marca')) ? 'active' : '' }}">Marcas</a></li>
                            </ul>
                        </li>

                        <li class="{{ (str_contains($currentUrl, ['/cupom', '/cupons', '/frete-gratis', '/newsletter', '/avise-me', '/blog'])) ? 'active' : '' }}">
                            <a href="javascript:void(0)" class="waves-effect {{ (str_contains($currentUrl, ['/cupom', '/cupons', '/frete-gratis', '/newsletter', '/avise-me', '/blog'])) ? 'active' : '' }}">
                                <i class="icon-graph fa-fw"></i> <span class="hide-menu">Marketing<span class="fa arrow"></span></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ url('/admin/cupons') }}" class="waves-effect {{ (str_contains($currentUrl, ['/cupom', '/cupons'])) ? 'active' : '' }}">Cupons de Desconto</a></li>
                                <li><a href="{{ url('/admin/frete-gratis') }}" class="waves-effect {{ (str_contains($currentUrl, '/frete-gratis')) ? 'active' : '' }}">Frete Grátis</a></li>
                                <li class="{{ (str_contains($currentUrl, ['/modelo', '/fila-de-envio', '/assinaturas'])) ? 'active' : '' }}">
                                    <a href="javascript:void(0)" class="waves-effect {{ (str_contains($currentUrl, '/newsletter')) ? 'active' : '' }}">
                                        Newsletter<span class="fa arrow"></span>
                                    </a>
                                    <ul class="nav nav-third-level">
                                        <li><a  href="{{ url('/admin/newsletter/assinaturas') }}" class="waves-effect {{ (str_contains($currentUrl, '/assinaturas')) ? 'active' : '' }}">Assinaturas</a></li>
                                        {{--<li><a  href="{{ url('/admin/newsletter/modelos') }}" class="waves-effect {{ (str_contains($currentUrl, '/modelo')) ? 'active' : '' }}">Modelos</a></li>--}}
                                        {{--<li><a  href="{{ url('/admin/newsletter/fila-de-envio') }}" class="waves-effect {{ (str_contains($currentUrl, '/fila-de-envio')) ? 'active' : '' }}">Fila de envio</a></li>--}}
                                    </ul>
                                </li>
                                <li><a href="{{ url('/admin/avise-me') }}" class="{{ (str_contains($currentUrl, '/avise-me')) ? 'active' : '' }}">Avise-me</a></li>
                                <li><a href="{{ url('/admin/blog') }}" class="{{ (str_contains($currentUrl, '/blog')) ? 'active' : '' }}">Blog</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('/admin/usuarios') }}" class="waves-effect {{ (str_contains($currentUrl, '/usuario')) ? 'active' : '' }}">
                                <i class="icon-people fa-fw"></i> <span class="hide-menu">Usuários</span>
                            </a>
                        </li>
                        {{--<li>--}}
                            {{--<a href="{{ url('/admin/configuracoes') }}" class="waves-effect {{ (str_contains($currentUrl, '/configuracoes')) ? 'active' : '' }}">--}}
                                {{--<i class="icon-settings fa-fw"></i> <span class="hide-menu">Configurações</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    </ul>
                </div>
            </div>
            <!-- Left navbar-header end -->

            <!-- Page Content -->
            <div id="page-wrapper">

                @yield('content')

                <footer class="footer text-center"> 2017 &copy; CuboCommerce by tmontec</footer>
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        @else
            @yield('content')
        @endif

        <!-- jQuery -->
        <script src="{{ asset('admin/plugins/jquery/test/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/jqueryui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/jqueryui/ui/widget.js') }}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('admin/bootstrap/dist/js/tether.min.js') }}"></script>
        <script src="{{ asset('admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/bootstrap-extension/js/bootstrap-extension.min.js') }}"></script>
        <!-- Menu Plugin JavaScript -->
        <script src="{{ asset('admin/plugins/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
        <!--slimscroll JavaScript -->
        <script src="{{ asset('admin/js/jquery.slimscroll.js') }}"></script>
        <!--Wave Effects -->
        <script src="{{ asset('admin/js/waves.js') }}"></script>

        <!--Style Switcher -->
        <script src="{{ asset('admin/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>

        <!--Plugins Pages -->
        <script src="{{ asset('admin/plugins/custom-select/custom-select.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/urlify/urlify.js') }}"></script>
        <script src="{{ asset('admin/plugins/mask/jquery.mask.js') }}"></script>
        <script src="{{ asset('admin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
        <script src="{{ asset('admin/plugins/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/dropify/js/dropify.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/jquery-fileupload/jquery.fileupload.js') }}"></script>
        <script src="{{ asset('admin/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/treeview/treeview.js') }}"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('admin/js/app.js') }}"></script>
        <script src="{{ asset('admin/js/jasny-bootstrap.js') }}"></script>
    @yield('scripts')
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/images/favicon.png') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - Depósito da Lingerie - CuboCommerce</title>

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
    <body style="background:#edf1f5;">
        <!-- Preloader -->
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>

        @yield('contentModal')

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
        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('admin/js/app.js') }}"></script>
        <script src="{{ asset('admin/js/jasny-bootstrap.js') }}"></script>
        <!--Style Switcher -->
        <script src="{{ asset('admin/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>

        <!--Plugins Pages -->
        <script src="{{ asset('admin/plugins/custom-select/custom-select.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/urlify/urlify.js') }}"></script>
        <script src="{{ asset('admin/plugins/jquery-mask/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
        <script src="{{ asset('admin/plugins/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/dropify/js/dropify.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/jquery-fileupload/jquery.fileupload.js') }}"></script>
        <script src="{{ asset('admin/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/treeview/treeview.js') }}"></script>
    </body>
</html>
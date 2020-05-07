<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Agroxa - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="{{asset('themes/vertical')}}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="{{asset('themes/vertical')}}/assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
        <link href="{{asset('themes/vertical')}}/assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="{{asset('themes/vertical')}}/assets/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <!-- Background -->
        <div class="account-pages"></div>
        <!-- Begin page -->
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center m-0">
                        <a href="" class="logo logo-admin"><img src="{{asset('themes/vertical')}}/assets/images/logo.png" height="30" alt="logo"></a>
                    </h3>

                    <div class="p-3">
                        <h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>
                        <p class="text-muted text-center">Sign in to continue to administrator.</p>

                        @yield('content')
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <p class="text-muted">© {{ date('Y') }} Kamartamu.</p>
            </div>

        </div>

        <!-- END wrapper -->
            

        <!-- jQuery  -->
        <script src="{{ asset('themes/vertical') }}/assets/js/jquery.min.js"></script>
        <script src="{{ asset('themes/vertical') }}/assets/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('themes/vertical') }}/assets/js/metisMenu.min.js"></script>
        <script src="{{ asset('themes/vertical') }}/assets/js/jquery.slimscroll.js"></script>
        <script src="{{ asset('themes/vertical') }}/assets/js/waves.min.js"></script>

        <script src="{{ asset('themes') }}/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <!-- App js -->
        <script src="{{ asset('themes/vertical') }}/assets/js/app.js"></script>

    </body>

</html>
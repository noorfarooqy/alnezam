<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> Al Nezam Al Asasy</title>
    <!--favicon-->
    <link rel="icon" href="{{env('APP_URL')}}/assets/images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS-->
    <link href="{{env('APP_URL')}}/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Icons CSS-->
    <link href="{{env('APP_URL')}}/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Sidebar CSS-->
    <link href="{{env('APP_URL')}}/assets/css/sidebar-menu.css" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="{{env('APP_URL')}}/assets/css/app-style.css" rel="stylesheet" />
    @yield('links')
    <!-- skins CSS-->
    <link href="{{env('APP_URL')}}/assets/css/skins.css" rel="stylesheet" />

</head>

<body>

    <!-- start loader -->
    <div id="pageloader-overlay" class="visible incoming">
        <div class="loader-wrapper-outer">
            <div class="loader-wrapper-inner">
                <div class="loader"></div>
            </div>
        </div>
    </div>
    <!-- end loader -->

    <!-- Start wrapper-->
    <div id="wrapper">


        <div class="clearfix"></div>

        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    @yield('mail-body')
                </div>


            </div>

            <!--Start footer-->
            <footer class="footer">
                <div class="container">
                    <div class="text-center">
                        Copyright © {{gmdate('Y',time())}} <a href="https://drongo.tech">Drongo Technology</a>
                    </div>
                </div>
            </footer>
            <!--End footer-->

        </div>
    </div>
    <!--End wrapper-->


    <!-- Bootstrap core JavaScript-->
    <script src="{{env('APP_URL')}}/assets/js/jquery.min.js"></script>
    <script src="{{env('APP_URL')}}/assets/js/popper.min.js"></script>
    <script src="{{env('APP_URL')}}/assets/js/bootstrap.min.js"></script>

    <!-- simplebar js -->
    <script src="{{env('APP_URL')}}/assets/plugins/simplebar/js/simplebar.js"></script>
    <!-- sidebar-menu js -->
    <script src="{{env('APP_URL')}}/assets/js/sidebar-menu.js"></script>
    @yield('scripts')
    <!-- Custom scripts -->
    <script src="{{env('APP_URL')}}/assets/js/app-script.js"></script>

</body>

</html>

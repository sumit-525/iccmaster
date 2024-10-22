
<!doctype html>
<html lang="en">

<head>
    <title>{{ config('app.name') }} - @yield('title', __('Payment Required'))</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Iconic Bootstrap 4.5.0 Admin Template">
    <meta name="author" content="WrapTheme, design by: ThemeMakker.com">

    <link rel="icon" href="{{ asset('assets/dist/favicon-32x32.png') }}" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<body data-theme="light" class="font-nunito">

    <div id="wrapper" class="theme-cyan">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30">
                    <img src="https://greenurjaandenergyefficiencyawards.indianchamber.org/wp-content/themes/icc_green_urja/icc_green_urja/assets/images/logo.svg"
                         width="200" height="200" alt="Iconic">
                </div>
                <p>Please wait...</p>
            </div>
        </div>

        <!-- Vertical alignment -->
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle maintenance">
                <div class="text-center">
                    <article>
                        <h1>@yield('code', '402') - @yield('title', __('Payment Required'))<br/></h1>
                        <div>
                            <p>@yield('message', __('Payment Required. Please make a payment to proceed.'))</p>
                        </div>
                    </article>
                    <div class="margin-top-30">
                        <a href="javascript:history.go(-1)" class="btn btn-default"><i class="fa fa-arrow-left"></i> <span>Go Back</span></a>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-info"><i class="fa fa-home"></i> <span>Home</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
</body>
</html>

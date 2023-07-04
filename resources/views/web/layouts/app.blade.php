<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ $web_assets }}/https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="{{ $web_assets }}/fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{ $web_assets }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/owl.theme.default.min.css">

    @livewireStyles

    <link rel="stylesheet" href="{{ $web_assets }}/css/aos.css">

    <link rel="stylesheet" href="{{ $web_assets }}/css/style.css">

    <style>
        .popup-message-when-item-added {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-10%, -10%);
            background-color: green;
            color: white;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
            z-index: 9999;
        }
    </style>

</head>

<body>
    <div class="site-wrap">
        @include('web.layouts.include.navigation')
        <livewire:cart-counter />
        @yield('contents')
        @include('web.layouts.include.footer')
    </div>

    <script src="{{ $web_assets }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ $web_assets }}/js/jquery-ui.js"></script>
    <script src="{{ $web_assets }}/js/popper.min.js"></script>
    <script src="{{ $web_assets }}/js/bootstrap.min.js"></script>
    <script src="{{ $web_assets }}/js/owl.carousel.min.js"></script>
    <script src="{{ $web_assets }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ $web_assets }}/js/aos.js"></script>

    <script src="{{ $web_assets }}/js/main.js"></script>

    @livewireScripts
</body>

</html>

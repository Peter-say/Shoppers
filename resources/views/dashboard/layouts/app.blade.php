<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="CryptoDash admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
        content="admin template, CryptoDash Cryptocurrency Dashboard Template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="ThemeSelection">
    <title>ICO Dashboard - CryptoDash - Free Cryptocurrency Dashboard Template + Bitcoin Dashboard</title>
    <link rel="apple-touch-icon" href="{{ $dashboard_assets }}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ $dashboard_assets }}/app-assets/images/ico/favicon.ico">
    <link
        href="{{ $dashboard_assets }}/https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i|Comfortaa:300,400,500,700"
        rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ $dashboard_assets }}/app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $dashboard_assets }}/app-assets/vendors/css/charts/chartist.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $dashboard_assets }}/app-assets/vendors/css/charts/chartist-plugin-tooltip.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ $dashboard_assets }}/app-assets/css/app.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ $dashboard_assets }}/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $dashboard_assets }}/app-assets/vendors/css/cryptocoins/cryptocoins.css">
    <link rel="stylesheet" type="text/css" href="{{ $dashboard_assets }}/app-assets/css/pages/timeline.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $dashboard_assets }}/app-assets/css/pages/dashboard-ico.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ $dashboard_assets }}/assets/css/style.css">
    <!-- END Custom CSS-->
</head>

<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-compact-menu" data-col="2-columns">
    @include('dashboard.layouts.navigation')
    @yield('contents')
    @include('dashboard.layouts.footer')
    <!-- BEGIN VENDOR JS-->
    <script src="{{ $dashboard_assets }}/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ $dashboard_assets }}/app-assets/vendors/js/charts/chartist.min.js" type="text/javascript">
    </script>
    <script src="{{ $dashboard_assets }}/app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js"
        type="text/javascript"></script>
    <script src="{{ $dashboard_assets }}/app-assets/vendors/js/timeline/horizontal-timeline.js"
        type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{{ $dashboard_assets }}/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="{{ $dashboard_assets }}/app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ $dashboard_assets }}/app-assets/js/scripts/pages/dashboard-ico.js" type="text/javascript">
    </script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Inbox</title>

    <script>
        tinymce.init({
            selector: 'textarea', // Target the appropriate textarea elements
        });
    </script>

    <!-- Fontfaces CSS-->
    <link href="{{ $dashboard_assets }}/css/font-face.css" rel="stylesheet" media="all">
    <link href="{{ $dashboard_assets }}/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet"
        media="all">
    <link href="{{ $dashboard_assets }}/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet"
        media="all">
    <link href="{{ $dashboard_assets }}/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ $dashboard_assets }}/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ $dashboard_assets }}/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="{{ $dashboard_assets }}/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css"
        rel="stylesheet" media="all">
    <link href="{{ $dashboard_assets }}/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="{{ $dashboard_assets }}/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="{{ $dashboard_assets }}/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="{{ $dashboard_assets }}/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="{{ $dashboard_assets }}/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet"
        media="all">

    <!-- Main CSS-->
    <link href="{{ $dashboard_assets }}/css/theme.css" rel="stylesheet" media="all">
    <style>
        .required::after {
            content: '*';
            color: red;
            margin-left: 5px;
        }

        #popup-message {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            text-align: center;
            z-index: 9999;
        }

        .popup-message.success {
            background-color: green;
        }

        .popup-message.error {
            background-color: red;
        }
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        @if (Auth::check())
            @include('dashboard.admin.layouts.mobile-navigation')
            @include('dashboard.admin.layouts.sidebar')
        @endif
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            @if (Auth::check())
                @include('dashboard.admin.layouts.desktop-navigation')
            @endif
            @yield('contents')

        </div>
    </div>

    <!-- Jquery JS-->
    <script src="{{ $dashboard_assets }}/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="{{ $dashboard_assets }}/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="{{ $dashboard_assets }}/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="{{ $dashboard_assets }}/vendor/slick/slick.min.js"></script>
    <script src="{{ $dashboard_assets }}/vendor/wow/wow.min.js"></script>
    <script src="{{ $dashboard_assets }}/vendor/animsition/animsition.min.js"></script>
    <script src="{{ $dashboard_assets }}/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="{{ $dashboard_assets }}/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="{{ $dashboard_assets }}/vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="{{ $dashboard_assets }}/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="{{ $dashboard_assets }}/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ $dashboard_assets }}/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="{{ $dashboard_assets }}/vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="{{ $dashboard_assets }}/js/main.js"></script>

    {{-- TINYMCE --}}
    <script src="https://cdn.tiny.cloud/1/9kceokxig3p7h7aj82ykjwy3ohrak2bq8wozjh90w23fr1mz/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="{{ $dashboard_assets }}/js/tinymce-config.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var popup = document.getElementById('popup-message');

            if (popup) { // Check if the popup element exists on the page
                setTimeout(function() {
                    popup.style.display = 'none';
                }, 4000);

                // Optional: Hide the pop-up when clicking outside of it
                document.addEventListener('click', function(event) {
                    if (event.target !== popup && !popup.contains(event.target)) {
                        popup.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>

</html>
<!-- end document-->

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
        .popup-message {
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

    <script>
        var addToCartButton = document.getElementById('add-to-cart-button');
        addToCartButton.addEventListener('click', function() {
            showPopup();
        });

        function showPopup() {
            var popup = document.getElementById('popup-message');
            popup.style.display = 'block';
            setTimeout(function() {
                hidePopup();
            }, 4000);
        }

        function hidePopup() {
            var popup = document.getElementById('popup-message');
            popup.style.display = 'none';
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Retrieve the active navigation item from local storage
            var activeNavItem = localStorage.getItem('activeNavItem');

            // Set the active state on the corresponding navigation item
            if (activeNavItem) {
                var activeItem = document.getElementById(activeNavItem);
                if (activeItem) {
                    activeItem.classList.add('active');
                }
            }

            // Add click event listeners to the navigation items
            var navItems = document.querySelectorAll('.site-menu li');
            navItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    // Remove active state from all navigation items
                    navItems.forEach(function(navItem) {
                        navItem.classList.remove('active');
                    });

                    // Set active state on the clicked navigation item
                    this.classList.add('active');

                    // Store the active navigation item in local storage
                    var activeNavItem = this.id;
                    localStorage.setItem('activeNavItem', activeNavItem);
                });
            });
        });
    </script>

</body>


</html>

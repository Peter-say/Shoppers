<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="{{ $web_assets }}/fonts/icomoon/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ $web_assets }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href=" https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link href="https://cdn.jsdelivr.net/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    @livewireStyles

    <link rel="stylesheet" href="{{ $web_assets }}/css/aos.css">

    <link rel="stylesheet" href="{{ $web_assets }}/css/style.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/not-found.css">

    <style>
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
            color: #ffffff
        }

        .popup-message.error {
            background-color: red;
        }

        #cancel-popup {
            font-size: 24px;
            color: #ffffff;
            cursor: pointer;
        }


        .profile-container {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-image {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .file-container {
            text-align: center;
        }

        .readonly-input {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }

        .edit-profile-message {
            display: inline-block;
            color: black;
            font-size: 14px;
        }

        .category-image {
        position: relative;
        width: 100%;
        padding-top: 100%;
        overflow: hidden;
    }

    .category-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    </style>

</head>

<body>
    <div class="site-wrap">
        @include('web.layouts.include.navigation')
        @yield('contents')
        @include('web.layouts.include.footer')
    </div>

    @livewireScripts
    <script src="{{ $web_assets }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ $web_assets }}/js/jquery-ui.js"></script>
    <script src="{{ $web_assets }}/js/popper.min.js"></script>
    <script src="{{ $web_assets }}/js/bootstrap.min.js"></script>
    <script src="{{ $web_assets }}/js/owl.carousel.min.js"></script>
    <script src="{{ $web_assets }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ $web_assets }}/js/aos.js"></script>

    <script src="{{ $web_assets }}/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/lightbox2/2.11.3/js/lightbox.min.js"></script>


    <script>
        // wishlist form
        const wishlistForm = document.getElementById('wishlistForm');

        const heartIcon = document.querySelector('.icon-heart-o');
        heartIcon.addEventListener('click', function() {
            wishlistForm.submit();
        });
        // end wishlist form

        // pop up message script

            var popup = document.getElementById('popup-message');

            if (popup) {
                setTimeout(function() {
                    popup.style.display = 'none';
                }, 10000);

                // Hide the pop-up when clicking the close button
                var closeButton = document.getElementById('cancel-popup');
                if (closeButton) {
                    closeButton.addEventListener('click', function() {
                        popup.style.display = 'none';
                    });
                }
            }
      


        var walletRadio = document.getElementById('wallet-check-input');
        var stripeRadio = document.getElementById('stripe-check-input');
        var walletButton = document.getElementById('pay-with-wallet-button');
        var stripeButton = document.getElementById('pay-with-stripe-button');

        stripeButton.style.display = 'none';
        walletRadio.addEventListener('change', function() {
            if (this.checked) {
                walletButton.style.display = 'block';
                stripeButton.style.display = 'none';
            }
        });

        stripeRadio.addEventListener('change', function() {
            if (this.checked) {
                walletButton.style.display = 'none';
                stripeButton.style.display = 'block';
            }
        });

        function preventDefaultFormSubmission(event) {
            event.preventDefault(); // Prevents the default form submission
        }
        document.getElementById('proceed-to-pay-modal-button').addEventListener('click', preventDefaultFormSubmission);
        document.getElementById('pay-with-paypal-button').addEventListener('click', preventDefaultFormSubmission);
    </script>
</body>


</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ $web_assets }}/https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="{{ $web_assets }}/fonts/icomoon/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="{{ $web_assets }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/owl.theme.default.min.css">

    @livewireStyles

    <link rel="stylesheet" href="{{ $web_assets }}/css/aos.css">

    <link rel="stylesheet" href="{{ $web_assets }}/css/style.css">

    <style>
        #popup-message {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: green;
            padding: 10px;
            text-align: center;
            z-index: 9999;
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

        .file-button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .file-button input[type="file"] {
            display: none;
        }
    </style>

</head>

<body>
    <div class="site-wrap">
        @include('web.layouts.include.navigation')
        @yield('contents')
        @include('web.layouts.include.footer')
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

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
        document.addEventListener('DOMContentLoaded', function() {
            var popup = document.getElementById('popup-message');
            setTimeout(function() {
                popup.style.display = 'none';
            }, 4000);
        });

        // Optional: Hide the pop-up when clicking outside of it
        document.addEventListener('click', function(event) {
            var popup = document.getElementById('popup-message');
            if (event.target !== popup && !popup.contains(event.target)) {
                popup.style.display = 'none';
            }
        });
    </script>


<script>
    $(document).ready(function() {
        // Initialize Typeahead.js on the country input field
        $('#c_country').typeahead({
            source: function(query, process) {
                // Send an AJAX request to fetch country suggestions from the server
                $.ajax({
                    url: 'search/countries',
                    method: 'GET',
                    data: { query: query },
                    dataType: 'json',
                    success: function(response) {
                        // Process the response and extract the country names
                        var countries = response.data.map(function(item) {
                            return item.name;
                        });

                        // Process the filtered countries and display them as suggestions
                        var filteredCountries = $.grep(countries, function(country) {
                            return country.toLowerCase().startsWith(query.toLowerCase());
                        });

                        // Process the filtered countries and display them as suggestions
                        process(filteredCountries);
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Handle the error if the request fails
                    }
                });
            }
        });
    });
</script>




</body>


</html>

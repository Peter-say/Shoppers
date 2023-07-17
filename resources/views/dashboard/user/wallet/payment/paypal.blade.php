<!DOCTYPE html>
<html>
<head>
    <title>PayPal Checkout</title>
</head>
<body>
    <div id="paypal-button-container"></div>

    <script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.client_id') }}&currency=USD"></script>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return fetch('{{ route('paypal.checkout') }}', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(function(response) {
                    return response.json();
                }).then(function(data) {
                    return data.id;
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    console.log(details);
                    // Add your own logic to handle the successful payment
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>

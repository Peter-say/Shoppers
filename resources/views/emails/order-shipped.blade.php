<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */
    </style>
</head>

<body>
    <h2>Your Order Has Been Shipped!</h2>

    <p>Dear {{ $order->user->full_name }},</p>

    <p>We are excited to inform you that your order with the following details has been shipped:</p>

    <h3>Order Details:</h3>
    <p>Order Number: {{ $order->id }}</p>
    <p>Order Date: {{ $order->created_at->format('Y-m-d') }}</p>

    <h3>Shipping Information:</h3>
    <p>Shipping Address:<br>
        {{ $order->shippingAddress->address }}<br>
        {{ $order->shippingAddress->state }}, {{ $order->shippingAddress->zip_code }}<br>
        {{ $order->shippingAddress->country }}
    </p>

    <h3>Tracking Information:</h3>
    <p>Tracking Number: {{ $order->tracking_number }}</p>
    <p>Track your shipment: <a class ="btn btn-primary" href="{{ $order->tracking_link ?? '' }}">Click here</a></p>

    <p>Thank you once again for choosing our store. We hope you enjoy your purchase!</p>

    <p>If you have any questions or need further assistance, feel free to contact us at:</p>
    <p>Email: your-email@example.com<br>
        Phone: +123456789
    </p>

    <p>Best regards,<br>
        {{ config('app.name', 'Shoppers') }}
    </p>
</body>

</html>

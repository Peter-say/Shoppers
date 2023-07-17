<?php

namespace App\Http\Controllers\Dashboard\User\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class PayPalController extends Controller
{
    public function checkout()
    {
        $clientId = env('paypal.client_id');
        $clientSecret = env('paypal.secret');

        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment);

        // Create an order request
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => '10.00',
                    ],
                ],
            ],
        ];

        try {
            // Create the order
            $response = $client->execute($request);

            // Redirect the user to the PayPal approval URL
            $approvalUrl = collect($response->result->links)->where('rel', 'approve')->first()->href;
            return redirect($approvalUrl);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function index()
    {
        return view('paypal');
    }

    public function payment(Request $request)
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success'),
                "cancel_url" => route('paypal.payment.cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "112.00"
                    ]
                ]
            ]
        ]);
        
        if (isset($response['id']) && $response['id'] !== null) {

            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }

            return redirect()
                ->route('paypal.index')
                ->with('error', 'Something went wrong!');
        } else {
            return redirect()
                ->route('paypal.index')
                ->with('error', $response['error']['message'] ?? 'Something went wrong!');
        }
    }

    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('paypal.index')
                ->with('success', 'Payment successful!');
        } else {
            return redirect()
                ->route('paypal.index')
                ->with('error', $response['message'] ?? 'Something went wrong!');
        }
    }

    public function paymentCancel()
    {
        return redirect()
            ->route('paypal.index')
            ->with('error', $response['message'] ?? 'You have canceled the Paypal payment process!');
    }
}

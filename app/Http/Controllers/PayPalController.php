<?php

namespace App\Http\Controllers;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;


class PayPalController extends Controller
{
    /**
     * Returns the environment to use when making the payment.
     *
     * @return ProductionEnvironment|SandboxEnvironment
     */
    private static function environment()
    {
        $environment = config('paypal.current_environment');

        $config = config('paypal.environment');

        return $environment != 'sandbox' ?
            new ProductionEnvironment($config['production']['client_id'], $config['production']['client_secret']) :
            new SandboxEnvironment($config['sandbox']['client_id'], $config['sandbox']['client_secret']);

    }

    /**
     * Returns a new client to be used to make the API calls
     * @return PayPalHttpClient
     */
    private static function client(): PayPalHttpClient
    {
        $environment = self::environment();

        return new PayPalHttpClient($environment);
    }

    public static function createOrderRequest(): array
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');

        $request->body = self::buildRequestBody();

        $client = self::client();
        $response = $client->execute($request);

        return [
            'statusCode' => $response->statusCode,
            'results' => $response->result,
            'links' => $response->result->links
        ];
    }

    /**
     * Returns the data wo be used on the cart section
     * @return array
     */
    private static function buildRequestBody(): array
    {

        return [
            'intent' => 'AUTHORIZE',
            'application_context' => [
                'return_url' => 'https://example.com/return',
                'cancel_url' => 'https://example.com/cancel',
                'brand_name' => config('app.name'),
                'locale' => 'en-US',
                'landing_page' => 'BILLING',
                'user_action' => 'PAY_NOW',
            ],
            'purchase_units' => [
                0 => [
                    'reference_id' => 'PUHF',
                    'description' => 'Sporting Goods',
                    'custom_id' => 'CUST-HighFashions',
                    'soft_descriptor' => 'HighFashions',
                    'amount' =>
                        [
                            'currency_code' => 'USD',
                            'value' => '1.00',
                            'breakdown' => [
                                'item_total' => [
                                    'currency_code' => 'USD',
                                    'value' => '1.00',
                                ]
                            ]
                        ],
                    'items' =>
                        [
                            0 =>
                                [
                                    'name' => 'T-Shirt',
                                    'description' => 'Green XL',
                                    'sku' => 'sku01',
                                    'unit_amount' =>
                                        [
                                            'currency_code' => 'USD',
                                            'value' => '1.00',
                                        ],
                                    'quantity' => '1',
                                    'category' => 'PHYSICAL_GOODS'
                                ]
                        ],
                ],
            ],
        ];
    }
}

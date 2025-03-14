<?php

namespace App\Traits;

use App\Http\Requests\Seller\RefundOrder;
use App\Models\Customer;
use Exception as GlobalException;
use Stripe\Account;
use Stripe\AccountLink;
use Stripe\Charge;
use Stripe\Customer as StripeCustomer;
use Stripe\Exception;
use Stripe\Stripe;
use Stripe\PaymentMethod;
use Stripe\PaymentIntent;
use Stripe\Refund;
use Illuminate\Support\Str;

trait StripePayment
{

    public static function prepare()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public static function getStripeValue()
    {
        self::prepare();
    }
    public static function getOrCreateAccountOld($params = [], $config = [])
    {
        
        self::prepare();
        $response['api_status'] = false;
        try {
            $params = array_merge([
                "type" => $config['account_type'] ?? 'standard'
            ], $params);
            $session = Account::create($params);
            $response['api_status'] = true;
            $response['message'] = "Account Created Successfully";
            $response['data'] = array("account_id" => $session->id);
        } catch (\Stripe\Exception\CardException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $response['message'] = "Too many requests made to the API too quickly";
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $response['message'] = "Authentication with Stripe's API failed";
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $response['message'] = "Network communication with Stripe failed";
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $response['message'] = $e->getError()->message;
        } catch (GlobalException $e) {
            $response['message'] = "Something else happened, completely unrelated to Payment";
        }
        return $response;
    }
    public static function createAccountLink($vendorId, $config = [])
    {
        self::prepare();
        $response['api_status'] = false;
        try {
            $account_links = AccountLink::create([
                'account' => $vendorId,
                'refresh_url' => $config['refresh_url'] ?? '',
                'return_url' => $config['return_url'] ?? '',
                'type' => 'account_onboarding',
            ]);
            $response['api_status'] = true;
            $response['message'] = "Account Created Successfully";
            $response['data'] = array("account_link" => $account_links);
            // var_dump($response); exit;
        } catch (\Stripe\Exception\CardException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $response['message'] = "Too many requests made to the API too quickly";
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $response['message'] = "Authentication with Stripe's API failed";
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $response['message'] = "Network communication with Stripe failed";
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $response['message'] = $e->getError()->message;
        } catch (GlobalException $e) {
            $response['message'] = "Something else happened, completely unrelated to Payment";
        }
        return $response;
    }
    public static function checkStripeConnectedAccountStatus($stripeConnectedId)
    {
        self::prepare();
        $response['api_status'] = false;
        try {
            $ch = Account::retrieve($stripeConnectedId, []);
            $response['api_status'] = true;
            $response['message'] = "account status";
            $response['data'] = array("disabled_reason" => ($ch->requirements->disabled_reason ?? null), "stripe_connect" => ($ch->payouts_enabled ?? null));
        } catch (\Stripe\Exception\CardException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $response['message'] = "Too many requests made to the API too quickly";
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $response['message'] = "Authentication with Stripe's API failed";
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $response['message'] = "Network communication with Stripe failed";
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $response['message'] = $e->getError()->message;
        } catch (GlobalException $e) {
            $response['message'] = "Something else happened, completely unrelated to Payment";
        }
        return $response;
    }
    public function createStripeCustomer($data)
    {
        self::prepare();
        $response['api_status'] = false;
        try {
            $existingCustomer = StripeCustomer::all(['email' => $data['email']]);
            if (!empty($existingCustomer->data)) {
                $customer = $existingCustomer->data[0];
                $response['data'] = array("account_id" => ($customer->id ?? null));
            } else {
                $customer = StripeCustomer::create($data);
                $response['data'] = array("account_id" => ($customer->id ?? null));
            }
            $response['api_status'] = true;
            $response['message'] = "Account Created Successfully";
        } catch (\Stripe\Exception\CardException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $response['message'] = "Too many requests made to the API too quickly";
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $response['message'] = "Authentication with Stripe's API failed";
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $response['message'] = "Network communication with Stripe failed";
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $response['message'] = $e->getError()->message;
        } catch (GlobalException $e) {
            $response['message'] = "Something else happened, completely unrelated to Payment";
        }
        return $response;
    }

    public function addCustomerStripeCard($parameters)
    {
        self::prepare();
        $response['api_status'] = false;
        try {
            $session = PaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'number' => ($parameters['number'] ?? ''),
                    'exp_month' => ($parameters['expMonth'] ?? ''),
                    'exp_year' => ($parameters['expYear'] ?? ''),
                    'cvc' => ($parameters['cardCvc'] ?? ''),
                ]
            ]);
            $response['api_status'] = true;
            $response['message'] = "Card added successfully";
            $response['data'] = array("paymentId" => ($session->id ?? null));
        } catch (\Stripe\Exception\CardException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $response['message'] = "Too many requests made to the API too quickly";
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $response['message'] = "Authentication with Stripe's API failed";
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $response['message'] = "Network communication with Stripe failed";
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $response['message'] = $e->getError()->message;
        } catch (GlobalException $e) {
            $response['message'] = "Something else happened, completely unrelated to Payment";
        }
        return $response;
    }

    public function attachCustomerStripeCard($parameters)
    {
        self::prepare();
        $response['api_status'] = false;
        try {
            $pm = PaymentMethod::retrieve(
                ($parameters['paymentId'] ?? ''),
                ['customer' => ($parameters['customerId'] ?? '')]
            );
            $session = $pm->attach(['customer' => ($parameters['customerId'] ?? '')]);
            $response['api_status'] = true;
            $response['message'] = "Card added successfully";
            $response['data'] = $session;
        } catch (\Stripe\Exception\CardException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $response['message'] = "Too many requests made to the API too quickly";
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $response['message'] = "Authentication with Stripe's API failed";
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $response['message'] = "Network communication with Stripe failed";
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $response['message'] = $e->getError()->message;
        } catch (GlobalException $e) {
            $response['message'] = "Something else happened, completely unrelated to Payment";
        }
        return $response;
    }

    public function detachCustomerStripeCard($parameters)
    {
        self::prepare();
        $response['api_status'] = false;
        try {
            $pm = PaymentMethod::retrieve(
                ($parameters['paymentId'] ?? ''),
                ['customer' => ($parameters['customerId'] ?? '')]
            );
            $session = $pm->detach();
            $response['api_status'] = true;
            $response['message'] = "Card removed successfully";
            $response['data'] = $session;
        } catch (\Stripe\Exception\CardException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $response['message'] = "Too many requests made to the API too quickly";
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $response['message'] = "Authentication with Stripe's API failed";
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $response['message'] = "Network communication with Stripe failed";
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $response['message'] = $e->getError()->message;
        } catch (GlobalException $e) {
            $response['message'] = "Something else happened, completely unrelated to Payment";
        }
        return $response;
    }

    public function getCustomerAllStripeCards($parameters)
    {
        self::prepare();
        $response['api_status'] = false;
        try {
            $session = PaymentMethod::all(['customer' => ($parameters['customerId'] ?? ''), 'type' => 'card']);
            $response['api_status'] = true;
            $response['message'] = "Customer card list";
            $response['data'] = $session;
        } catch (\Stripe\Exception\CardException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $response['message'] = "Too many requests made to the API too quickly";
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $response['message'] = "Authentication with Stripe's API failed";
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $response['message'] = "Network communication with Stripe failed";
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $response['message'] = $e->getError()->message;
        } catch (GlobalException $e) {
            $response['message'] = "Something else happened, completely unrelated to Payment";
        }
        return $response;
    }

    public function chargeTheStripePayment($parameters)
    {
        self::prepare();
        $response['api_status'] = false;
        try {
            $session = Charge::create(['source' => ($parameters['token'] ?? ''), 'amount' => round($parameters['amount'] ?? ''), "currency" => ($parameters['currency'] ?? 'USD'), "description" => ($parameters['description'] ?? 'item name'), "application_fee_amount" => round($parameters['applicationFee'] ?? 0)], ['stripe_account' => ($parameters['stripeAccount'] ?? 0)], ['idempotency_key' => Str::random(32)]);
            $response['api_status'] = true;
            $response['message'] = "Payment charged successfully";
            $response['data'] = $session;
        } catch (\Stripe\Exception\CardException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $response['message'] = "Too many requests made to the API too quickly";
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $response['message'] = "Authentication with Stripe's API failed";
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $response['message'] = "Network communication with Stripe failed";
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $response['message'] = $e->getError()->message;
        } catch (GlobalException $e) {
            $response['message'] = "Something else happened, completely unrelated to Payment";
        }
        return $response;
    }

    public function chargeTheStripePaymentThroughPaymentId($parameters)
    {
        self::prepare();
        $response['api_status'] = false;
        try {
            if(!isset($parameters['payment_method']) || empty($parameters['payment_method'])) {
                $customer = StripeCustomer::retrieve($parameters['customer']);
                $defaultPaymentMethod = $customer->default_payment_method;
            } else {
                $defaultPaymentMethod = $parameters['payment_method'];
            }
            $session = PaymentIntent::create(['customer' => ($parameters['customer'] ?? ''), 'payment_method' => $defaultPaymentMethod, 'amount' => round($parameters['amount'] ?? ''), "currency" => ($parameters['currency'] ?? 'USD')]);
            $response['api_status'] = true;
            $response['message'] = "Payment charged successfully";
            $response['data'] = $session;
        } catch (\Stripe\Exception\CardException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $response['message'] = "Too many requests made to the API too quickly";
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $response['message'] = "Authentication with Stripe's API failed";
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $response['message'] = "Network communication with Stripe failed";
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $response['message'] = $e->getError()->message;
        } catch (GlobalException $e) {
            $response['message'] = "Something else happened, completely unrelated to Payment";
        }
        return $response;
    }
    public function refundThePayment($parameters)
    {
        self::prepare();
        $response['api_status'] = false;
        try {
            if (isset($parameters['account']) && !empty($parameters['account'])) {
                $session = Refund::create(['charge' => ($parameters['charge'] ?? ''), 'amount' => round($parameters['amount'] ?? '')], ['stripe_account' => $parameters['account']]);
            } else {
                $session = Refund::create(['charge' => ($parameters['charge'] ?? ''), 'amount' => round($parameters['amount'] ?? '')]);
            }
            $response['api_status'] = true;
            $response['message'] = "Refund successfully completed";
            $response['data'] = $session;
        } catch (\Stripe\Exception\CardException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $response['message'] = "Too many requests made to the API too quickly";
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $response['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $response['message'] = "Authentication with Stripe's API failed";
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $response['message'] = "Network communication with Stripe failed";
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $response['message'] = $e->getError()->message;
        } catch (GlobalException $e) {
            $response['message'] = "Something else happened, completely unrelated to Payment";
        }
        return $response;
    }
    private static function create($user, $id_key, $callback)
    {
        $vendor = $user->stripeAccount;
        if (!$vendor || !$vendor->$id_key) {
            $id = call_user_func($callback)->id;
            if (!$vendor) {
                $vendor = $user->stripeAccount()->create([$id_key => $id]);
            } else {
                $vendor->$id_key = $id;
                $vendor->save();
            }
        }
        return $vendor;
    }
}
<?php

/**
 * http://www.larryullman.com/2013/01/30/handling-stripe-errors/
 *
 * @param $stripeToken
 * @param $stripeEmail
 * @param $payment_info
 * @param $shipping_address
 * @return array
 */
function stripeCreateCharge($stripeToken, $stripeEmail, $payment_info, $shipping_address)
{
    // Set your secret key: remember to change this to your live secret key in production
    // See your keys here: https://dashboard.stripe.com/account/apikeys
    \Stripe\Stripe::setApiKey("sk_test_OCleLNiXsK3X0kHysHdDTauv");
    $charge = false;
    try {
        // Charge the user's card:
        $charge = \Stripe\Charge::create(array(
            "amount" => $payment_info['total'] * 100, // Amount in cents!
            "currency" => "eur",
            "description" => $stripeEmail,
            "metadata" => array(
                "stripeEmail" => $stripeEmail,
                "recipient_name" => $shipping_address['recipient_name'],
                "email" => $shipping_address['email'],
                "line1" => $shipping_address['line1'],
                "line2" => $shipping_address['line2'],
                "city" => $shipping_address['city'],
                "country_code" => $shipping_address['country_code'],
                "postal_code" => $shipping_address['postal_code'],
                "phone" => $shipping_address['phone'],
            ),
            "source" => $stripeToken,
        ));
    } catch (\Stripe\Error\Card $e) {
        // Card was declined. Only customer can fix those errors
        $e_json = $e->getJsonBody();
        $error = $e_json['error'];

        //Stripe does promise that the value ($error[‘message’] in the above) will be informative and presentable to the customer
        return array('result' => false, "message" => $error['message']);
    } catch (\Stripe\Error\Base  $e) {
        $e_json = $e->getJsonBody();
        $error = $e_json['error'];
        $message = $error['message'];
        error_log($message, 0);

        return array('result' => false, "message" => $message);
    }


    if ($charge->paid == true) {
        return array('result' => true, "message" => "Charge completed", 'stripeChargeResponse' => $charge);
    }

    return array('result' => false, "message" => "General error unknown.");
}


?>
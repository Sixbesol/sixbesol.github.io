<?php
session_start();
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
require __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../includes/error_reporting.php';
include __DIR__ . '/bootstrap.php';

enableErrorReporting();


if (!isset($_POST['items'])) {
    die('items not set');
}


$firstName = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
$lastName = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
$address1 = filter_var($_POST['address1'], FILTER_SANITIZE_STRING);
$address2 = filter_var($_POST['address2'], FILTER_SANITIZE_STRING);
$zip = filter_var($_POST['zip'], FILTER_SANITIZE_STRING);
$city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
$state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
$addressCountry = filter_var($_POST['addressCountry'], FILTER_SANITIZE_STRING);
$items = json_decode($_POST['items'], true)['items'];

$subtotal = filter_var($_POST['subtotal'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$shipping = filter_var($_POST['shipping'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$total = filter_var($_POST['total'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

//Set the session
$_SESSION['orderData'] = array();
$_SESSION['orderData']['firstName'] = $firstName;
$_SESSION['orderData']['lastName'] = $lastName;
$_SESSION['orderData']['email'] = $email;
$_SESSION['orderData']['address1'] = $address1;
$_SESSION['orderData']['address2'] = $address2;
$_SESSION['orderData']['zip'] = $zip;
$_SESSION['orderData']['city'] = $city;
$_SESSION['orderData']['state'] = $state;
$_SESSION['orderData']['phone'] = $phone;
$_SESSION['orderData']['addressCountry'] = $addressCountry;
$_SESSION['orderData']['items'] = $items;
$_SESSION['orderData']['subtotal'] = $subtotal;
$_SESSION['orderData']['shipping'] = $shipping;
$_SESSION['orderData']['total'] = $total;

// 2. Provide your Secret Key. Replace the given one with your app clientId, and Secret
// https://developer.paypal.com/webapps/developer/applications/myapps
$apiContext = new PayPal\Rest\ApiContext(
    new PayPal\Auth\OAuthTokenCredential(
        'AQbNv53DOkgSegy4jBrGYfpu2T56YXfjkB08ZP-K8cVQS_MBAUbCQ1gqnucX-I68gU3FpJ90rh-XaMVO',     // ClientID
        'EFByOnCZTVCM_Zl2pWl5aLde8BVeAvI4dXv2av4wU8Yw6h2gFDWQc91gK5R34sXN1nmGUcXzzlhHGPdD'      // ClientSecret
    )
);

// Step 2.1 : Between Step 2 and Step 3
/*$apiContext->setConfig(
    array(
        'log.LogEnabled' => true,
        'log.FileName' => 'PayPal.log',
        'log.LogLevel' => 'DEBUG'
    )
);*/

// 3. Lets try to create a Payment
// https://developer.paypal.com/docs/api/payments/#payment_create
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');


$itemsPP = [];

foreach ($items as $key => $it) {
    $itP = new \PayPal\Api\Item();
    $itP->setQuantity($it['quantity'])
        ->setName($it['name'])
        ->setPrice($it['price'])
        ->setCurrency($it['currency']);

    $itemsPP[] = $itP;
}


$itemList = new \PayPal\Api\ItemList();

$shipping_address = new \PayPal\Api\ShippingAddress();

$shipping_address->setCity($city);
$shipping_address->setCountryCode($addressCountry);
$shipping_address->setPostalCode($zip);
$shipping_address->setLine1($address1);
$shipping_address->setLine2($address2);
$shipping_address->setState($state);
$shipping_address->setRecipientName($firstName . ' ' . $lastName);

$itemList->setShippingAddress($shipping_address);
$itemList->setItems($itemsPP);

$amount = new \PayPal\Api\Amount();
$details = new \PayPal\Api\Details();
$details
    ->setSubtotal($subtotal)
    ->setTax(0)
    ->setShipping($shipping);
$amount->setCurrency('EUR')->setDetails($details)->setTotal($total);

$transaction = new \PayPal\Api\Transaction();
$transaction->setItemList($itemList);
$transaction->setAmount($amount);


$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("$baseUrl/pp/after_pp_process.php")
    ->setCancelUrl("https://example.com/your_cancel_url.html");
$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);
// 4. Make a Create Call and print the values
try {
    $payment->create($apiContext);

    $approval_url = $payment->getApprovalLink();
} catch (\PayPal\Exception\PayPalConnectionException $ex) {
    unset($_SESSION['orderData']);
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
    die();
}


?>

<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Let's Checkout</title>
    <link rel="stylesheet" href="./wall_files/ionicons.min.css">
    <link rel="stylesheet" href="./wall_files/bootstrap.min.css">
    <link rel="stylesheet" href="./wall_files/purple.css">
    <link rel="stylesheet" href="./wall_files/style.css">
    <link rel="stylesheet" href="./wall_files/custom.css">
    <link rel="stylesheet" href="./wall_files/demo.css">
</head>

<body>
<div class="helpme">
    <div class="helpme-content">
        <div class="helpme-icon"><i class="ion ion-help-buoy"></i></div>
        <h2 class="helpme-title">Support</h2>
        <div class="helpme-content-scrollable">
            <div class="helpme-cards">
                <div class="helpme-card">
                    <h4>How to order?</h4>
                    <div class="helpme-card-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="helpme-card">
                    <h4>How to confirm payment?</h4>
                    <div class="helpme-card-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="helpme-card">
                    <h4>How to cancel my order?</h4>
                    <div class="helpme-card-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="helpme-footer">
            <input type="text" placeholder="Search support">
            <div class="helpme-other">
                <div class="helpme-other-item" data-toggle="tooltip" title="" data-placement="left"
                     data-original-title="Chat with real person">
                    <i class="ion ion-chatbubble"></i>
                </div>
                <div class="helpme-other-item" data-toggle="tooltip" title="" data-placement="left"
                     data-original-title="Contact us">
                    <i class="ion ion-ios-telephone"></i>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="wrapper">
    <header class="primary" style="transform: translate3d(0px, 0px, 0px); position: fixed; top: 0px;">
        <div class="navbar navbar-primary">
            <div class="container">
                <div class="navbar-header">
                    <a href="http://projects.multinity.com/letscheckout/2/#" class="navbar-brand">
                        Let's Checkout
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!--   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                       <ul class="nav navbar-nav navbar-right">
                           <li><a href="http://projects.multinity.com/letscheckout/2/#">Store</a></li>
                           <li class="active"><a
                                   href="http://projects.multinity.com/letscheckout/2/index.html">Checkout</a></li>

                       </ul>
                   </div>-->
            </div> <!-- /.container -->
        </div>

    </header> <!-- /.primary -->

    <section class="section">
        <div class="container">
            <div class="section-inner">
                <div class="section-body" style="overflow: hidden;">

                    <h2 class="section-title padding-top">Select a Payment Method (Powered by PaypalPlus)</h2>
                    <div class="line"></div>
                    <div id="ppplus"></div>


                    <div class="col-md-6 col-sm-6">
                        <h2 class="section-title padding-top">Your Order</h2>
                        <div class="line sm"></div>
                        <div class="total-info" data-calculate-me="">
                            <div class="total-item">
                                <div class="total-name">Subtotal</div>
                                <div class="total-value" id="total-order"><?php echo $subtotal; ?>€</div>
                            </div> <!-- /.total-item -->
                            <div class="total-item">
                                <div class="total-name">Shipping</div>
                                <div class="total-value" id="total-shipping"
                                "><?php echo $shipping; ?>€
                            </div>
                            <div class="total-item" style="display: none;">
                                <div class="total-name">Tax</div>
                                <div class="total-value" id="total-tax"
                                ">0€
                            </div>
                        </div> <!-- /.total-item -->


                    </div> <!-- /.total-item -->
                    <div class="total-item total">
                        <div class="total-name">Total</div>
                        <div class="total-value" id="total-all"><?php echo $total; ?>€
                        </div>
                    </div> <!-- /.total-item -->
                </div> <!-- /.total-info -->
            </div>

            <div class="col-md-6 col-sm-6">
                <h2 class="section-title padding-top">Your Items</h2>
                <div class="line"></div>
                <div class="items">
                    <!-- <p class="section-p">You can remove and add quantity to each item in the cart</p>-->

                    <?php foreach ($items as $key => $it) { ?>
                        <div class="item">
                            <div class="item-inner">
                                <div class="item-details">
                                    <div class="item-title"><a
                                                href="javascript:void">
                                            <?php echo $it['name']; ?></a></div>
                                    <div class="item-description"></div>

                                </div> <!-- /.item-details -->
                                <div class="item-price">
                                    <div class="value" id="item-1-price">  <?php echo $it['price']; ?>€</div>
                                    <div class="quantity" data-quantity-control="" data-min="1"
                                         data-target="#item-1-price">
                                        <!--                                    <div class="control min"><i class="ion-ios-arrow-back"></i></div>-->
                                        <div class="control count"><span> (<?php echo $it['quantity']; ?></span>x)
                                        </div>
                                        <!--                                    <div class="control plus"><i class="ion-ios-arrow-forward"></i></div>-->
                                    </div>
                                </div> <!-- /.item-price -->

                            </div> <!-- /.item-inner -->
                        </div> <!-- /.item -->

                    <?php } ?>

                </div> <!-- /.items -->


            </div>


        </div> <!-- /.section-body -->


</div> <!-- /.section-inner -->
</div> <!-- /.container -->
</section> <!-- /.section -->

<footer class="primary">
    <div class="container">
        <div class="copyright">
            Copyright Your Store 2018.
            <div class="payment-methods">
                <img src="./wall_files/mastercard.png">
                <img src="./wall_files/visa.png">
                <img src="./wall_files/paypal.png">
                <img src="./wall_files/americanexpress.png">
            </div>
        </div> <!-- /.copyright -->
    </div> <!-- /.container -->
</footer> <!-- /.footer-primary -->
</div> <!-- /.wrapper -->

<script src="./wall_files/jquery-3.1.1.min.js.download"></script>
<script src="./wall_files/bootstrap.min.js.download"></script>
<script src="./wall_files/icheck.min.js.download"></script>
<script src="./wall_files/nicescroll.js.download"></script>
<script src="./wall_files/scroll-up-bar.min.js.download"></script>
<script src="./wall_files/number_format.js.download"></script>
<script src="./wall_files/config.js.download"></script>
<script src="./wall_files/letscheckout.js.download"></script>


<?php
$countryCodeIpLocation = null;

$ip = $_SERVER['REMOTE_ADDR']; // the IP address to query

$query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));

if ($query && $query['status'] == 'success') {
    $countryCodeIpLocation = $query['countryCode'];
} elseif ($query['status'] == 'fail') {
    if ($query['message'] == 'private range') {
        echo "<p> This is a private range IP setting countryCode as DE";
        $countryCodeIpLocation = "DE"; //Test location
    } else {
        die('Unable to get location');

    }
} else {
    die(" Failed to get location, error.");
}


?>

<script src="https://www.paypalobjects.com/webstatic/ppplus/ppplus.min.js"
        type="text/javascript"></script>
<script type="application/javascript">
    var ppp = PAYPAL.apps.PPP({
        "approvalUrl": "<?php echo $approval_url;?>",
        "placeholder": "ppplus",
        "mode": "sandbox",
        "country": "<?php echo $countryCodeIpLocation;?>"
    });
</script>

</body>
</html>
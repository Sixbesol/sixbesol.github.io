<?php
// Start the session
session_start();

require __DIR__ . '/../vendor/autoload.php';

include __DIR__ . '/../includes/error_reporting.php';
include __DIR__ . '/../includes/template_helpers.php';
include __DIR__ . '/bootstrap.php';
include __DIR__ . '/../includes/email_order_confirmation_admin.php';
include __DIR__ . '/../includes/email_order_confirmation_customer.php';

enableErrorReporting();


if (!isset($_SESSION['orderData'])) {
    die("orderData in session is not set");
}

$orderData = $_SESSION['orderData'];


$items = $orderData['items'];
$shipping_address = [
    'firstName' => $orderData['firstName'],
    'lastName' => $orderData['lastName'],
    'recipient_name' => $orderData['firstName'] . ' ' . $orderData['lastName'],
    'email' => $orderData['email'],
    'address1' => $orderData['address1'],
    'address2' => $orderData['address2'],
    'zip' => $orderData['zip'],
    'city' => $orderData['city'],
    'state' => $orderData['state'],
    'addressCountry' => $orderData['addressCountry'],
    'phone' => $orderData['phone'],
];
$payment_info = [
    'subtotal' => $orderData['subtotal'],
    'shipping' => $orderData['shipping'],
    'total' => $orderData['total']
];

//Record Order

$servername = "88.99.190.142";
$username = "fastlane";
$password = "123456";
$dbname = "fastlane";

try {
    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $itemsJson = json_encode($items);
    $shipping_addressJson = json_encode($shipping_address);
    $payment_infoJson = json_encode($payment_info);

    $statement = $conn->prepare("INSERT INTO $dbname.order(hash, items, shipping_address, payment_info)  VALUES(:x, :y, :z,:e)");

    $hash = uniqid();
    $statement->execute(array(
        "x" => $hash,
        "y" => $itemsJson,
        "z" => $shipping_addressJson,
        "e" => $payment_infoJson
    ));

    $statementLastInsert = $conn->prepare("SELECT * FROM $dbname.order ORDER BY ID DESC LIMIT 1");
    $statementLastInsert->execute();
    $lastInsertRecord = $statementLastInsert->fetch();


    //Send to customer
    $response = sendEmail($items, $shipping_address, $payment_info, $lastInsertRecord->created_at, $hash);
    $responseAdmin = sendEmailToAdmin($hash);


    //After db record delete the session orderData as its no needed anymore
    unset($_SESSION['orderData']);

    header("Location: $baseUrl/order_thankyou.php?hash=" . $hash);

} catch (PDOException $err) {
    $msg = "ERROR: Unable to connect: " . $err->getMessage();
    print_r($msg);
    exit;
}
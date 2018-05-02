<?php

/**
 *
 *  Record the order in the database
 *
 * @param $items
 * @param $shipping_address
 * @param $payment_info
 * @return array
 */
function recordOrderDb($items, $shipping_address, $payment_info)
{
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

        return ['result' => true, 'message' => '', 'hash' => $hash, 'lastInsertRecord' => $lastInsertRecord];

    } catch (PDOException $err) {
        $msg = "ERROR: Unable to connect: " . $err->getMessage();
        return ['result' => false, 'message' => $msg];
    }

}
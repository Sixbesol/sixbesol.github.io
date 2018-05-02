<?php



/**
 *
 * Send email to customer
 * @param $items
 * @param $shipping_address
 * @param $payment_info
 * @param $hash
 * @return array
 */
function sendEmail($items, $shipping_address, $payment_info,$created_at, $hash)
{
    try {
        //https://stackoverflow.com/a/20126255/2335048
        $mail = new PHPMailer(true);

        //  $mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'email.for.dev.h@gmail.com';                 // SMTP username
        $mail->Password = '12345678a_';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('email.for.dev.h@gmail.com', 'Fastlane Dev');
        $mail->addAddress($shipping_address['email'], $shipping_address['recipient_name']);     // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Order #'.$hash;

        $mail->Body = render(__DIR__ . '/../mails/_order_confirmations_email.php', ['items'=>$items,'shipping_address'=> $shipping_address,
                                                                                      'payment_info'=>$payment_info,'created_at'=> $created_at,'hash' => $hash]);
        $mail->AltBody = null;
        $mail->send();

        //Debug
        //  echo 'Message could not be sent.';
        //echo 'Mailer Error: ' . $mail->ErrorInfo;

    } catch (phpmailerException $e) {
        return ['result' => false, 'message' => $e->errorMessage()];
    } catch (Exception $e) {
        return ['result' => false, 'message' => $e->getMessage()]; //Error messages from anything else!
    }

    return ['result' => true, 'message' => ''];
}
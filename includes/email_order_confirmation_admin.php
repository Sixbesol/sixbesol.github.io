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
function sendEmailToAdmin($hash)
{
    global $baseUrl;

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
        $mail->addAddress("email.for.dev.h@gmail.com");     // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'You have a new order. hash: ' . $hash;

        $mail->Body = sprintf("
                     <h1>
                        You have a new order.
                      </h1>
                      <p>
                        <a href='%s/order_thankyou.php?hash=%s&adminViewing' target='_blank'>View Order</a>
                      </p>
                        ", $baseUrl, $hash);
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
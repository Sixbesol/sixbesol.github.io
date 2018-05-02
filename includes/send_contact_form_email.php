<?php

function sendContactFormEmail($to, $name, $message)
{
    try {
        //https://stackoverflow.com/a/20126255/2335048
        $mail = new PHPMailer(true);

        //  $mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp-mail.outlook.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ministore.template@outlook.com';                 // SMTP username
        $mail->Password = 'template.123456';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('ministore.template@outlook.com', 'Ministore Template');
        $mail->addAddress("ministore.template@outlook.com");     // Add a recipient
        $mail->addReplyTo($to, $name);     // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Contact Form. ' . $name . " (" . $to . ")";

        $mail->Body = $message;
        $mail->AltBody = null;
        $mail->send();

        $_SESSION["sent_already"] = true;
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
?>
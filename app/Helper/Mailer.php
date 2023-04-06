<?php
namespace Teckindo\DokumenKontrol\Helper;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer {

    public static function sendEmail ($pengirim, $penerima, $subject, $type, $body, $lampiran)
    {
    
        $mail = new PHPMailer(true);    

        try {
            //Server email settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'fios.development@gmail.com';
            $mail->Password   = 'vwumbpqjcefvxhgw';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Penrima email
            $mail->setFrom('dokumenkontrol@gmail.com', $pengirim);

            //mengirim ke beberapa alamat email
            foreach ($penerima as $m) {
                $mail->addAddress($m['email'], $m['user']);
            }

            //Additional configuration
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
                // Isi email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            if ( $type == 'Share Document' ) {

                $pdfPath = __DIR__ . '/../../public/file/pdf/' . $lampiran;
                $mail->addAttachment($pdfPath);
                
                $mail->Body    = '
                <html>
                  <body style="margin: 0; padding: 0; box-sizing: border-box;">'
                    . $body .
                  '</body>
                </html>';
            }

            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if (!$mail->send()) {
                // echo 'Sorry, something went wrong. Please try again later.';
            } else {
                // echo 'Message sent! Thanks for contacting us.';
            }
        } catch (Exception $e) {
            // echo "Email tidak terkirim !! Email error : {$mail->ErrorInfo}";
        }

    }


}




?>
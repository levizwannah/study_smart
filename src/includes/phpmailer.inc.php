<?php
require_once(__DIR__."/passwords.inc.php");
use PHPMailer\PHPMailer\PHPMailer;

date_default_timezone_set('Etc/UTC');
        $mail = new PHPMailer;
        $mail->isSMTP();

        $mail->SMTPDebug = 0;

        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        $mail->Mailer='smtp';
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = EMAIL;

        //Password to use for SMTP authentication
        $mail->Password = E_PASSWORD;

        //Set who the message is to be sent from
        $mail->setFrom(EMAIL, EMAIL_TAGLINE);



       
        function save_mail($mail) {
            //You can change 'Sent Mail' to any other folder or tag
            $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

            //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
            $imapStream = imap_open($path, $mail->Username, $mail->Password);

            $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
            imap_close($imapStream);

            return $result;
        }

        /**
         * @param string $recName - full name of the receiver
         * @param string $email - email of the receiver
         * @param string $sub - subject of the email
         * @param string $msg - HTML message to send
         * @param bool|string $attachement - link to attachment or false if none
         * @param bool|string $replyTo - set reply to email or false if none
         * @return bool
         */
        function sendEmail($recName, $recEmail, $sub, $msg, $attachment = false, $replyTo = false){
          
            $mail = $GLOBALS['mail'];
            $mail->addAddress($recEmail, $recName);
            $mail->Subject = $sub;
            if($replyTo !== false && !preg_match('/^\s*$/', $replyTo)){
                $mail->addReplyTo($replyTo);
            }
            $mail->msgHTML($msg);

            $mail->AltBody = $mail->html2text($msg);
            if($attachment !== false && !preg_match('/^\s*$/', $attachment)){
                $mail->addAttachment($attachment);
            }
            
            if($mail->send()){
                return true;
            }else{
                return false;
            }
        }


?>
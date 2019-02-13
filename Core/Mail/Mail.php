<?php

namespace Core\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    private $mail;
    private $to;
    private $subject;
    private $message;

    public  function __construct($to, $subject,$message,$token = '') {
        $this->mail = new PHPMailer(true);
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $this->generateHtmlForMessage($message);
        $this->token = $token;
        $this->_send();
    }

    public function _send() {
        try {
            $this->mail->isSMTP();

            $this->mail->Host = 'smtp.mailtrap.io';
            $this->mail->SMTPAuth = true;
            $this->mail->Username = '71fd9a6bd77a53';
            $this->mail->Password = 'e756f6c4ce6fd4';
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Port = '2525';

            $this->mail->setFrom('600469d286-2dcedc@inbox.mailtrap.io', 'Mailer');
            $this->mail->addAddress("$this->to", 'User');

//            $this->mail->isHTML(true);
            $this->mail->Subject = "$this->subject";
            $this->mail->Body = "<p>Please verify your account <a href='http://mvc.loc/verify?token=".$this->token."'>Here</a></p>
                                 <p>Or copy link <a href='http://mvc.loc/verify?token=".$this->token."'>'http://mvc.loc/verify?token='" . $this->token . "'</a></p>";
            $this->mail->AltBody = 'This is a Alt Body';

            $this->mail->send();

            echo 'Message hes been sent';

        }catch(Exception $e) {
            echo 'Message could not  be  sent. Mailer error ' . $this->mail->ErrorInfo;
        }
    }

    private function generateHtmlForMessage($message) {
        $path = views_path($message);

        return file_get_contents($path);
    }
}
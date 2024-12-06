<?php
namespace App\Core;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require  BASE_PATH.'/vendor/autoload.php';

class SendMail {

    protected $subject ;
    protected $body ;
    public function send($email, $subject,$body) {
        $mail = new PHPMailer(true);
        $this->subject = $subject;
        $this->body = $body;

        try {
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp-relay.brevo.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = '757b21001@smtp-brevo.com';             
            $mail->Password   = 'CcUrmzsL42gEN7VT';                         
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            $mail->Port       = 587;                                    

            //Recipients
            $mail->setFrom('sbasant12345@gmail.com', 'Basant');
            $mail->addAddress($email);                                  

            $mail->isHTML(true);                                        
            $mail->Subject = $this->subject;
            $mail->Body    = $this->body;

            $mail->send();
            return 1;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
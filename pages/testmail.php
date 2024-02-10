<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';


require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

    if(isset($_POST['sub'])){
        $email = $_POST['email'];
        $active = rand(1000, 9999);
        $mail=new PHPMailer(true);
        $mail->IsSMTP();
            
        //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'aghp81@gmail.com';                     //SMTP username
    $mail->Password   = 'ivlqoescwfgfnibi';                               //SMTP password
    $mail->SMTPSecure="tls";
    $mail->Port=587;           //Enable implicit TLS encryption
                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->SetFrom("laraveldevphp@gmail.com");
    $mail->addAddress($email);     //Add a recipient
    $mail->addAddress($email);               //Name is optional
    $mail->addReplyTo('laraveldevphp@gmail.com', 'Information');
    $mail->addCC('laraveldevphp@gmail.com');
    $mail->addBCC('laraveldevphp@gmail.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->CharSet="UTF-8";
    $mail->ContentType="text/htm";
    $mail->Subject = 'کد فعالسازی';
    $mail->MsgHTML("<h2>فعالسازی</h2>");
    $mail->Body    = $active;
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'پیام ارسال شد';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

        // try
        // {
        //     $mail = new PHPMailer(true); //Argument true in constructor enables exceptions

        //     $mail->Host= "smtp.gmail.com";
        //     $mail->SMTPAuth=TRUE;
        //     $mail->SMTPSecure="tls";
        //     $mail->Port=587;
        //     $mail->Username="aghp81@gmail.com";
        //     $mail->Password="ivlqoescwfgfnibi";
        //     $mail->AddAddress($email);
        //     $mail->SetFrom("laraveldevphp@gmail.com");
        //     $mail->Subject= "فعالسازی حساب کاربری";
        //     $mail->CharSet="UTF-8";
        //     $mail->ContentType="text/htm";
        //     $mail->MsgHTML("<p>success</p>");
        //     $mail->Send();
        // }
        // catch(phpmailerException $e)
        // {
        //     echo $e->errorMessage();
        // }
    }
?>

<form method="post">
    <input type="email" name="email">
    <input type="submit" name="sub">
</form>
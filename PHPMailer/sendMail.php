<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('PHPMailer.php');
require_once('SMTP.php');
require_once('Exception.php');
require_once('OAuth.php');
require_once('POP3.php');


$to   = 'victorukwuezeh@yahoo.com';
$from = '';
$email = 'test@live.com';
$name = 'Victor ukwuezeh';
$subject = "The Lorem World ";
$body = "<h1 style='text-align:center;'>Dear Victor</h1>
<img src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80' alt='image text' height='300px' width='500px'>
<h6 style='font-family:arial; color:red; font-size:30px;'>
Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis libero obcaecati debitis atque voluptas alias voluptate impedit reiciendis ullam similique suscipit explicabo, veritatis fuga quisquam nostrum saepe, hic, quae temporibus!
</h6>";


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; //tls
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465; //587  
$mail->Username = 'victorukwuezeh@gmail.com';
$mail->Password = 'godspower007';

//   $path = 'reseller.pdf';
//   $mail->AddAttachment($path);

$mail->IsHTML(true);
$mail->setFrom($email,$name);
$mail->Subject = $subject;
$mail->AddAddress($to);
$mail->Body = $body;


if (!$mail->Send()) {
    echo "Please try Later, Error Occured while Processing";
    // exit(json_encode(array("response" => $response)));

    echo  $mail->ErrorInfo;
} else {echo  "Thanks You !! Your email is sent.";
}

?>
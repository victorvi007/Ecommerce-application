<?php 
require('../config/db.php');
session_start();
$ref = $_GET['reference'];


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('../PHPMailer/PHPMailer.php');
require_once('../PHPMailer/SMTP.php');
require_once('../PHPMailer/Exception.php');
require_once('../PHPMailer/OAuth.php');
require_once('../PHPMailer/POP3.php');

if (!isset($ref)) {
    header('Location:' . ROOT_URL . 'error');
}else{


    $store_id = $_SESSION['payment_details']['store_id'];

    $query = "UPDATE sellers_login_details SET payment = 1 WHERE store_id='$store_id'";
    if (mysqli_query($conn, $query)) {

        $to   = $_SESSION['payment_details']['business_email'];
        $email = 'thestore@gmail.com';
        $name = 'TheStore';
        $subject = "Subscription Payment Successful";
        $body = "
<p><strong>Dear " . $_SESSION['payment_details']['business_name'] . " </strong></p>
<p>Welcome to <strong>THESTORE</strong> family,</p>
<p>Thank you for choosing<strong> THESTORE</strong> Payment complete registration complete. <a href='" . ROOT_URL . "sellershub/'>login</a> to start selling products</p>
        <p style='text-align:left;'>THESTORE</p>
        ";
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
        $mail->setFrom($email, $name);
        $mail->Subject = $subject;
        $mail->AddAddress($to);
        $mail->Body = $body;


        if (!$mail->Send()) {
            echo "Please try Later, Error Occured while Processing";
            // echo  $mail->ErrorInfo;
        } else {
            unset($_SESSION['payment_details']);
            header('refresh:3;url=' . ROOT_URL . 'sellershub/');
        }
    } else {
        die(mysqli_error($conn));
    }
}
// print_r($_SESSION['payment_details']);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../css/all.min.css" rel="stylesheet">
    <title>Pay</title>
</head>
<body>
            <h4 class="text-success">Purchase Successful</h4>
    
</body>
</html>
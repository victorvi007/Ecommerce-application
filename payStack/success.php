<?php 
require('../config/db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!isset($_GET['reference'])) {
    header('Location:'.ROOT_URL);
}
$refCode = $_GET['reference'];
$_SESSION['user'];
$_SESSION['cart'];
$unsetCount = count($_SESSION['cart']);
// print_r($_SESSION['shipping_details']);

$firstname =  $_SESSION['shipping_details'][0] ;
$lastname = $_SESSION['shipping_details'][1] ;
$email_email=$_SESSION['shipping_details'][2] ;
$state = $_SESSION['shipping_details'][3] ;
$phone =  $_SESSION['shipping_details'][4] ;
$address =  $_SESSION['shipping_details'][5] ;
$city =  $_SESSION['shipping_details'][6] ;
$busstop = $_SESSION['shipping_details'][7] ;
$anyotherinfo =  $_SESSION['shipping_details'][8] ;

$amount = $_SESSION['checkout'];


require_once('../PHPMailer/PHPMailer.php');
require_once('../PHPMailer/SMTP.php');
require_once('../PHPMailer/Exception.php');
require_once('../PHPMailer/OAuth.php');
require_once('../PHPMailer/POP3.php');


$to   = $email_email;
$email = 'thestore@gmail.com';
$name = 'TheStore';
$subject = "THESTORE - Order $refCode";
$body = "
        <p style='color:ffc107; font-family:arial; padding:10px;'>Payment successfully made!</p>
        <p> payment for order $refCode has been recieved and whill be delivered with in  2 to 14 walking days </p>
        <p>Current payment is being Verified. And after verification the supplier will process your order  </p>
        <p style='text-align:left;'>thanks for your petronage  </p>
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
    echo  $mail->ErrorInfo;
} else {
}
    

foreach($_SESSION['cart'] as $cart){
    $cartId = $cart['ids'];
    $cartSize = $cart['size'];
    $cartColor = $cart['color'];
    $cartQuantity = $cart['quantity'];




    $query = "SELECT * FROM product_db WHERE product_id = '$cartId'";
    $result = mysqli_query($conn, $query);
    $posts = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    $store_name = $posts['store_name'];
    $store_id = $posts['store_id'];
    $delivery_time = $posts['shipping_time'];
    $shipping = $posts['shipping_fee'];
    $product_name = $posts['product_name'];
    $price = $posts['price'];

    $orderQuery = "INSERT INTO orders(store_name,store_id,product_id,size,color,quantity,reference_code,email,lastname,firstname,delivery_address,_state,busstop,phone,extrainfo,delivery_time)
                                VALUE('$store_name','$store_id','$cartId','$cartSize','$cartColor','$cartQuantity','$refCode','$email_email','$lastname','$firstname','$address','$state','$busstop','$phone','$anyotherinfo','$delivery_time')";
   if(mysqli_query($conn,$orderQuery)){

        for ($x = 0; $x <= $unsetCount; $x++) {
            unset($_SESSION['cart'][$x]);
            // echo $x;
        }

        $Sellerquery = "SELECT * FROM sellers WHERE store_id = '$store_id'";
        $SellerResult = mysqli_query($conn, $Sellerquery);
        $seller = mysqli_fetch_assoc($SellerResult);
        mysqli_free_result($SellerResult);

      $sellerLastName =   $seller['lastname'];
       $sellersFirstName  = $seller['firstname'];
       $url =   ROOT_URL.'sellersLogin';


        $to   = $seller['business_email'];
        $email = 'thestore@gmail.com';
        $name = 'TheStore';
        $subject = "notification of order! - THESTORE";
        $body = "
        <p style=text-align:left; font-family:arial; padding:10px;'> Dear $sellerLastName $sellersFirstName</p>
        <p>Your product has been ordered by a customer. please login into your  <a href='$url'>Control Panel</a> to view details of the order and furfill the order in order to be paid </p> 
        <p style='text-align:left;'>Thanks</p>
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
            echo  $mail->ErrorInfo;
        } else {
            // echo 'email to seller sent';
        }
    

 header('refresh:5;url=' . ROOT_URL . 'orders.php');

   }else{
       die(mysqli_error($conn));
   }
}

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
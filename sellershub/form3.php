<?php
require('config/db.php');
session_start();
if (!isset($_SESSION['page2'])) {
    header('Location:'.ROOT_URL.'error');
};
$msg = "";
$msgClass = "";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


        // $page3 = $_SESSION['reg'];

if (isset($_POST['submit'])) {

    $bank_name = $_POST['bank_name'];
    $bank_code = $_POST['bank_code'];
    $account_number = $_POST['account_number'];
    $bvn = $_POST['bvn'];

    $_SESSION['page3'] = array(
        'bank_name' => $bank_name,
        'bank_code' => $bank_code,
        'account_number' => $account_number,
        'bvn' => $bvn
    );

    if (empty($bank_name) || empty($bank_code) || empty($account_number) || empty($bvn)) {
        $msg = "Please Fill in all details";
        $msgClass = "alert-danger text-danger text-center m-1";
    } else {
    
   

        // FORM 1
        $session_lastname =   $_SESSION['page1']['lastname'];
        $session_firstname = $_SESSION['page1']['firstname'];
        $session_phone = $_SESSION['page1']['number'];
        $session_date_of_birth =  $_SESSION['page1']['date_of_birth'];
        $session_store_name =  $_SESSION['page1']['store_name'];
        $session_email =  $_SESSION['page1']['email'];
        $session_address =  $_SESSION['page1']['address'];
        $session_password = password_hash($_SESSION['page1']['password'],PASSWORD_DEFAULT);
        // END OF FORM 1
        //FORM 2
        $session_business_name = $_SESSION['page2']['business_name'];
        $session_business_address =  $_SESSION['page2']['business_address'];
        $session_origin_address = $_SESSION['page2']['origin_address'];
        $session_name_of_person_in_charge =  $_SESSION['page2']['name_of_person_in_charge'];
        $session_business_email =  $_SESSION['page2']['business_email'];
        //END OF FORM 2

        $session_bank_name =  $_SESSION['page3']['bank_name'];
        $session_bank_code =  $_SESSION['page3']['bank_code'];
        $session_account_number =  $_SESSION['page3']['account_number'];
        $session_bvn =  $_SESSION['page3']['bvn'];



        $entittes = 'abcdefghijklmnopqrstabcdefgjhdsafhfkjshakdfgbsakjhfjsghabfhewgbfbsavjefuhwijerdbdsxfnjsfvbsjbdfjsdgjhfdbshijklmnopqrstuvwxyzuvwxyabcdefghijklmnopqrstabcdefghijklmnopqrstuvwxyzuvwxyzzabcdefghijklmnopqrstuvwxyz';
        $entittesprocess =  uniqid($entittes);
        $processing =  str_shuffle($entittesprocess);
        $letters = strtoupper(substr($processing, 0, 3));

        $entittes = 'abcdefghijklmnopqrstabcdsjdehsiguhdsfhnreiuwahfhbsvagfhsdbnlfiuewhgfhbjshbfsgfsjbdfhsgajfhbeawsbfjdbgvbfjahfefghijklmnopqrstuvwxyzuvwxyabcdefghijklmnopqrstabcdefghijklmnopqrstuvwxyzuvwxyzzabcdefghijklmnopqrstuvwxyz';
        $entittesprocess =  uniqid($entittes);
        $processing =  str_shuffle($entittesprocess);
        $letters2 = strtoupper(substr($processing, 0, 3));

        $entittes = time() . '1234546543468645636475678578678907454775686764645685545646467576876765467990876564312243454768553643234567890987656769586490869845986043689856758673939487569304985094873695739865738975694386985769438452463410384756839237449348467468349849238473294385737483293874939484374938';
        $entittesprocess =  uniqid($entittes);
        $processing =  str_shuffle($entittesprocess);
        $numbers = strtoupper(substr($processing, 0, 2));

        $store_id = $letters . $letters2 . $numbers;



        $query = "INSERT INTO sellers(store_id,lastname,firstname,phone,date_of_birth,email,personal_address,business_name,business_address,
        origin_address,name_of_person_in_charge,business_email,bank_name,bank_code,account_number,bvn) 
        VALUES('$store_id','$session_lastname','$session_firstname','$session_phone','$session_date_of_birth',
        '$session_email','$session_address','$session_business_name','$session_business_address',
        '$session_origin_address','$session_name_of_person_in_charge','$session_business_email','$session_bank_name',
        '$session_bank_code','$session_account_number','$session_bvn')";


        if (mysqli_query($conn, $query)) {

            $loginQuery = "INSERT INTO sellers_login_details(store_id,store_name,business_emails,pass)VALUES('$store_id','$session_business_name','$session_business_email','$session_password')";
            if (!mysqli_query($conn, $loginQuery)) {
                echo mysqli_error($conn);
            } else {


require_once('PHPMailer.php');
require_once('SMTP.php');
require_once('Exception.php');
require_once('OAuth.php');
require_once('POP3.php');
 $url =   ROOT_URL.'sellersLogin';

$to   = $session_business_address;
$email = 'thestore@gmail.com';
$name = 'TheStore';
$subject = "WELCOME TO THE FAMILY - THESTORE";
$body = "
<p style=text-align:left; font-family:arial; padding:10px;'> Dear $session_firstname $session_lastname</p>
<p>From everyone at <span style='color:#ffe105; font-size:bolder;'>THESTORE<span> We want to welcome you to the family. this platform assist businesses to access a wild range of customers around Nigeria and world wild.</p>
<p>You are required to make a payment of ₦3000 anually to keep your account active</p>
<p>You can login into <a href='$url'>sellers Dashboard </a> to upload your products that you wish to sell</p>
<p>You will be always notified instantly on any order made on your products on our platform so you are advised to check your mail frequently</p>
<p>you are always required to make your delivries on time to enable us keep our customers happy</p>
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
    header('Location:' . ROOT_URL . 'welcome.php');
}

                session_destroy();
                exit();
                //  echo "<script>window.open('login.php'); </script>";
            }
        }else{
            echo mysqli_error($conn);
        }
        $page3 = $_SESSION['page3'];
        print_r($page3);
    }
}


if (isset($_POST["row3PreviousBtn"])) {

    header('Location:' . ROOT_URL . 'form2.php');
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/all.min.css" rel="stylesheet">
    <script src="js/jquery.js"></script>


    <style>
        * {
            font-family: Comic Sans MS;
            font-size: 15px;
        }

        .form-control {
            border: 0px;
            border-bottom: 2px solid;
            border-radius: 0px;
        }

        .form-control:focus {
            box-shadow: none !important;
        }

        .checkboxLabel {
            font-size: 12px;
        }

        .checkboxLabel>a {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container" m-3>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="header text-center">
                <h3>SELLER CENTER</h3>
                <hr>
                <h6>Register and start selling today - create your own seller account</h6>
            </div>
            <div class="stages">
                <p><span class="badge badge-primary">1</span>Seller Account <span> <i class="fas fa-arrow-right">
                        </i></span>
                    <span class="badge badge-primary"> 2 </span> Business Information <span> <i class="fas fa-arrow-right">
                        </i> </span>
                    <span class="badge badge-primary">3</span> Bank Account<span> <i class="fas fa-arrow-right">
                        </i></span>
                    <span class="badge badge-primary">4</span>Summary
                </p>
            </div>
            <div class="row" id="row3">
                <div class="col-md-6 card shadow border">
                    <div class="progress m-3">
                        <div class="progress-bar bg-success progress-bar-striped active" style="width:92%;">3 of 3</div>
                    </div>
                    <div class="form-header text-center m-2 p-2 text-warning">
                        <h2>Add Bank Information</h2>

                    </div>
                    <div class="main-form px-5 pt-0">

                        <?php if ($msg != "") : ?>
                            <div class="<?php echo $msgClass ?>"> <?php echo $msg; ?> </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bankName">Bank Name</label>
                                    <input type="text" name="bank_name" id="bankName" class="form-control" placeholder="Bank Name" value="<?php echo !empty($_COOKIE['bank_name']) ? $_COOKIE['bank_name'] : "" ?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bankCode">Bank Code</label>
                                    <input type="text" name="bank_code" id="bankCode" class="form-control" placeholder="Bank Code" value="<?php echo !empty($_COOKIE['bank_code']) ? $_COOKIE['bank_code'] : "" ?>">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="accountNumber">Account Number</label>
                                    <input type="number" name="account_number" id="accountNumber" class="form-control" placeholder="Account Number" value="<?php echo !empty($_COOKIE['account_number']) ? $_COOKIE['account_number'] : "" ?>">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bvn">BVN</label>
                                    <input type="number" name="bvn" id="bvn" maxlenth="20" class="form-control" placeholder="BVN" value="<?php echo !empty($_COOKIE['bvn']) ? $_COOKIE['bvn'] : "" ?>">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12 m-3">
                                <!-- <button type="submit" name="row3PreviousBtn" class="btn btn-danger float-left" id="row3PreviousBtn">Previous <i class="far fa-arrow-circle-left"></i></button> -->
                                <button type="submit" name="submit" class="btn btn-success float-right" id="row3NextBtn"> <i class="fal fa-paper-plane"></i> Submit</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>


                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>

        </form>
    </div>
    <script>
        $(document).ready(function() {
            function preback() {
                window.history.forward();
            }
            setTimeout(preback(), 0);
            window.onload() = function() {
                null
            };
        })
    </script>
</body>

</html>
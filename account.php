<?php
require('config/db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




$msg = "";
$msgClass = "";
if (isset($_POST['createBtn'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $Confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $postal = mysqli_real_escape_string($conn, $_POST['postalcode']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);

    if (empty($firstname) || empty($lastname) || empty($email) || empty($Confirmpassword) || empty($password) || empty($address) || empty($state) || empty($phone) || empty($postal) || empty($country) || empty($city)) {
        $msg = "All fields must be field";
        $msgClass = "alert-danger text-danger text-center mx-1";
    } else {

        if ($password != $Confirmpassword) {
            $msg = "Confirm password do not match with password";
            $msgClass = "alert-danger text-danger text-center mx-1";
        } else {

            $checker = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $checker);
            $numrow = mysqli_num_rows($result);
            if ($numrow != 0) {
                $msg = "email already has an account";
                $msgClass = "alert-danger text-danger text-center mx-1";
            } else {



                $query = "INSERT INTO users(firstname,lastname,email,_state,phone_number,address,postal_code,country,city)
        VALUES('$firstname','$lastname','$email','$state','$phone','$address','$postal','$country','$city')";

                if (mysqli_query($conn, $query)) {

                    $hashPass = password_hash($password, PASSWORD_DEFAULT);
                    $loginQuery = "INSERT INTO user_login_details(emails,pass)VALUES('$email','$hashPass')";
                    if (mysqli_query($conn, $loginQuery)) {

                        require_once('PHPMailer/PHPMailer.php');
                        require_once('PHPMailer/SMTP.php');
                        require_once('PHPMailer/Exception.php');
                        require_once('PHPMailer/OAuth.php');
                        require_once('PHPMailer/POP3.php');


                        $to   = $email;
                        $email = 'thestore@gmail.com';
                        $name = 'TheStore';
                        $subject = "Welcome to the Store ";
                        $body = "
                         <p>Welcome and thank you for registering at THE STORE!</p>
                         <p>Your account has now been created and you can log in by using your email address and password by visiting our website or at the following URL:" . ROOT_URL . "login </p>
                         <p> Upon logging in, you will be able to access other services including reviewing past orders, printing invoices and editing your account information. </p>
                         <p  style='text-align:left;>THANKS</p>
                         <p style='text-align:left; font-size:20px;'>THESTORE</p>
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
                            header('Location:' . ROOT_URL . 'login');
                        }
                    }
                }
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/all.min.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <link href="css/login.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>
    <?php require('inc/navbar.php'); ?>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-3 px-4 py-5 "></div>

            <div class="col-md-6 mt-5 px-4  card shadow">

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="main-form p-2">



                    <div class="header text-center">
                        <h1>Register Account</h1>
                    </div>
                    <?php if ($msg != "") : ?>
                        <div class="<?php echo $msgClass ?>"><?php echo $msg ?></div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" value="<?php echo !empty($firstname) ? $firstname : "" ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname" value="<?php echo !empty($lastname) ? $lastname : "" ?>">
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo !empty($email) ? $email : "" ?>">

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" minlength="6" value="<?php echo !empty($password) ? $password : "" ?>">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="password" name="confirmpassword" id="confirmPassword" class="form-control" minlength="6" placeholder="Confirm password" value="<?php echo !empty($confirmpassword) ? $confirmpassword : "" ?>">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="state" id="state" class="form-control" placeholder="State" value="<?php echo !empty($state) ? $state : "" ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="phone" name="phone" id="phone" class="form-control " maxlength="11" value="" placeholder="Phone Number" value="<?php echo !empty($phone) ? $phone : "" ?>">
                            </div>
                        </div>


                    </div>
                    <div class="form-group">
                        <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="<?php echo !empty($address) ? $address : "" ?>">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="postalcode" id="postalcode" class="form-control" placeholder="Postal code" value="<?php echo !empty($postal) ? $postal : "" ?>">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="country" id="country" class="form-control" placeholder="Country" value="<?php echo !empty($country) ? $country : "" ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" name="city" id="city" class="form-control" placeholder="City/Town" value="<?php echo !empty($city) ? $city : "" ?>">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="create-Btn btn btn-warning btn-lg w-100" id="createBtn" name="createBtn">Create Account</button>
                    </div>

                    <div class="form-group text-center">
                        <label>Already have an account?</label>
                        <a href="<?php echo ROOT_URL; ?>login" class="signin">Sign In</a>

                    </div>

                </form>


            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    <div class="footer mt-5">
        <?php require('inc/footer.php'); ?>
    </div>
</body>

</html>
<?php
require('config/db.php');
$msg = "";
$msgClass = "";
$page1 ="";

if (isset($_POST["row1NextBtn"])) {

    if (isset($_POST["checkbox"])) {

        $firstname = htmlentities($_POST["firstname"]);
        $lastname =  htmlentities($_POST["lastname"]);
        $number =  htmlentities($_POST["phone"]);
        $date_of_birth =  htmlentities($_POST["date_of_birth"]);
        $email =  htmlentities($_POST["email"]);
        $password =  htmlentities($_POST["password"]);
        $address =  htmlentities($_POST["address"]);
        $confirm_password =  htmlentities($_POST["confirm_password"]);
         
        session_start();
            $_SESSION['page1'] = [

                "firstname" => $firstname,
                "lastname" => $lastname,
                "number" => $number,
                "date_of_birth" => $date_of_birth,
                "email" => $email,
                "password" => $password,
                "address" => $address,
                "confirm_password" => $confirm_password

            ];

              
        
               
        if (empty($firstname) || empty($lastname) || empty($number) || empty($date_of_birth)  || empty($email) || empty($password) || empty($address)) {
            $msg = "Please Fill in all details";
            $msgClass = "alert-danger text-danger text-center m-1";
        } else {
            if ($password != $confirm_password) {
                $msg = "Confirm password do not match with password";
                $msgClass = "alert-danger text-danger text-center mx-1";
            } else {
                $query = "SELECT * FROM sellers WHERE email ='$email'";
                $result = mysqli_query($conn, $query);
                $checkEmail = mysqli_num_rows($result);
                if($checkEmail >0){
                    $msg = "Email Already Registered";
                    $msgClass = "alert-danger text-danger text-center mx-1";
                }else{
                      header('Location:'.ROOT_URL.'form-2');
                }
             

            }
        }

        $page1 = $_SESSION['page1'];
        // print_r($page1);


    } else {
        $msg = "please read and agree to our terms and conditions";
        $msgClass = "alert-danger text-danger text-center m-1";
    }
   
}

      //  print_r($_SESSION['page1']);
?>

<head>
    <!DOCTYPE html>
    <html lang="en">
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
        <form action="<?php //echo $_SERVER["PHP_SELF"]; ?>" method="POST">
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

            <div class="row" id="row1">
                <div class="col-md-6 card shadow">

                    <div class="progress m-3">
                        <div class="progress-bar bg-danger progress-bar-striped active" style="width:25%;">1 of 3</div>
                    </div>

                    <div class="form-header text-center m-2 p-2 text-warning">
                        <h2>Account Information</h2>

                    </div>
                    <div class="main-form px-5 pt-0">
                        <?php if ($msg != "") : ?>
                            <div class="<?php echo $msgClass ?>"> <?php echo $msg; ?> </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Firstname">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" value="<?php echo (isset($_SESSION['page1']['firstname'])) ? $_SESSION['page1']['firstname'] : "" ?>">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname" value="<?php echo (isset($_SESSION['page1']['lastname'])) ? $_SESSION['page1']['lastname'] : "" ?>">
                                </div>

                            </div>

                        </div>
                        <div class=" row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="phone" name="phone" id="phone" class="form-control" placeholder="Phone Number" value="<?php echo (isset($_SESSION['page1']['number'])) ? $_SESSION['page1']['number'] : "" ?>">
                                </div>
                            </div>
                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label for="dateOfBirth">Date of Birth</label>
                                    <input type="date" name="date_of_birth" id="dateOfBirth" class="form-control" placeholder="Date of Birth" value="<?php echo (isset($_SESSION['page1']['date_of_birth'])) ? $_SESSION['page1']['date_of_birth'] : "" ?>">
                                </div>
                            </div>
                        </div>
<!-- 
                        <div class=" form-group">
                            <label for="storeName">Store Name</label>
                            <input type="text" name="store_name" id="storeName" class="form-control" placeholder="Store Name" value="<?php echo (isset($_SESSION['page1']['store_name'])) ? $_SESSION['page1']['store_name'] : "" ?>">
                        </div> -->
                        <div class=" row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo (isset($_SESSION['page1']['email'])) ? $_SESSION['page1']['email'] : "" ?>">
                                </div>
                            </div>

                            <div class=" col-md-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="<?php echo (isset($_SESSION['page1']['address'])) ? $_SESSION['page1']['address'] : "" ?>">
                                </div>
                            </div>

                        </div>

                        <div class=" row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" minlength="8" value="<?php echo (isset($_SESSION['page1']['password'])) ? $_SESSION['page1']['password'] : "" ?>">
                                </div>
                            </div>
                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirmPassword" class="form-control" minlength="8" placeholder="Confirm Password" value="<?php echo (isset($_SESSION['page1']['confirm_password'])) ? $_SESSION['page1']['confirm_password'] : "" ?>">
                                </div>
                            </div>

                        </div>
                        <!-- <script>
                                    $(document).ready(function(){
                                     var password =  $('#password').val();
                                    })
                                </script> -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-check">
                                    <input type="checkbox" name="checkbox" id="checkbox" value="yes"> <label for="checkbox" class="checkboxLabel">I have read
                                        and accepted the <a href="#">E-Contract</a> </label>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-5 text-right">
                                <button type="submit" name="row1NextBtn" class="btn btn-primary" id="row1NextBtn">Next <i class="far fa-arrow-circle-right"></i></button>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>

        </form>
    </div>

</body>

</html>
<?php
$msg = "";
$msgClass = "";



if (isset($_POST["row1NextBtn"])) {

    $firstName = htmlentities($_POST["firstname"]);
    $lastname =  htmlentities($_POST["lastname"]);
    $number =  htmlentities($_POST["phone"]);
    $date_of_birth =  htmlentities($_POST["date_of_birth"]);
    $store_name =  htmlentities($_POST["shop_name"]);
    $email =  htmlentities($_POST["email"]);
    $password =  htmlentities($_POST["password"]);


    if (empty($firstName) || empty($lastname) || empty($number) || empty($date_of_birth) || empty($store_name) || empty($email) || empty($password)) {
        $msg = "Please Fill in all details";
        $msgClass = "alert-danger text-danger text-center m-1";
    } else {

        if ($_POST["checkbox"] == "yes") {
        } else {
            $msg = "please read and agree to our terms and conditions";
            $msgClass = "alert-danger text-danger text-center m-1";
        }
    }
}






if (isset($_POST["row2PreviousBtn"])) {
}


if (isset($_POST["row2NextBtn"])) {
}

if (isset($_POST["row3PreviousBtn"])) {
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


            <div class="row" id="row1">
                <div class="col-md-6 card shadow">

                    <div class="progress m-3">
                        <div class="progress-bar bg-danger progress-bar-striped active" style="width:25%;">25%</div>
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
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname">
                                </div>

                            </div>
                            <div class="col-md-6">


                                <div class="form-group">
                                    <label for="Firstname">Firstname</label>
                                    <input type="text" name="firstname" id="Firstname" class="form-control" placeholder="Firstname" value="<?php echo !empty($firstname) ? $firstname : "" ?>">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="phone" name="phone" id="phone" class="form-control" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dateOfBirth">Date of Birth</label>
                                    <input type="date" name="date_of_birth" id="dateOfBirth" class="form-control" placeholder="Date of Birth">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="shopName">Store Name</label>
                            <input type="text" name="shop_name" id="shopName" class="form-control" placeholder="Store Name">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirmPassword" class="form-control" placeholder="Confirm Password">
                                </div>
                            </div>

                        </div>

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

            <div class="row" id="row2">
                <div class="col-md-6 card shadow border">
                    <div class="progress m-3">
                        <div class="progress-bar bg-warning progress-bar-striped active" style="width:60%;">60%</div>
                    </div>
                    <div class="form-header text-center m-2 p-2 text-warning">
                        <h2>Business Information</h2>

                    </div>
                    <div class="main-form px-5 pt-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Business Name</label>
                                    <input type="password" name="business_name" id="businessName" class="form-control" placeholder="Business Name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname">Business Address</label>
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="origin">Origin Address</label>
                                    <input type="phone" name="origin" id="origin" class="form-control" placeholder="Origin Address">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="nameInCharge">Name of Person In charge</label>
                            <input type="text" name="name-in-charge" id="nameInCharge" class="form-control" placeholder="Name of Person In charge">
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12 m-3">
                                <button type="submit" name="row2PreviousBtn" class="btn btn-danger float-left" id="row2PreviousBtn"> <i class="far fa-arrow-circle-left"></i> Previous</button>
                                <button type="submit" name="row2NextBtn" class="btn btn-primary float-right" id="row2NextBtn">Next <i class="far fa-arrow-circle-right"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>


                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>


            <div class="row" id="row3">
                <div class="col-md-6 card shadow border">
                    <div class="progress m-3">
                        <div class="progress-bar bg-success progress-bar-striped active" style="width:92%;">92%</div>
                    </div>
                    <div class="form-header text-center m-2 p-2 text-warning">
                        <h2>Add Bank Information</h2>

                    </div>
                    <div class="main-form px-5 pt-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Bank Name</label>
                                    <input type="text" name="bank_name" id="bankName" class="form-control" placeholder="Bank Name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tel">Bank Code</label>
                                    <input type="tel" name="tel" id="tel" class="form-control" placeholder="Bank Code">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="accountNumber">Account Number</label>
                                    <input type="phone" name="account_number" id="accountNumber" class="form-control" placeholder="Account Number">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bvn">BVN</label>
                                    <input type="text" name="bvn" id="bvn" class="form-control" placeholder="BVN">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12 m-3">
                                <button type="submit" name="row3PreviousBtn" class="btn btn-danger float-left" id="row3PreviousBtn">Previous <i class="far fa-arrow-circle-left"></i></button>
                                <button type="submit" name="row3NextBtn" class="btn btn-success float-right" id="row3NextBtn"> <i class="fal fa-paper-plane"></i> Submit</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>


                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>

        </form>
    </div>
    
</body>

</html>
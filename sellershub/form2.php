<?php
require('config/db.php');
$msg = "";
$msgClass = "";
session_start();
$page2="";
// print_r( $_SESSION['page2']);
if(!isset($_SESSION['page1'])){
    header('Location:'.ROOT_URL.'error');
}


if (isset($_POST["row2NextBtn"])) {

    $business_name = htmlentities($_POST["business_name"]);
    $business_address = htmlentities($_POST["business_address"]);
    $origin_address = htmlentities($_POST["origin_address"]);
    $name_of_person_in_charge = htmlentities($_POST["name_of_person_in_charge"]);
    $business_email = htmlentities($_POST["business_email"]);

    $_SESSION['page2'] = array(
        'business_name' => $business_name,
        'business_address' => $business_address,
        'origin_address' => $origin_address,
        'name_of_person_in_charge' => $name_of_person_in_charge,
        'business_email' => $business_email

    );

    if (empty($business_name) || empty($business_address) || empty($origin_address) || empty($name_of_person_in_charge) || empty($business_email)) {
        $msg = "Please Fill in all details";
        $msgClass = "alert-danger text-danger text-center m-1";
    } else {
        $query = "SELECT * FROM sellers WHERE business_name ='$business_name'";
        $result = mysqli_query($conn, $query);
        $checkStoreName = mysqli_num_rows($result);
        if($checkStoreName >0){
            $msg = "Store Name Already Registered";
            $msgClass = "alert-danger text-danger text-center mx-1";
        }else{
            $queryStoreEmail = "SELECT * FROM sellers WHERE business_email ='$business_email'";
            $resultEmail = mysqli_query($conn, $queryStoreEmail);
            $checkStoreEmail = mysqli_num_rows($resultEmail);
            if($checkStoreEmail>0){
                $msg = "Store Email Already Registered";
                $msgClass = "alert-danger text-danger text-center mx-1";
            }else{
                header('Location:'.ROOT_URL.'form-3');

            }

        }
    }

 $page2 = $_SESSION['page2'];

   
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


            <div class="row" id="row2">
                <div class="col-md-6 card shadow border">
                    <div class="progress m-3">
                        <div class="progress-bar bg-warning progress-bar-striped active" style="width:60%;">2 of 3</div>
                    </div>
                    <div class="form-header text-center m-2 p-2 text-warning">
                        <h2>Business Information</h2>

                    </div>
                    <div class="main-form px-5 pt-0">
                        <?php if ($msg != "") : ?>
                            <div class="<?php echo $msgClass ?>"> <?php echo $msg; ?> </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Store Name</label>
                                    <input type="text" name="business_name" id="businessName" class="form-control" placeholder="Business Name" value="<?php echo !empty($page2['business_name']) ? $page2['business_name'] : "" ?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Store Address</label>
                                    <input type="text" name="business_address" id="address" class="form-control" placeholder="Business Address" value="<?php echo !empty($page2['business_address']) ? $page2['business_address'] : "" ?>">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="origin">Origin Address</label>
                                    <input type="text" name="origin_address" id="address" class="form-control" placeholder="Origin Address" value="<?php echo !empty($page2['origin_address']) ? $page2['origin_address'] : "" ?>">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="nameOfPersonInCharge">Name of Person In charge</label>
                            <input type="text" name="name_of_person_in_charge" id="nameOfPersonInCharge" class="form-control" placeholder="Name of Person In charge" value="<?php echo !empty($page2['name_of_person_in_charge']) ? $page2['name_of_person_in_charge'] : "" ?>">
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Store Email</label>
                                    <input type="email" name="business_email" id="email" class="form-control" placeholder="Business Email" value="<?php echo !empty($page2['business_email']) ? $page2['business_email'] : "" ?>">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12 m-3">
                                
                                <!-- <button type="submit" name="row2PreviousBtn" class="btn btn-danger float-left" id="row2PreviousBtn"> <i class="far fa-arrow-circle-left"></i> Previous</button> -->
                                <button type="submit" name="row2NextBtn" class="btn btn-primary float-right" id="row2NextBtn">Next <i class="far fa-arrow-circle-right"></i></button>
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
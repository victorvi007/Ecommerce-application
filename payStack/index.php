<?php
require('../config/db.php');
if(empty($_SESSION['cart'])){
    header('Location:' . ROOT_URL.'cart');

}
if (!isset($_SESSION['user'])) {
    header('Location:' . ROOT_URL);
}
// print_r($_SESSION['cart']);
$sessionLogin = $_SESSION['user'];

if (isset($_POST['submit'])) {

       $firstname = htmlentities($_POST['firstname']);
       $lastname = htmlentities($_POST['lastname']);
      $email = htmlentities($_POST['email']);
      $state = htmlentities($_POST['state']);
       $phone = htmlentities($_POST['phone']);
       $address = htmlentities($_POST['address']);
      $city = htmlentities($_POST['city']);
      $busstop = htmlentities($_POST['busstop']);
       $anydetail = htmlentities($_POST['description']);

    $_SESSION['shipping_details'] = [$firstname, $lastname, $email, $state, $phone, $address, $city, $busstop, $anydetail];

    // print_r($_SESSION['shipping_details']);
    header('Location:pay.php');

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
    <style>
        * {
            font-family: Comic Sans MS;
            font-weight: bold !important;
        }

        .table-header {
            border-radius: 10px 10px 0px 0px;
        }

        .boxing {
            justify-content: center;
        }

        .card {
            border-radius: 10px;
        }

        /* .form-control{
            fe
        } */
    </style>
</head>

<body>
    <div class="container-fluid bg-light">
        <div class="row">
            <div class="col-md-12 bg-white">
                <h2 class="text-left text-primary">PAYMENT</h2>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="container-fluid">
                    <div class="boxing row mt-5 mb-5">
                        <div class="card shadow w-100 p-2">

                            <div class="row">
                                <div class="col-md-12 text-center text-primary m-2">
                                    <h3>DELIVERY DETAILS</h3>
                                </div>
                            </div>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="paymentForm" class="m-4" method="POST">
                                <div class="row">

                                   
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name">First Name</label>
                                        </div>
                                        <div class="col-md-8">

                                            <input type="text" class="form-control" id="firstname" name="firstname" required value=" <?php echo $sessionLogin['firstname'] ?>">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="last-name">Last Name</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="lastname" name="lastname" required value=" <?php echo $sessionLogin['lastname'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="email">Email Address</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="email" class="form-control" id="email" name="email" required value=" <?php echo $sessionLogin['email'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="amount">Amount</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p type="tel" class="form-control text-success" id="amount1"> <?php echo $_SESSION['checkout'] ?> </p>
                                            <input type="hidden" class="form-control" id="amount" required value="<?php echo $_SESSION['checkout'] ?>" />
                                        </div>
                                    </div>
                                </div> -->


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="state">State</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="state" name="state" required value=" <?php echo $sessionLogin['_state'] ?>">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="phone">Phone Number</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="tel" class="form-control" id="phone" name="phone" required value=" <?php echo $sessionLogin['phone_number'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="address">Address</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="address" name="address" required value=" <?php echo $sessionLogin['address'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="city">City</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="city" name="city" required value=" <?php echo $sessionLogin['city'] ?>">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="busstop">Landmark or Busstop</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="busstop" name="busstop" required value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="anydetail">Any other Details</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea id="anydetail" name="description" class="form-control" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-submit text-center">
                                    <button type="submit"  name="submit" class="btn btn-primary  w-100">Continue Payment </button>
                                </div>
                            </form>


                        </div>
                    </div>
                   


                </div>
            </div>
            <div class="col-md-3"></div>

        </div>

    </div>
    </div>
</body>

</html>
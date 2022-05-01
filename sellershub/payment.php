<?php
require('config/db.php');
session_start();



if (!isset($_SESSION['store_id'])) {
    header('Location:' . ROOT_URL . '/sellersLogin');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location:' . ROOT_URL . '/sellersLogin');
}




// if(!isset($_SESSION['store_id'])){
// header('Location:'.ROOT_URL.'error');
// }
// if (!isset($_SESSION['store_id'])) {
//     header("Location: ../sellersLogin.php");
// }



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=" stylesheet" href="css/bootstrap.min.css">
    <link href="css/all.min.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <title>Document</title>
    <style>
        body {
            /* background: rgb(248, 246, 246); */
            font-family: arial;
        }



        .header {
            border-radius: 0px;
            cursor: default;
            color: white;
            font-size: 30px;
        }

        .header:hover {
            border-radius: 0px;
            cursor: default;
            color: white;
            font-size: 30px;
        }



        .footer {
            padding-top: 10px;
            padding-bottom: 5px;
            /* background:#3e5a7c; */
        }

        .fal {
            color: #ffc107;
        }

        .brand-logo {
            max-width: 200px;
            height: 100px;
            /* border: 2px solid; */
            display: flex;
        }

        #image {
            width: 200px;
            height: 100px;
        }

        nav {
            /* display: flex; */
            min-width: 100%;
            /* border: 1px solid; */
        }


        .container {
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-sm bg-light navbar-light sticky-top p-0">

        <button class="navbar-toggler m-1" data-target="#collapse_target" data-toggle="collapse">
            <img src="img/eagle.png" alt="" class="navbar-brand img-responsive" id="image">

        </button>
        <div class="collapse navbar-collapse" id="collapse_target">

            <!--LOGO STARTS-->

            <a href="<?php echo ROOT_URL ?>" class="navbar-brand">
                <!-- <img src="<?php echo ROOT_URL ?>/adminpanel/<?php echo $settings['logo'] ?>" alt="" class="navbar-brand img-fluid"> -->
                <img src="img/eagle.png" alt="" class="navbar-brand img-fluid" id="image">
                <!-- <img src="img/eagle.png" alt="" class="img-fluid" id="image"> -->
            </a>

            <!--LOGO ENDS-->



        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <button name="logout" class="btn-danger btn text-white mr-2"> <i class="fad fa-sign-out-alt"></i> Logout </button>
        </form>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 m-3">
                <div class="col-md-12 col-12 d-md-block  padding"></div>
                <div class="card">
                    <div class="header btn bg-primary w-100 m-0">Payment Plan
                        <p>
                            <div class="price"> ₦2000/year </div>

                        </p>

                    </div>
                    <div class="article  p-2 pl-3">
                        <p><i class="fal fa-check"></i> Sell unlimited Products</p>
                        <p><i class="fal fa-check"></i> Instant Payment on delivery</p>
                        <p><i class="fal fa-check"></i> Instant notification on all order</p>

                        <p><i class="fal fa-check"></i> Free advert on Products</p>

                        <p><i class="fal fa-check"></i> Instant notification on all order </p>

                        <p><i class="fal fa-check"></i> Instant notification on all order </p>

                    </div>
                    <div class="footer">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="paymentForm">
                            <button type="submit" onclick="payWithPaystack()" class="button btn btn-primary w-100 m-0">Subscribe</button>

                        </form>

                    </div>

                </div>
                <div class="col-md-3"></div>

            </div>
        </div>
        <script src="https://js.paystack.co/v1/inline.js"></script>

        <script>
            const paymentForm = document.getElementById('paymentForm');
            paymentForm.addEventListener("submit", payWithPaystack, false);

            function payWithPaystack(e) {
                e.preventDefault();
                let handler = PaystackPop.setup({
                    key: 'pk_test_47a5d59f51c31385b495e531607c9a7a1997404a', // Replace with your public key
                    email: "<?php echo $_SESSION['payment_details']['business_email'] ?>",
                    amount: 2000 * 100,
                    firstname: "<?php echo $_SESSION['payment_details']['firstname']; ?>",
                    lastname: "<?php echo $_SESSION['payment_details']['lastname']; ?>",

                    ref: "<?php echo  $_SESSION['payment_details']['store_id']; ?>" + '-' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                    // ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                    // label: "Optional string that replaces customer email"
                    onClose: function() {
                        // alert('Window closed.');
                        window.open("<?php echo ROOT_URL ?>paymentplan");
                    },
                    callback: function(response) {
                        window.location.href = "<?php echo ROOT_URL ?>sellershub/subscription/success.php?reference=" + response.reference;
                        // $_SESSION['payment_details']

                        // let message = 'Payment complete! Reference: ' + response.reference;
                        // alert(message);
                        $.ajax({
                            url: "<?php echo ROOT_URL ?>sellershub/subscription/success.php" + response.reference,
                            method: 'get',
                            success: function(response) {
                                // the transaction status is in response.data.status
                            }

                        });

                    }
                });
                handler.openIframe();
            }
            // alert('hello');
        </script>
    </div>

</body>

</html>
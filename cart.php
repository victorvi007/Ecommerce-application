<?php require('config/db.php');
// unset($_SESSION['shipping_details']);
// print_r($_SESSION['shipping_details']);

if (isset($_POST['payCheckout'])) {
    if (isset($_SESSION['user'])) {
        header('Location:' . ROOT_URL . 'payStack');
    } else {
        echo "<script> alert('Please Login to Complete this purchase'); </script>";
        header('Location:' . ROOT_URL . 'login');
    }
}

$shipping = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/all.min.css" rel="stylesheet">
    <!-- <script src="js/jquery-3.5.1.min.js"></script> -->
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <style>
        .fas {
            color: white;
        }

        .img-fluid {
            height: 200px;
            width: 400px;
        }
    </style>
</head>

<body>
    <?php require('inc/navbar.php');

    // print_r($_SESSION['color']);
    ?>
    <div class="container-fluid">
        <div class="row px-2 mb-5">
            <div class="col-md-8 col-sm-6">
                <?php if (isset($_SESSION['cart'])) { ?>
                    <?php if (count($_SESSION['cart']) != 0) { ?>
                        <?php






                        ?>


                        <?php
                        if (isset($_SESSION['cart'])) {


                            $total = 0;
                            $shippingTotal = "0";

                            foreach ($_SESSION['cart'] as $key => $value) :;
                                $valueid = $value['ids'];
                                $query = "SELECT * FROM product_db WHERE product_Id = '$valueid'";
                                $result = mysqli_query($conn, $query);
                                // print_r($valueid);
                                if ($post = mysqli_fetch_array($result)) :;
                                    $shipping =  $post['shipping_fee'];


                                    $total = $total + $post['price'] * $value['quantity'];
                                    $shippingTotal = $shippingTotal + $shipping;
                                    //  $gross = $total +  $shipping;

                                    //  print_r($total);

                        ?>


                                    <div class="row shadow py-2 mb-3">

                                        <div class="col-md-3 col-sm-12 m-0 p-0 text-center border">
                                            <img src="<?php echo ROOT_URL . 'sellershub/' . $post['product_image_A']; ?>" alt="<?php echo $post['product_name']; ?>" class="img-fluid">
                                        </div>

                                        <div class=" col-md-6 col-sm-12 ">

                                            <h4 class="pt-2"><?php echo $post['product_name']; ?> </h4>
                                            <h6 class="pt-0 text-muted"><?php echo 'Seller:' . $post['store_name']; ?></h6>
                                            <h6 class="pt-0"> <?php echo (!empty($value['size'])) ? 'Size:' . $value['size'] : ""; ?> </h6>
                                            <h6 class="pt-0"><?php echo (!empty($value['color'])) ? 'Color:' . $value['color'] : ""; ?></h6>
                                            <h6 class="pt-0"><?php echo ' Price:₦' . $post['price']; ?> </h6>
                                            <h6 class="pt-0"><?php echo ' delivery time:' . $post['shipping_time']; ?> </h6>
                                            <h6 class="pt-0"> <?php echo 'Quantity:' . $value['quantity'] ?></h6>

                                        </div>

                                        <div class="col-md-3 col-sm-12  pt-3 pb-2">
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $post['product_Id'] ?>" method="POST">
                                                <button type="submit" name="remove" class="btn btn-danger" id="remove"> Remove <i class="fal fa-trash"></i></button>
                                            </form>
                                        </div>

                                    </div>
                                    <script>
                                        if (window.history.replaceState) {
                                            window.history.replaceState(null, null, window.location.href);
                                        }
                                    </script>
                                <?php endif ?>
                        <?php endforeach;
                        }
                        ?>
                    <?php } else { ?>

                        <div class="col-md-12 text-uppercase text-weight-bold text-muted text-center" style="padding-top:200px;padding-bottom:200px;">
                            <h2 style="font-size:100px;"> <i class="fad fa-shopping-cart"></i> </h2>
                            <h1 class="text-uppercase text-weight-bold text-muted text-center" style="font-size:50px; opacity:0.4;">cart is empty</h1>

                            <a href="<?php echo ROOT_URL ?>" class="btn btn-warning btn-lg w-75 text-white">start Shopping</a>
                        </div>


                    <?php } ?>
                <?php } else { ?>


                    <div class="col-md-12 text-uppercase text-weight-bold text-muted text-center" style="padding-top:300px;padding-bottom:300px;">
                        <h2 style="font-size:100px;"> <i class="fad fa-shopping-cart"></i> </h2>
                        <h1 class="text-uppercase text-weight-bold text-muted text-center" style="font-size:50px; opacity:0.4;">cart is empty</h1>
                        <a href="<?php echo ROOT_URL ?>" class="btn btn-warning btn-lg w-75 text-white">start Shopping</a>
                    </div>
                <?php } ?>

            </div>

            <div class="col-md-4 col-12 ">
                <div class="row">
                    <div class="col-md-12 m-1">
                        <div class="shadow pb-2 ">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <h6 class="p-2">PRICE DETAILS</h6>
                                <hr>
                                <h6 class="p-2">Price(<?php echo (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : "0" ?>

                                    <?php (isset($total)) ? $gross = $total + $shippingTotal : "0";
                                    ?> items):<span class="text-success"> ₦<?php echo (isset($total)) ? $total : " 0 ";   ?> <span> </h6>
                                <h6 class="p-2">Delivery Charges: <span class="text-success"> ₦ <?php echo (isset($shippingTotal)) ? $shippingTotal : "0";  ?> </span> </h6>
                                <hr>
                                <h6 class="p-2">Total Amount: <span class="text-success"> ₦ <?php echo (isset($gross)) ? $gross : "0"; ?> </span> </h6>
                                <div class="row text-center">
                                    <div class="col-md-6 ">
                                        <a href="<?php echo ROOT_URL ?>" class="btn btn-warning text-white m-2" id="pay">Continue shopping</a>

                                    </div>
                                    <div class="col-md-5 pr-4">
                                        <?php if (!empty($_SESSION['cart'])) :; ?>
                                            <button type="submit" name="payCheckout" class="btn btn-success w-100" id="pay">PAY</button>
                                        <?php endif ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                        if (isset($gross)) {
                                            $_SESSION['checkout'] = $gross;
                                        }
                                        ?>
                                    </div>
                                </div>

                            </form>
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <?php if (!empty($_SESSION['user'])) :; ?>

                                        <a href="orders.php" class="btn btn-primary w-100">Orders</a>
                                    <?php endif ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 shadow ">

                    </div>

                </div>

            </div>


        </div>

    </div>
</body>
<div class="footer">
    <?php require('inc/footer.php'); ?>

</div>

</html>
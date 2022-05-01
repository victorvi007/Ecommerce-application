<?php require('config/db.php');
$useremail = "";
if (isset($_SESSION['user'])) {
    $useremail = $_SESSION['user']['email'];
}
unset($_SESSION['shipping_details']);

// print_r($_SESSION['user']['email']);
$orderQuery = "SELECT * FROM orders WHERE email='$useremail' ORDER BY ordered_at DESC";
$orderResult = mysqli_query($conn, $orderQuery);
$orders = mysqli_fetch_all($orderResult, MYSQLI_ASSOC);
// print_r($orders);
mysqli_free_result($orderResult);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/all.min.css" rel="stylesheet">
    <title>Orders</title>
    <style>
        #img {
            height: 200px;
            width: 500px;
        }

        #pending
         {
            box-shadow:3px 0px 0px 0px #ffc107;
        }

        #delivered {
            box-shadow: 3px 0px 0px 0px #28a745;
        }
    </style>
</head>

<body>
    <?php require('inc/navbar.php'); ?>
    <div class="container">
        <?php if (count($orders) != 0) { ?>
            <?php foreach ($orders as $order) :; ?>

                <?php
                $orderProductId = $order['product_id'];
                $productQuery = "SELECT * FROM product_db WHERE product_id = '$orderProductId' ";
                $productResult = mysqli_query($conn, $productQuery);
                $productId = mysqli_fetch_assoc($productResult);
                mysqli_free_result($productResult);

                ?>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="body row border my-3 mx-1" id="<?php echo ($order['delivered'] == 0) ? "pending" : "delivered"; ?>">
                            <div class="col-4  m-0 p-0 text-center">
                                <img src="<?php echo ROOT_URL . 'sellershub/' . $productId['product_image_A']; ?>" alt="<?php echo $productId['product_name']; ?>" class="img-fluid" id="img">
                            </div>
                            <a href=""> </a>

                            <div class=" col-8">
                                <h3 class="pt-0 pt-1 "><?php echo $productId['product_name']; ?></h3>
                                <h6 class="pt-0">Store: <?php echo $order['store_name'] ?> </h6>
                                <h6 class="pt-0 text-muted "> <?php echo (!empty($order['size'])) ? 'Size: ' . $order['size'] : ""; ?> </h6>
                                <h6 class="pt-0 text-muted"> <?php echo 'Color: ' . $order['color']; ?></h6>
                                <h6 class="pt-0">Placed on:  <?php $time = strtotime($order['ordered_at']);echo date("F j,Y", $time); ?> </h6>
                                <h6 class="pt-0 text-muted"><?php echo ' delivery time:' . $productId['shipping_time']; ?> </h6>
                                <h6 class="pt-0 text-muted"> <?php echo '₦' . $productId['price']; ?> x <?php echo $order['quantity'] ?></h6>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            <?php endforeach ?>
        <?php } else { ?>
            <div class="col-md-12 text-uppercase text-weight-bold text-muted text-center" style="padding-top:300px;padding-bottom:300px;">
                <h2 style="font-size:100px;"> <i class="fad fa-shopping-cart"></i> </h2>
                <h1 class="text-uppercase text-weight-bold text-muted text-center" style="font-size:50px; opacity:0.4;">No orders yet</h1>

                <a href="<?php echo ROOT_URL ?>" class="btn btn-warning btn-lg w-75 text-white">start Shopping</a>
            </div>

        <?php } ?>

    </div>
    <div class="footer stiky-buttom">
        <?php require('inc/footer.php'); ?>

    </div>
</body>

</html>
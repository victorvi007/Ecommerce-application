<?php
require('config/db.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location:' . ROOT_URL . 'sellersLogin.php');
}

// $storeId = $_SESSION['store_id']['store_id'];
$product_id = $_GET['route'];




if (isset($_POST['pending'])) {
    $pendingQuery = "UPDATE orders SET delivered =1 WHERE product_id ='$product_id' ";
    if (!mysqli_query($conn, $pendingQuery)) {
        echo mysqli_error($conn);
    };
}
if (isset($_POST['delivered'])) {
    $deliveredQuery = "UPDATE orders SET delivered =0 WHERE product_id ='$product_id' ";
    mysqli_query($conn, $deliveredQuery);
}

$orderQuery = "SELECT * FROM orders WHERE product_id='$product_id'";
$orderResult = mysqli_query($conn, $orderQuery);
$orders = mysqli_fetch_assoc($orderResult);
// print_r($orders);
mysqli_free_result($orderResult);



$productQuery = "SELECT * FROM product_db WHERE product_Id='$product_id'";
$productResult = mysqli_query($conn, $productQuery);
$product = mysqli_fetch_assoc($productResult);
// print_r($orders);
mysqli_free_result($productResult);

$userEmail = $orders['email'];
// print_r($userEmail);
$userQuery = "SELECT * FROM users WHERE email='$userEmail'";
$userResult = mysqli_query($conn, $userQuery);
$user = mysqli_fetch_assoc($userResult);
// print_r($orders);
mysqli_free_result($userResult);

?>
<?php require('inc/header.php'); ?>
<style>
    #img {
        height: 300px;
        width: 300px;
    }

    #pending {
        border-left: 5px solid;
        border-color: #ffc107;
    }

    #delivered {

        border-left: 5px solid;
        border-color: #28a745;
    }

    a:hover {
        text-decoration: none;
    }
</style>

<body>

    <div class="row">
        <div class="col-md-2 col-12 m-0 p-0 shadow bg-light"><?php require('inc/sidebar.php'); ?></div>
        <div class="col-md-10">




            <div class="row shadow my-3 mx-1" id="<?php echo ($orders['delivered'] == 0) ? "pending" : "delivered"; ?>">
                <div class="col-md-12">
                    <div class="row">

                        <div class="col-md-6  ">
                            <img src="<?php echo ROOT_URL . 'sellershub/' . $product['product_image_A']; ?>" alt="<?php echo $product['product_name']; ?>" class="img-thumbnail img-fluid" id="img">
                        </div>

                        <div class="col-md-6 mt-5 text-right">

                            <h5 class="pt-0 pt-2 <?php echo ($orders['delivered'] == 0) ? "text-warning" : "text-success"; ?> ">Time Ordered: <?php $time = strtotime($orders['ordered_at']);echo date("F j,Y   g:i a", $time); ?></h5>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?route=<?php echo  $product_id ?>" method="POST">
                                <?php if ($orders['delivered'] == 0) { ?>
                                    <button type="submit" name="pending" class="btn btn-warning w-100 ">Pending</button>

                                <?php   } else { ?>
                                    <button type="submit" name="delivered" class=" btn btn-success w-100 ">Delivered</button>

                                <?php   } ?>

                            </form>
                        </div>
                    </div>

                </div>





                <div class=" col-12 text-info">
                    <div class="row my-2">
                        <div class="col-md-6">

                            <h3 class="pt-0 pt-2" style="border-bottom:2px solid;">Product</h3>
                            <h5 class="pt-0 pt-2 ">Product: <?php echo $product['product_name']; ?></h5>
                            <h6 class="pt-2">Store: <?php echo $orders['store_name'] ?> </h6>
                            <h6 class="pt-2">Store: <?php echo $orders['store_id'] ?> </h6>
                            <h6 class="pt-0 "> <?php echo (!empty($orders['size'])) ? 'Size:' . $orders['size'] : ""; ?> </h6>
                            <h6 class="pt-0"><?php echo 'Color:' . $orders['color']; ?></h6>
                            <h6 class="pt-0"> refrence Id: <?php echo $orders['reference_code']; ?> </h6>
                            <h6 class="pt-0"><?php echo ' delivery time:' . $product['shipping_time']; ?> </h6>
                            <h6 class="pt-0">quanitity: <?php echo '₦' . $product['price']; ?> x <?php echo $orders['quantity'] ?></h6>
                        </div>
                        <div class="col-md-6">
                            <h3 class="pt-0 pt-2" style="border-bottom:2px solid;">Customer</h3>
                            <h5 class="pt-0 pt-2 "><?php echo 'Costomer:' . $user['firstname'] . ' ' . $user['lastname']; ?></h5>
                            <h6 class="pt-2">Store: <?php echo $orders['store_name'] ?> </h6>
                            <h6 class="pt-2">Email: <?php echo $user['email'] ?> </h6>
                            <h6 class="pt-0"> Address: <?php echo $user['address'] ?> </h6>
                            <h6 class="pt-0 "> State: <?php echo $user['_state'] ?></h6>
                            <h6 class="pt-0 ">Country: <?php echo $user['country'] ?></h6>
                            <h6 class="pt-0"> Phone number: <?php echo $user['phone_number']; ?> </h6>
                            <h6 class="pt-0"><?php echo 'Extra details:' . ' ' . $orders['extrainfo']; ?> </h6>
                            <h6 class="pt-0"> <?php echo 'Nearest Landmark:' . ' ' . $orders['busstop']; ?> </h6>
                        </div>
                    </div>

                </div>


            </div>


            <!-- <div class="row">
                <div class="col md-3"></div>
                <div class="col md-3"></div>
                <div class="col md-3"></div>
                <div class="col md-3"></div>
            </div> -->


        </div>

    </div>




</body>

</html>
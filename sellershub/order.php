<?php
require('config/db.php');
session_start();
if (!isset($_SESSION['store_id'])) {
    header("Location: ../sellersLogin.php");
}

// $viewQuery = "SELECT * FROM mail_system WHERE id='$mail_id' ";
// $result = mysqli_query($conn, $viewQuery);
// $content = mysqli_fetch_assoc($result);
// mysqli_free_result($result);

$storeId = $_SESSION['store_id'];

$orderQuery = "SELECT * FROM orders WHERE store_id='$storeId' ORDER BY ordered_at DESC";
$orderResult = mysqli_query($conn, $orderQuery);
$orders = mysqli_fetch_all($orderResult, MYSQLI_ASSOC);
// print_r($orders);
mysqli_free_result($orderResult);

?>
<?php require('inc/header.php'); ?>
<style>
    #img {
        height: 200px;
        width: 400px;
    }

    #pending {
        border-left: 10px solid;
        border-color: #ffc107;
    }

    #delivered {

        border-left: 10px solid;
        border-color: #28a745;
    }

    a:hover {
        text-decoration: none;
        color: #17a2b8 !important;


    }
</style>

<body>

    <div class="row">
        <div class="col-md-2 col-12 m-0 p-0 shadow bg-light"><?php require('inc/sidebar.php'); ?></div>
        <div class="col-md-10">
            <?php foreach ($orders as $order) :; ?>

                <?php
                $orderProductId = $order['product_id'];
                $productQuery = "SELECT * FROM product_db WHERE product_id = '$orderProductId' ";
                $productResult = mysqli_query($conn, $productQuery);
                $productId = mysqli_fetch_assoc($productResult);
                mysqli_free_result($productResult);

                ?>

                <div class="row">
                    <div class="col-md-10">
                        <a href="orderView.php?route=<?php echo $order['reference_code']; ?>" class="border text-info">

                            <div class="row border bg-white my-3 mx-1" id="<?php echo ($order['delivered'] == 0) ? "pending" : "delivered"; ?>">
                                <div class="col-4  m-0 p-0 text-center border">
                                    <img src="<?php echo ROOT_URL . 'sellershub/' . $productId['product_image_A']; ?>" alt="<?php echo $productId['product_name']; ?>" class="img-thumbnail img-fluid" id="img">
                                </div>

                                <div class=" col-8">
                                    <h3 class="pt-0 pt-2 "><?php echo $productId['product_name']; ?></h3>
                                    <h6 class="pt-0"> Ordered at <?php echo $order['ordered_at']; ?> </h6>
                                    <h6 class="pt-0 "><?php echo ' delivery time:' . $productId['shipping_time']; ?> </h6>
                                    <h6 class="pt-0 text-right text-lg <?php echo ($order['new'] == 0) ? "text-warning p-2" : "text-success"; ?>"> <?php echo ($order['new'] == 0) ? " <i class='fas fa-check'></i> " : "<i class='fas fa-check-double'></i>"; ?> </h6>
                                    <h6 class="pt-0 text-right text-lg <?php echo ($order['delivered'] == 0) ? "text-warning" : "text-success"; ?>"> <?php echo ($order['delivered'] == 0) ? "pending" : "delivered"; ?> </h6>
                                </div>


                            </div>
                        </a>

                    </div>
                </div>

                <!-- <div class="row">
                <div class="col md-3"></div>
                <div class="col md-3"></div>
                <div class="col md-3"></div>
                <div class="col md-3"></div>
            </div> -->


            <?php endforeach ?>
        </div>

    </div>




</body>

</html>
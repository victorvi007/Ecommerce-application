<?php
require('config/db.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location:'.ROOT_URL.'sellersLogin.php');
}
// $storeId = $_SESSION['store_id']['store_id'];
// print_r($storeId);
$orderQuery = "SELECT * FROM orders";
$orderResult = mysqli_query($conn, $orderQuery);
$orders = mysqli_fetch_all($orderResult, MYSQLI_ASSOC);
mysqli_free_result($orderResult);



$seenQuery = "SELECT * FROM orders";
$seenResult = mysqli_query($conn, $seenQuery);
$seen = mysqli_fetch_all($seenResult, MYSQLI_ASSOC);
mysqli_free_result($seenResult);

$mailQuery = "SELECT * FROM admin_mail";
$mailResult = mysqli_query($conn, $mailQuery);
$mails = mysqli_fetch_all($mailResult, MYSQLI_ASSOC);
mysqli_free_result($mailResult);





$mailvalue = "";
$mailArray = [];
foreach ($mails as $mail) :;
    $mailvalue = $mail['action'];
    if ($mailvalue == 0) {
        array_push($mailArray, $mailvalue);
    }
endforeach;

$value = "";
$valueArray = [];
foreach ($orders as $seen) :;
    $value = $seen['new'];
    if ($value == 0) {
        array_push($valueArray, $value);
    }
endforeach;
// print_r($valueArray);

$sales = "";
$salesArray = [];
foreach ($orders as $seen) :;
    $sales = $seen['delivered'];
    if ($sales == 1) {
        array_push($salesArray, $sales);
    }
endforeach;
// print_r($salesArray);


?>
<?php require('inc/header.php'); ?>

<div class="row">
    <div class="col-md-2 col-12 m-0 p-0 shadow bg-light"><?php require('inc/sidebar.php'); ?></div>
    <div class="col-md-10 m-0 p-0">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">

                    <div class="conatiner ml-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container text-info my-5">
                                    <h3> <strong> WELCOME, Admin <?php //echo  $_SESSION['store_name']['store_name']; 
                                                            ?> </strong> </h3>
                                    <h5>Here's what happening with your store today </h5>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row bg-white text-info">
                            <div class="container">

                            </div>
                            <div class="col-md-4 border p-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2><i class="fas fa-usd-circle"></i></h2>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12"> <strong> <span class="badge bg-info text-white"><?php echo count($salesArray); ?></span> Total sales made</div> </strong>

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4 border p-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2> <i class="fas fa-cart-arrow-down"></i> </h2>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12"> <strong> <span class="badge bg-info text-white"> <?php echo count($valueArray); ?> </span> New Orders Yet </strong> </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-4 border p-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2> <i class="fad fa-mail-bulk"></i> </h2>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12"> <strong> <span class="badge bg-info text-white"><?php echo count($mailArray); ?></span> Mails </strong> </div>

                                    </div>
                                </div>

                            </div>
                        </div> -->
                        <div class="row bg-white text-info">
                            <div class="container">

                            </div>
                            <div class="col-md-4 border p-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2><i class="fas fa-usd-circle"></i></h2>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12"> <strong> <span class="badge bg-info text-white"><?php echo count($salesArray); ?></span> Total sales made</div> </strong>

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4 border p-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2> <i class="fas fa-cart-arrow-down"></i> </h2>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12"> <strong> <span class="badge bg-info text-white"> <?php echo count($orders); ?> </span> Total Orders made </strong> </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-4 border p-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2> <i class="fad fa-mail-bulk"></i> </h2>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12"> <strong> <span class="badge bg-info text-white"><?php echo count($mailArray); ?></span> Mails </strong> </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>


<script>

</script>
</div>

</body>

</html>
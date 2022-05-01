<?php
session_start();
require('config/db.php');

if (!isset($_SESSION['store_id'])) {
    header("Location: ../sellersLogin.php");
}
$store_id = $_SESSION['store_id'];

$query = "SELECT * FROM product_db WHERE store_id ='$store_id' ORDER BY added_at DESC";

$result = mysqli_query($conn, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);

?>
<?php require('inc/header.php'); ?>

<div class="row">
    <div class="col-md-2 col-12 m-0 p-0 shadow bg-light"><?php require('inc/sidebar.php'); ?></div>
    <div class="col-md-10 m-0 p-0">
        <div class="product_list">
            <div class="row m-2 bg-info text-white text-center" style="border-radius:5px 5px 0px 0px;">
                <div class="col-md-1 col-4 ">image</div>
                <div class="col-md-6 col-4">Product</div>
                <div class="col-md-1  d-none d-md-block d-lg-block">Inventory</div>
                <div class="col-md-2 col-4">Catalogy</div>
                <div class="col-md-2  d-none d-md-block d-lg-block">Product Id</div>
            </div>
            <?php foreach ($products as $product) :; ?>

                <div class="row m-2 border bg- text-center">
                    <div class="col-md-1 col-4 bg-light text-dark"> <img src="<?php echo $product['product_image_A']; ?>" alt="" class="img-thumbnail img-fluid"> </div>
                    <div class="col-md-6 col-4 bg-light text-dark"> <a href="<?php echo ROOT_URL ?>sellershub/viewProduct.php?route=<?php echo $product['product_Id'] ?>"> <?php echo $product['product_name']; ?> </a> </div>
                    <div class="col-md-1  bg-light text-dark d-none d-md-block d-lg-block"><?php echo $product['total_quantity']; ?></div>
                    <div class="col-md-2 col-4 bg-light text-dark"><?php echo $product['category']; ?></div>
                    <div class="col-md-2  bg-light text-dark d-none d-md-block d-lg-block"><?php echo $product['product_Id']; ?></div>
                </div>
            <?php endforeach ?>

        </div>

    </div>

</div>


<script>

</script>
</div>

</body>

</html>
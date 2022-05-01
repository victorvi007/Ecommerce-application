<?php
require('config/db.php');
session_start();
if (!isset($_SESSION['store_id'])) {
    header("Location: ../sellersLogin.php");
}

$productIdUrl = $_GET['route'];

$editQuery = "SELECT * FROM product_db WHERE product_id = '$productIdUrl'";
$editResult = mysqli_query($conn, $editQuery);
$edit = mysqli_fetch_assoc($editResult);
mysqli_free_result($editResult);

$sizeEditQuery = "SELECT * FROM size WHERE product_id = '$productIdUrl'";
$sizeEditResult = mysqli_query($conn, $sizeEditQuery);
$sizeEdit = mysqli_fetch_assoc($sizeEditResult);
mysqli_free_result($sizeEditResult);



$colorEditQuery = "SELECT * FROM color WHERE product_id = '$productIdUrl'";
$colorEditResult = mysqli_query($conn, $colorEditQuery);
$colorEdit = mysqli_fetch_assoc($colorEditResult);
mysqli_free_result($colorEditResult);

$QuantityEditQuery = "SELECT * FROM quantity WHERE product_id = '$productIdUrl'";
$QuantityEditResult = mysqli_query($conn, $QuantityEditQuery);
$quantityEdit = mysqli_fetch_assoc($QuantityEditResult);
mysqli_free_result($QuantityEditResult);
mysqli_close($conn);


?>
<?php require('inc/header.php'); ?>

<div class="row">
    <div class="col-md-2 col-12 m-0 p-0 shadow bg-light"><?php require('inc/sidebar.php'); ?></div>
    <div class="col-md-10 m-0 p-0">
        <div class="container-fluid pb-5 bg-light">
            <div class="row">
                <div class="col-md-9 col-12 m-0">
                    <div class="row">
                        <div class="col-md-12 my-3">
                            <h4 class="title text-center text-info"> <i class="fab fa-product-hunt bg-light"></i>roduct</h4>

                        </div>
                    </div>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div class=" form-group text-right">
                            <a href="<?php echo ROOT_URL ?>sellershub/editProduct?route=<?php echo $productIdUrl ?>" class="btn btn-info px-5" name="addProduct"> <i class="fal fa-edit"></i> Edit Product </a>
                        </div>


                        <div class="form-group my-2 p-2">
                            <label for="">Category</label>
                            <h5 class="category p-1 form-control" name="category"> <?php echo str_replace('-', ' & ', str_replace('', '', $edit['category'])); ?> </h5>
                        </div>

                        <div class="form-container card bg-white p-1">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <h5 type="text" name="title" id="title" class="form-control"> <?php echo $edit['product_name']; ?> </h5>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <h5 name="description" id="description" class="card p-1"> <?php echo $edit['product_description']; ?> </h5>
                            </div>
                        </div>
                        <div class="form-container card bg-white p-1">

                            <label for="">Upload images </label>
                            <div class="row">
                                <div class="col-md-4  text-center" id="labelImage1">
                                    
                                    <label for="image1" class="img-label-1">
                                        <img src="<?php echo ROOT_URL ?>sellershub/<?php echo $edit['product_image_A']; ?>" alt="" id="preview-a" class="img-thumbnail p-1">
                                    </label>
                                    <input type="file" name="image1" id="image1" class="form-control-file" accept="image/*">
                                </div>
                                
                                <div class="col-md-4 text-center" id="labelImage2">

                                    <label for="image2" class="img-label-2 ">
                                        <img src="<?php echo ROOT_URL ?>sellershub/<?php echo $edit['product_image_B']; ?>" alt="" id="preview-b" class="img-thumbnail p-1">
                                    </label>

                                    <input type="file" name="image2" id="image2" class="form-control-file" accept="image/*">
                                </div>
                                <div class="col-md-4  text-center" id="labelImage3">

                                    <label for="image3" class="img-label-3">

                                        <img src="<?php echo ROOT_URL ?>sellershub/<?php echo $edit['product_image_C']; ?>" alt="" id="preview-c" class="img-thumbnail p-1">
                                    </label>

                                    <input type="file" name="image3" id="image3" class="form-control-file" accept="image/*">
                                </div>
                            </div>

                        </div>
                        <div class="form-container card bg-white p-1">

                            <h6 for="">Pricing</h6>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <h5 type="number" name="main_price" id="mainPrice" class="form-control"> <?php echo $edit['price']; ?> </h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Compare Price</label>
                                        <h5 type="number" name="compare_at_price" id="compare_at_price" class="form-control"> <?php echo $edit['compare_price']; ?> </h5>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-container card bg-white p-1">
                            <h6>Shipping:</h6>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="quantity">Shipping Fee</label>
                                        <h5 type="number" name="shipping_fee" id="shippingFee" class="form-control"> <?php echo $edit['shipping_fee']; ?> </h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="quantity">Shipping time</label>
                                        <h5 type="time" name="shipping_time" id="shippingTime" class="form-control"> <?php echo $edit['shipping_time']; ?> </h5>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="form-container card bg-white p-2" id="container">
                            <h6>Inventory:</h6>
                            <div class="form-group form-inline">
                                <label for="quantity">Total quantity:</label>
                                <h5 type="text" name="total_quantity" id="totalQuantity" class="form-control "> <?php echo $edit['total_quantity']; ?> </h5>
                            </div>
                            <div class="row mx-1 my-1">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 col-4 bg-info text-white">Size</div>
                                        <div class="col-md-4 col-4 bg-info text-white">Color</div>
                                        <div class="col-md-4 col-4 bg-info text-white">Quantity</div>
                                    </div>
                                </div>

                            </div>
                            <div class="variation">
                                <div class="row my-3 " id="row1">
                                    <div class="col-md-4 col-4">
                                        <h5 type="text" name="size1" id="size1" class="form-control" placeholder="size"> <?php echo (isset($sizeEdit['size1'])) ? $sizeEdit['size1'] : "empty" ?> </h5>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <h5 type="text" name="color1" id="color1" class="form-control" placeholder="color"> <?php echo (isset($colorEdit['color1'])) ? $colorEdit['color1'] : "empty" ?> </h5>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <h5 type="number" min="0" name="quantity1" id="quantity1" step="1" class="form-control" placeholder="quantity"><?php echo (isset($quantityEdit['quantity1'])) ? $quantityEdit['quantity1'] : "empty" ?> </h5>
                                    </div>
                                </div>

                                <div class="row my-3 " id="row2">
                                    <div class="col-md-4 col-4">
                                        <h5 type="text" name="size2" id="size2" class="form-control" placeholder="size"> <?php echo (isset($sizeEdit['size2'])) ? $sizeEdit['size2'] : "empty" ?></h5>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <h5 type="text" name="color2" id="color2" class="form-control" placeholder="color"><?php echo (isset($colorEdit['color2'])) ? $colorEdit['color2'] : "empty" ?> </h5>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <h5 type="number" min="0" name="quantity2" id="quantity2" step="1" class="form-control" placeholder="quantity"> <?php echo (isset($quantityEdit['quantity2'])) ? $quantityEdit['quantity2'] : "empty" ?> </h5>
                                    </div>
                                </div>

                                <div class="row my-3 " id="row3">
                                    <div class="col-md-4 col-4">
                                        <h5 type="text" name="size3" id="size3" class="form-control" placeholder="size"> <?php echo (isset($sizeEdit['size3'])) ? $sizeEdit['size3'] : "empty" ?></h5>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <h5 type="text" name="color3" id="color3" class="form-control" placeholder="color"><?php echo (isset($colorEdit['color3'])) ? $colorEdit['color3'] : "empty" ?></h5>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <h5 type="number" min="0" name="quantity3" id="quantity3" step="1" class="form-control" placeholder="quantity"><?php echo (isset($quantityEdit['quantity3'])) ? $quantityEdit['quantity3'] : "empty" ?> </h5>
                                    </div>
                                </div>

                                <div class="row my-3 " id="row4">
                                    <div class="col-md-4 col-4">
                                        <h5 type="text" name="size4" id="size4" class="form-control" placeholder="size"> <?php echo (isset($sizeEdit['size4'])) ? $sizeEdit['size4'] : "empty"; ?></h5>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <h5 type="text" name="color4" id="color4" class="form-control" placeholder="color"><?php echo (isset($colorEdit['color4'])) ? $colorEdit['color4'] : "empty" ?></h5>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <h5 type="number" min="0" name="quantity4" id="quantity4" step="1" class="form-control" placeholder="quantity"><?php echo (isset($quantityEdit['quantity4'])) ? $quantityEdit['quantity4'] : "empty"; ?> </h5>
                                    </div>
                                </div>

                                <div class="row my-3 " id="row5">
                                    <div class="col-md-4 col-4">
                                        <h5 type="text" name="size5" id="size5" class="form-control" placeholder="size"> <?php echo (isset($sizeEdit['size5'])) ? $sizeEdit['size5'] : "empty"; ?></h5>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <h5 type="text" name="color5" id="color5" class="form-control" placeholder="color"><?php echo (isset($colorEdit['color5'])) ? $colorEdit['color5'] : "empty"; ?></h5>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <h5 type="number" min="0" name="quantity5" id="quantity5" step="1" class="form-control" placeholder="quantity"><?php echo (isset($quantityEdit['quantity5'])) ? $quantityEdit['quantity5'] : "empty" ?> </h5>
                                    </div>
                                </div>

                                <div class="row my-3 " id="row6">
                                    <div class="col-md-4 col-4">
                                        <h5 type="text" name="size6" id="size6" class="form-control" placeholder="size"> <?php echo (isset($sizeEdit['size6'])) ? $sizeEdit['size6'] : "empty" ?></h5>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <h5 type="text" name="color6" id="color6" class="form-control" placeholder="color"><?php echo (isset($colorEdit['color6'])) ? $colorEdit['color6'] : "empty"; ?></h5>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <h5 type="number" min="0" name="quantity6" id="quantity6" step="1" class="form-control" placeholder="quantity"><?php echo (isset($quantityEdit['quantity6'])) ? $quantityEdit['quantity6'] : "empty" ?> </h5>
                                    </div>
                                </div>
                            </div>



                        </div>


                </div>
                <div class="col-md-3 col-12 p-0 m-0 border">


                    </form>
                </div>


            </div>

        </div>

    </div>

</div>


<!-- <script type="text/javascript" src="<?php echo ROOT_URL ?>/sellershub/js/addProduct.js"></script> -->

</div>

</body>

</html>
<?php
require('config/db.php');
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location:' . ROOT_URL . 'sellersLogin.php');
}


// $store_id = $_SESSION['store_id']['store_id'];
// $store_name = $_SESSION['store_name']['store_name'];
$newDestination_1 = "";
$newDestination_2 = "";
$newDestination_3 = "";
$msg = "";
$msgClass = "";
if (isset($_POST['addProduct'])) {

    $category =$_POST['category'];
    $category = str_replace(', ','-', $category);
    $category = str_replace('\'','',$category);
     $category = str_replace(' & ','-',$category);
    $category = str_replace(' ','-',$category);

    // $category = str_replace(',','',$category);
    $title =   mysqli_real_escape_string($conn, $_POST['title']);
    $description =  mysqli_real_escape_string($conn, $_POST['description']);
    $image1 = $_FILES['image1'];
    $image2 = $_FILES['image2'];
    $image3 = $_FILES['image3'];
    $main_price =  mysqli_real_escape_string($conn, $_POST['main_price']);
    $compare_at_price = mysqli_real_escape_string($conn, $_POST['compare_at_price']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $shipping_fee =  mysqli_real_escape_string($conn, $_POST['shipping_fee']);
    $shipping_time = mysqli_real_escape_string($conn, $_POST['shipping_time']);
    $total_quantity =  mysqli_real_escape_string($conn, $_POST['total_quantity']);

    $color1 = htmlentities($_POST['color1']);
    $size1 =    htmlentities($_POST['size1']);
    $quantity1 =   htmlentities($_POST['quantity1']);

    $size2 =   htmlentities($_POST['size2']);
    $color2 = htmlentities($_POST['color2']);
    $quantity2 =   htmlentities($_POST['quantity2']);

    $size3 =    htmlentities($_POST['size3']);
    $color3 = htmlentities($_POST['color3']);
    $quantity3 =   htmlentities($_POST['quantity3']);

    $size4 =    htmlentities($_POST['size4']);
    $color4 = htmlentities($_POST['color4']);
    $quantity4 =   htmlentities($_POST['quantity4']);

    $size5 =    htmlentities($_POST['size5']);
    $color5 = htmlentities($_POST['color5']);
    $quantity5 =   htmlentities($_POST['quantity5']);

    $size6 =    htmlentities($_POST['size6']);
    $color6 = htmlentities($_POST['color6']);
    $quantity6 =   htmlentities($_POST['quantity6']);


    if (
        !empty($category) && !empty($title) && !empty($description) && !empty($image1) && !empty($image2) &&
        !empty($image3) && !empty($main_price) && !empty($compare_at_price) && !empty($quantity) && !empty($shipping_fee)
        && !empty($shipping_time) && !empty($total_quantity)
    ) {



        // $image1 = $FILES['image1'];
        // $image2 =  $FILES['image2'];
        // $image3 = $FILES['image3'];


        // print_r($file);
        $image1Name = $image1['name'];
        $image1Type = $image1['type'];
        $image1Temp = $image1['tmp_name'];
        $image1Error = $image1['error'];
        $image1Size = $image1['size'];


        $fileExp = explode('.', $image1Name);
        $fileActualExt = strtolower(end($fileExp));
        $allowed = ['jpg', 'jpeg', 'png'];
        if ($image1Error === 0) {
            if (in_array($fileActualExt, $allowed)) {
                if ($image1Size < 10000000) {
                    $newFileName = uniqid('shopBysteph', true) . "." . $fileActualExt;
                    $newDestination_1 = 'upload/' . $newFileName;
                    move_uploaded_file($image1Temp, $newDestination_1);
                } else {
                    $msg =  'file size must be less than 1mb in image 1';
                    $msgClass = 'alert-danger text-danger text-center m-1';
                }
            } else {
                $msg = 'file formart in not allowed';
                $msgClass = 'alert-danger text-danger text-center m-1';
            }
        } else {
            $msg = 'Pls try again';
            $msgClass = 'alert-danger text-danger text-center m-1';
        }
        $image3Name = $image3['name'];
        $image3Type = $image3['type'];
        $image3Temp = $image3['tmp_name'];
        $image3Error = $image3['error'];
        $image3Size = $image3['size'];


        $fileExp = explode('.', $image3Name);
        $fileActualExt = strtolower(end($fileExp));
        $allowed = ['jpg', 'jpeg', 'png'];
        if ($image3Error === 0) {
            if (in_array($fileActualExt, $allowed)) {
                if ($image3Size < 10000000) {
                    $newFileName = uniqid('shopBysteph', true) . "." . $fileActualExt;
                    $newDestination_3 = 'upload/' . $newFileName;
                    move_uploaded_file($image3Temp, $newDestination_3);
                } else {
                    $msg =  'file size must be less than 1mb in image 2';
                    $msgClass = 'alert-danger text-danger text-center m-1';
                }
            } else {
                $msg = 'file formart in not allowed';
                $msgClass = 'alert-danger text-danger text-center m-1';
            }
        } else {
            $msg = 'Pls try again';
            $msgClass = 'alert-danger text-danger text-center m-1';
        }
        $image2Name = $image2['name'];
        $image2Type = $image2['type'];
        $image2Temp = $image2['tmp_name'];
        $image2Error = $image2['error'];
        $image2Size = $image2['size'];


        $fileExp = explode('.', $image2Name);
        $fileActualExt = strtolower(end($fileExp));
        $allowed = ['jpg', 'jpeg', 'png'];
        if ($image2Error === 0) {
            if (in_array($fileActualExt, $allowed)) {
                if ($image2Size < 10000000) {
                    $newFileName = uniqid('shopBysteph', true) . "." . $fileActualExt;
                    $newDestination_2 = 'upload/' . $newFileName;
                    move_uploaded_file($image2Temp, $newDestination_2);
                } else {
                    $msg =  'file size must be less than 1mb in image 2';
                    $msgClass = 'alert-danger text-danger text-center m-1';
                }
            } else {
                $msg = 'file formart in not allowed';
                $msgClass = 'alert-danger text-danger text-center m-1';
            }
        } else {
            $msg = 'Pls try again';
            $msgClass = 'alert-danger text-danger text-center m-1';
        }


        $entittes = time() . '560ABCDEFGHIJKLMNOPQRSTUVWXY789Zabcdefghi1234jklmnopqrstuvwxyz';
        $entittesprocess =  uniqid($entittes);
        $processing =  str_shuffle($entittesprocess);
        $product_id_A = strtoupper(substr($processing, 0, 3));

        $entittes = time() . '560ABCDEFGHIJKLMNOPQRSTUVWXY789Zabcdefghi1234jklmnopqrstuvwxyz';
        $entittesprocess =  uniqid($entittes);
        $processing =  str_shuffle($entittesprocess);
        $product_id_B = strtoupper(substr($processing, 0, 3));

        $entittes = time() . '560ABCDEFGHIJKLMNOPQRSTUVWXY789Zabcdefghi1234jklmnopqrstuvwxyz';
        $entittesprocess =  uniqid($entittes);
        $processing =  str_shuffle($entittesprocess);
        $product_id_C  = strtoupper(substr($processing, 0, 3));

        $uniqueId = $product_id_A . '-' . $product_id_B . '-' . $product_id_C;

        $sizeQuery1 = "";
        $sizeQuery2 = "";
        $sizeQuery3 = "";
        $sizeQuery4 = "";
        $sizeQuery5 = "";
        $sizeQuery6 = "";

            $sizeQuery1 = "INSERT INTO size(product_id,size)VALUES('$uniqueId','$size1')";
            $sizeQuery2 = "INSERT INTO size(product_id,size)VALUES('$uniqueId','$size2')";
            $sizeQuery3 = "INSERT INTO size(product_id,size)VALUES('$uniqueId','$size3')";
            $sizeQuery4 = "INSERT INTO size(product_id,size)VALUES('$uniqueId','$size4')";
            $sizeQuery5 = "INSERT INTO size(product_id,size)VALUES('$uniqueId','$size5')";
            $sizeQuery6 = "INSERT INTO size(product_id,size)VALUES('$uniqueId','$size6')";


        $sizequeryArray = [$sizeQuery1, $sizeQuery2, $sizeQuery3, $sizeQuery4, $sizeQuery5, $sizeQuery6];

        foreach ($sizequeryArray as $sizequery) {
            if (mysqli_query($conn, $sizequery)) {
            } else {
                die(mysqli_error($conn));
            }
        }

        $colorQuery1 = "";
        $colorQuery12 = "";
        $colorQuery3 = "";
        $colorQuery4 = "";
        $colorQuery5 = "";
        $colorQuery6 = "";

            $colorQuery1 = "INSERT INTO color(product_id,color)VALUES('$uniqueId','$color1')";
            $colorQuery2 = "INSERT INTO color(product_id,color)VALUES('$uniqueId','$color2')";
            $colorQuery3 = "INSERT INTO color(product_id,color)VALUES('$uniqueId','$color3')";
            $colorQuery4 = "INSERT INTO color(product_id,color)VALUES('$uniqueId','$color4')";
            $colorQuery5 = "INSERT INTO color(product_id,color)VALUES('$uniqueId','$color5')";
            $colorQuery6 = "INSERT INTO color(product_id,color)VALUES('$uniqueId','$color6')";


        $colorqueryArray = [$colorQuery1, $colorQuery2, $colorQuery3, $colorQuery4, $colorQuery5, $colorQuery6];
        foreach ($colorqueryArray as $colorquery) {
            if (mysqli_query($conn, $colorquery)) {
            } else {
                die(mysqli_error($conn));
            }
        }

        $quantityQuery1 = "";
        $quantityQuery1 = "";
        $quantityQuery1 = "";
        $quantityQuery1 = "";
        $quantityQuery1 = "";
        $quantityQuery1 = "";

            $quantityQuery1 = "INSERT INTO quantity(product_id,quantity)VALUES('$uniqueId','$quantity1')";
            $quantityQuery2 = "INSERT INTO quantity(product_id,quantity)VALUES('$uniqueId','$quantity2')";
            $quantityQuery3 = "INSERT INTO quantity(product_id,quantity)VALUES('$uniqueId','$quantity3')";
            $quantityQuery4 = "INSERT INTO quantity(product_id,quantity)VALUES('$uniqueId','$quantity4')";
            $quantityQuery5 = "INSERT INTO quantity(product_id,quantity)VALUES('$uniqueId','$quantity5')";
            $quantityQuery6 = "INSERT INTO quantity(product_id,quantity)VALUES('$uniqueId','$quantity6')";



        $quantityQueryArray = [$quantityQuery1, $quantityQuery2, $quantityQuery3, $quantityQuery4, $quantityQuery5, $quantityQuery6];
        foreach ($quantityQueryArray as $quantityquery) {
            if (mysqli_query($conn, $quantityquery)) {
            } else {
                die(mysqli_error($conn));
            }
        }

        $mainquery = "INSERT INTO product_db(store_id,store_name,product_id,product_name,product_image_A,product_image_B,product_image_C,category,product_description,price,compare_price,shipping_fee,shipping_time,total_quantity)
                    VALUES('$store_id','$store_name','$uniqueId','$title','$newDestination_1','$newDestination_2','$newDestination_3','$category','$description','$main_price','$compare_at_price','$shipping_fee','$shipping_time','$total_quantity')";

        if (mysqli_query($conn, $mainquery)) {
            header('Location:index.php');
        } else {
            die(mysqli_error($conn));
        }
    } else {
        $msg = 'All details is required';
        $msgClass = 'alert-danger text-danger text-center m-1';
    }
}

$categoryQuery = "SELECT * FROM categories";
$category_result = mysqli_query($conn, $categoryQuery);
$db_categories = mysqli_fetch_all($category_result, MYSQLI_ASSOC);
mysqli_free_result($category_result);



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
                            <h4 class="title text-center text-info"> <i class="fad fa-layer-plus"></i> Add product</h4>

                        </div>
                    </div>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div class=" form-group text-right">
                            <button type="submit" class="btn btn-info px-5" name="addProduct"> <i class="fal fa-plus"></i> Add Product </button>
                        </div>
                        <?php if ($msg != "") : ?>
                            <div class="<?php echo $msgClass ?>"><?php echo $msg; ?></div>
                        <?php endif ?>
                        <div class="form-group my-2 p-2">
                            <label for="">Choose Catigory</label>
                            <select class="category p-1 form-control" name="category">
                                <option>--Catigories--</option>
                                <?php foreach ($db_categories as $category) :; ?>
                                    <option value="<?php echo $category['categories']; ?>"> <?php echo $category['categories']; ?> </option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class="form-container card bg-white p-1">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-container card bg-white p-1">

                            <label for="">Upload images </label>

                            <div class="row">
                                <div class="col-md-4  text-center" id="labelImage1">
                                    <label for="image1" class="img-label btn btn-info m-2"> <i class="fad fa-upload"></i>
                                        Upload
                                        images <span class="badge badge-light">1</span> </label>
                                    <input type="file" name="image1" id="image1" class="form-control-file" accept="image/*">
                                </div>
                                <div class="col-md-4  text-center" id="labelImage2">
                                    <label for="image2" class="img-label btn btn-info m-2"> <i class="fad fa-upload"></i>
                                        Upload
                                        images <span class="badge badge-light">2</span> </label>
                                    <input type="file" name="image2" id="image2" class="form-control-file" accept="image/*">
                                </div>
                                <div class="col-md-4  text-center" id="labelImage3">
                                    <label for="image3" class="img-label btn btn-info m-2"> <i class="fad fa-upload"></i>
                                        Upload
                                        images <span class="badge badge-light">3</span> </label>
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
                                        <input type="number" name="main_price" id="mainPrice" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Compare Price</label>
                                        <input type="number" name="compare_at_price" id="compare_at_price" class="form-control">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-container card bg-white p-1">
                            <h6>Inventory:</h6>
                            <div class="form-group form-inline">
                                <label for="quantity">Quantity:</label>
                                <input type="text" name="quantity" id="quantity" class="form-control">


                            </div>
                        </div>
                        <div class="form-container card bg-white p-1">
                            <h6>Shipping:</h6>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="quantity">Shipping Fee</label>
                                        <input type="number" name="shipping_fee" id="shippingFee" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="quantity">Shipping time</label>
                                        <input type="time" name="shipping_time" id="shippingTime" class="form-control">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="form-container card bg-white p-2" id="container">
                            <h6>Inventory:</h6>
                            <div class="form-group form-inline">
                                <label for="quantity">Total quantity:</label>
                                <input type="text" name="total_quantity" id="totalQuantity" class="form-control">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <button type="button" class="btn btn-info" id="addVariation" name=""> <i class="fal fa-plus"></i> Add Another Product
                                            Variation</button>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <button type="button" class="btn btn-info" id="removeVariation" name=""> <i class="fal fa-trash-alt"></i> Remove
                                            Variation</button>
                                    </div>
                                </div>


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

                                    <div class="col-md-4 col-4"><input type="text" name="size1" id="size1" class="form-control" placeholder="size">
                                    </div>
                                    <div class="col-md-4 col-4"><input type="text" name="color1" id="color1" class="form-control" placeholder="color"></div>
                                    <div class="col-md-4 col-4"><input type="number" min="0" name="quantity1" id="quantity1" step="1" class="form-control" placeholder="quantity"></div>
                                </div>
                                <div class="row my-3 " id="row2">
                                    <div class="col-md-4 col-4"><input type="text" name="size2" id="size2" class="form-control" placeholder="size"></div>
                                    <div class="col-md-4 col-4"><input type="text" name="color2" id="color2" class="form-control" placeholder="color"></div>
                                    <div class="col-md-4 col-4"><input type="number" min="0" name="quantity2" id="quantity2" step="1" class="form-control" placeholder="quantity"></div>
                                </div>
                                <div class="row my-3 " id="row3">

                                    <div class="col-md-4 col-4"><input type="text" name="size3" id="size3" class="form-control" placeholder="size">
                                    </div>
                                    <div class="col-md-4 col-4"><input type="text" name="color3" id="color3" class="form-control" placeholder="color"></div>
                                    <div class="col-md-4 col-4"><input type="number" min="0" name="quantity3" id="quantity3" step="1" class="form-control" placeholder="quantity"></div>
                                </div>
                                <div class="row my-3 " id="row4">

                                    <div class="col-md-4 col-4"><input type="text" name="size4" id="size4" class="form-control" placeholder="size">
                                    </div>
                                    <div class="col-md-4 col-4"><input type="text" name="color4" id="color4" class="form-control" placeholder="color"></div>
                                    <div class="col-md-4 col-4"><input type="number" min="0" name="quantity4" id="quantity4" step="1" class="form-control" placeholder="quantity"></div>
                                </div>
                                <div class="row my-3 " id="row5">

                                    <div class="col-md-4 col-4"><input type="text" name="size5" id="size5" class="form-control" placeholder="size">
                                    </div>
                                    <div class="col-md-4 col-4"><input type="text" name="color5" id="color5" class="form-control" placeholder="color"></div>
                                    <div class="col-md-4 col-4"><input type="number" min="0" name="quantity5" id="quantity5" step="1" class="form-control" placeholder="quantity"></div>
                                </div>
                                <div class="row my-3 " id="row6">

                                    <div class="col-md-4 col-4"><input type="text" name="size6" id="size6" class="form-control" placeholder="size">
                                    </div>
                                    <div class="col-md-4 col-4"><input type="text" name="color6" id="color6" class="form-control" placeholder="color"></div>
                                    <div class="col-md-4 col-4"><input type="number" min="0" name="quantity6" id="quantity6" step="1" class="form-control" placeholder="quantity"></div>
                                </div>
                            </div>



                        </div>


                </div>
                <div class="col-md-3 col-12 p-0 m-0 border">


                    </form>
                </div>


            </div>

        </div>
        <script>
            $(document).ready(function() {
                $('#image1').change(function() {
                    $("#labelImage1").append('<i class="fad fa-check-double text-success"></i>')
                })
                $('#image2').change(function() {
                    $("#labelImage2").append('<i class="fad fa-check-double text-success"></i>')
                })
                $('#image3').change(function() {
                    $("#labelImage3").append('<i class="fad fa-check-double text-success"></i>')
                })

            })




            // $('#row2').hide();
            // $('#row3').hide();
            // $('#row4').hide();
            // $('#row5').hide();
            // $('#row6').hide();
            // $('#addVariation').attr('onclick', 'showRow1()');
            // $('#removeVariation').attr('onclick', 'removeRow1()');

            // function showRow1() {
            //     $('#row2').show();
            //     // $('#addVariation').attr('onclick', 'showRow2()');
            //     // $('#removeVariation').attr('onclick', 'removeRow1()');

            // }

            // function showRow2() {
            //     $('#row3').show();
            //     // $('#addVariation').attr('onclick', 'showRow3()');
            //     // $('#removeVariation').attr('onclick', 'removeRow2()');


            // }

            // function showRow3() {
            //     $('#row4').show();
            //     // $('#addVariation').attr('onclick', 'showRow4()');
            //     // $('#removeVariation').attr('onclick', 'removeRow3()');


            // }

            // function showRow4() {
            //     $('#row5').show();
            //     // $('#addVariation').attr('onclick', 'showRow5()');
            //     // $('#removeVariation').attr('onclick', 'removeRow4()');


            // }

            // function showRow5() {
            //     $('#row6').show();
            //     // $('#addVariation').attr('onclick', 'showRow6()');
            //     // $('#removeVariation').attr('onclick', 'removeRow5()');


            // }


            // function removeRow1() {
            //     $('.variation.row').hide();

            // }

            // // function removeRow2() {
            // //     $('#row3').hide();

            // // }

            // // function removeRow3() {
            // //     $('#row4').hide();

            // // }

            // // function removeRow4() {
            // //     $('#row5').hide();

            // // }

            // // function removeRow5() {
            // //     $('#row6').hide();

            // }
        </script>
    </div>


</div>



</div>

</body>

</html>
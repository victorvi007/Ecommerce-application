<?php
require('config/db.php');
$userEmail;
$fullname;
$commenterEmail;
$row;

$colorlabel = 1;
$sizelabel = 1;

$colorinput = 1;
$sizeinput = 1;

$url = $_GET['url'];;

$query = "SELECT * FROM product_db WHERE url='$url'";
$result = mysqli_query($conn, $query);
$post = mysqli_fetch_assoc($result);
mysqli_free_result($result);

$product_id = $post['product_Id'];


$colorQuery = "SELECT color1,color2,color3,color4,color5,color6 FROM color WHERE product_Id = '$product_id'";
$color_result = mysqli_query($conn, $colorQuery);
$colors = mysqli_fetch_assoc($color_result);
mysqli_free_result($color_result);

$sizeQuery = "SELECT size1,size2,size3,size4,size5,size6 FROM size WHERE product_Id = '$product_id'";
$size_result = mysqli_query($conn, $sizeQuery);
$sizes = mysqli_fetch_assoc($size_result);
mysqli_free_result($size_result);

if (isset($_SESSION['user'])) {
    $userEmail = $_SESSION['user']['email'];
    $fullname = $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'];
    $commenterEmail = $_SESSION['user']['email'];



    $orderQuery = "SELECT * FROM orders WHERE product_id='$product_id' AND email='$userEmail'";
    $orderResult = mysqli_query($conn, $orderQuery);
    $row = mysqli_num_rows($orderResult);
};


if (isset($_POST['postFeedback'])) {
    $feedbackTitle = mysqli_real_escape_string($conn, $_POST['feedbackTitle']);
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);
    $star_rating = $_POST['rating'];
    // print_r($star_rating);
    $commentQuery = "INSERT INTO feedback(product_id,fullname,title,feedback,email,star_rating)VALUES('$product_id','$fullname','$feedbackTitle','$feedback','$commenterEmail','$star_rating')";
    if (mysqli_query($conn, $commentQuery)) {
        header('Location:' . ROOT_URL . 'product/' . $url);
    } else {
        echo mysqli_error($conn);
    }
}

$feedbackQuery = "SELECT * FROM feedback WHERE product_id='$product_id'";
$feedbackResult = mysqli_query($conn, $feedbackQuery);
$feedBacks = mysqli_fetch_all($feedbackResult, MYSQLI_ASSOC);
mysqli_free_result($feedbackResult);

$totalRating = count($feedBacks);

if ($totalRating < 2) {
    $totalRating = 1;
}


$feedbackStarQuery = "SELECT SUM(star_rating) FROM feedback WHERE product_id='$product_id'";
$feedbackStarResult = mysqli_query($conn, $feedbackStarQuery);
$feedBacksStar = mysqli_fetch_all($feedbackStarResult, MYSQLI_ASSOC);
mysqli_free_result($feedbackStarResult);


// print_r($feedBacksStar);
$star_rating_sum = $feedBacksStar[0]['SUM(star_rating)'];
$product_star_rating =  round($star_rating_sum / $totalRating);

$settingsQuery = "SELECT product_sidebar FROM settings";
$settingsResult = mysqli_query($conn, $settingsQuery);
$settings = mysqli_fetch_assoc($settingsResult);
mysqli_free_result($settingsResult);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['product_name']; ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../css/all.min.css" rel="stylesheet">

    <style>
        * {
            font-family: arial;
            /* font-family: Comic Sans MS; */
        }

        .img-fluid {
            height: 400px;
            width: 850px;
        }

        .img-mini {
            height: 50px;
            width: 50px;
            margin: 2px;
            padding: 1px;

        }

        .img-mini:hover {
            border: 1px solid red;
        }

        .radio {
            display: none;
            border-color: red;
        }


        .border-0 {
            display: none;
        }

        .labelsize {
            border-radius: 10px;
            border: 1px solid gray;
            color: black;
        }

        .labelsize:hover {
            border-radius: 10px;
            border: 1px solid #28a745;
            color: black;
        }

        /* .size {
            display: none;
        }

        .color {
            display: none;
        } */

        [type=radio] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .mr-1 {
            border-radius: 10px;
            border: 1px solid gray;
        }

        #color:hover {
            border: 1px solid #28a745;
            cursor: pointer;
        }


        .color:checked+label {
            border: 1px solid #28a745;
            background: #28a745;
            color: white;
        }

        .size:checked+label {
            border: 1px solid #28a745;
            background: #28a745;
            color: white;

        }


        .fab:hover {
            color: red;
        }

        .fab {
            color: black;
        }

        .screen {
            margin: 0px !important;
            background: white;
            cursor: default;
            border-radius: 0px;
            width: 50px;
            box-shadow: none !important;
            outline: none;
        }

        .addBtn {
            margin: 0px 0px !important;
            border-radius: 0px 5px 5px 0px;
        }

        .minusBtn {
            margin: 0px !important;
            border-radius: 5px 0px 0px 5px;
        }

        .star {
            font-size: 30px;

        }

        .star>label:hover {
            color: #ffc107;
            cursor: pointer;

        }

        .sidebar li {
            margin-top: 10px;
        }

        .sidebar ul {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php require('inc/navbar.php');


    ?>
    <div class="container">
        <!--Container BEGINS Row-->
        <div class="row  mt-4 mb-3">
            <!--Main Page BEGINS-->
            <div class="col-md-8">

                <!--ITEM CARD BEGINDS-->
                <div class="row shadow">
                    <!--Image CARD BEGINS-->
                    <div class="col-md-6">
                        <div class="product-img ">
                            <img alt="" class="img-fluid img-responsive" id="board"> </h5>
                        </div>
                        <hr>

                        <div class="text-center">
                            <div class="img-thubnail form-group p-0">
                                <label for="radio1">
                                    <img src=" <?php echo ROOT_URL . 'sellershub/' . $post['product_image_A']; ?> " alt="" class="img-mini" id="image1">
                                </label>
                                <input type="radio" id="radio1" name="radio" class="radio" value="img-1">
                                <label for="radio2">
                                    <img src=" <?php echo ROOT_URL . 'sellershub/' . $post['product_image_B']; ?> " alt="" class="img-mini" id="image2">
                                </label>
                                <input type="radio" id="radio2" name="radio" class="radio" value="img-2">
                                <label for="radio3">
                                    <img src=" <?php echo ROOT_URL . 'sellershub/' . $post['product_image_C']; ?> " alt="" class="img-mini" id="image3">
                                </label>
                                <input type="radio" id="radio3" name="radio" class="radio" value="img-3">
                            </div>
                            <div class="text-info">
                                <label for=""> Store:</label> <?php echo $post['store_name'] ?>
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('#board').attr('src', ' <?php echo ROOT_URL . 'sellershub/' . $post['product_image_A']; ?> ');

                                $('#image2').click(function() {
                                    $('#board').attr('src', ' <?php echo ROOT_URL . 'sellershub/' . $post['product_image_B']; ?>  ')
                                })
                                $('#image3').click(function() {
                                    $('#board').attr('src', ' <?php echo ROOT_URL . 'sellershub/' . $post['product_image_C']; ?> ')

                                })
                                $('#image1').click(function() {
                                    $('#board').attr('src', ' <?php echo ROOT_URL . 'sellershub/' . $post['product_image_A']; ?> ');


                                })
                            })
                        </script>

                    </div>
                    <!--IMAGE CARD ENDS -->
                    <!--Details CARD BEGINS-->
                    <div class="col-md-6">


                        <form action="<?php echo ROOT_URL ?>product/<?php echo $url ?>" method="POST" name="myform">
                            <div class="product-details text-center">
                                <h5 class="title text-center m-3"><?php echo $post['product_name']; ?></h5>

                                <!--STAR RATING BEGINS-->
                                <div class="rating">
                                    <?php if ($product_star_rating == 1) :; ?>
                                        <h6 class="text-muted">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </h6>
                                    <?php elseif ($product_star_rating == 2) :;  ?>
                                        <h6 class="text-muted">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <!-- <i class="fas fa-star"></i> -->
                                        </h6>
                                    <?php elseif ($product_star_rating == 3) :;  ?>
                                        <h6 class="text-muted">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>

                                        </h6>
                                    <?php elseif ($product_star_rating == 4) :;  ?>
                                        <h6 class="text-muted">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star"></i>
                                        </h6>
                                    <?php elseif ($product_star_rating == 5) :;  ?>
                                        <h6 class="text-muted">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </h6>

                                    <?php endif ?>
                                </div>
                                <!--STAR RATING BEGINS-->


                                <div class="product_price">
                                    <h3 class="current-price">₦<?Php echo $post['price']; ?> </h3>
                                    <h5 class="previous-price"> <del>₦ <?Php echo $post['compare_price']; ?> </del> </h5>

                                    <p class="text-info"> shipping:₦<?php echo $post['shipping_fee'] ?> </p>

                                </div>
                                <!--SHOW CASE BEGINS-->


                                <div class="colors">
                                    <h6>SELECT VARIATION</h6>

                                    <h6 id="warning" class="alert-danger text-danger">
                                        <?php ?>

                                    </h6>
                                    <?php foreach ($colors as $color) :; ?>
                                        <?php if ($color != "") { ?>
                                            <input type="radio" id="color<?php echo $colorinput++ ?>" value="<?php echo $color; ?>" name="color" class="color" required>
                                            <label for="color<?php echo $colorlabel++ ?>" class="mr-1 p-1" id="color"> <?php echo $color; ?> </label>
                                        <?php } else { ?>

                                        <?php } ?>
                                    <?php endforeach ?>

                                </div>
                                <!--SHOW CASE ENDS-->
                                <div class="sizes">
                                    <?php foreach ($sizes as $size) :; ?>
                                        <?php if ($size != "") { ?>
                                            <input type="radio" name="size" class="size" id="checkbox<?php echo $sizeinput++; ?>" value="<?php echo $size; ?>" required>
                                            <label for="checkbox<?php echo $sizelabel++; ?>" class="labelsize p-1 px-2"> <?php echo $size; ?> </label>
                                        <?php } else { ?>

                                        <?php } ?>
                                    <?php endforeach ?>
                                </div>
                                <div class="form-group text-center m-0">
                                    <button type="button" class="minusBtn btn btn-danger m-0" id="minusBtn"><i class="fas fa-minus"></i></button><input type="text" name="screen" id="screen" class="screen btn btn-default border text-dark" value="" minvalue="1" max="10"><button type="button" class="addBtn btn btn-success m-0" name="addBtn" id="addBtn"><i class="fas fa-plus"></i></button>
                                </div>


                                <hr>

                                <input type="hidden" value="<?php echo $post['product_Id']; ?>" name="product_id">
                                <button type="submit" class="btn btn-warning sm-3" name="add" id="addSubmitBtn"> Add to Cart <i class="fas fa-shopping-cart"></i> </button>
                                <button type="submit" class="btn btn-danger btn-lg" name="pay_button" id="buyNow">Buy Now</button>



                        </form>
                        <script>
                            $(document).ready(function() {


                                var addBtn = $('#addBtn');
                                var minusBtn = $('#minusBtn');
                                var screen = $('#screen');

                                var screenValue = 1;
                                screen.attr('value', screenValue);

                                addBtn.click(function() {
                                    screenValue = screenValue + 1;
                                    if (screenValue > 10) {
                                        screenValue = 10;
                                    } else {
                                        screen.attr('value', screenValue);

                                    }

                                })

                                minusBtn.click(function() {
                                    screenValue = screenValue - 1;
                                    if (screenValue < 1) {
                                        screenValue = 1
                                    } else {
                                        screen.attr('value', screenValue);

                                    }

                                })

                                var buyNow = $('#buyNow');
                                var valid = false;

                                var addSubmitBtn = $('#addSubmitBtn');
                                var singeColor = document.getElementsByClassName('color');
                                var singeSize = document.getElementsByClassName('size');
                                var color = document.myform.color;
                                // var size = document.myform.size;
                                var size = document.getElementsByName('size');
                                var xx = document.getElementById('checkbox1');
                                var yy = document.getElementById('color1');

                                console.log(xx);
                                console.log(yy);
                                console.log(singeColor.length);

                                valid = false;

                                buyNow.click(function() {

                                    if (singeColor.length == 1) {
                                        if (yy.checked == true) {
                                            console.log('color cliked')

                                        } else {
                                            alert('please select an option colorA');

                                        }
                                    }

                                    if (singeSize.length == 1) {
                                        if (xx.checked == true) {
                                            console.log('color cliked')

                                        } else {
                                            alert('please select an option SizeA');

                                        }
                                    }

                                    //COLOR///
                                    if (singeColor.length > 1) {
                                        var i;
                                        for (i = 0; i < color.length; i++) {
                                            if (color[i].checked == true) {
                                                // console.log(color[i]);
                                                valid = true;
                                                break;
                                            }
                                        }

                                        if (valid) {
                                            if (singeSize.length > 1) {

                                                var valid2 = false;
                                                var j;
                                                for (j = 0; j < size.length; j++) {
                                                    if (size[j].checked == true) {
                                                        // console.log(size[j]);
                                                        valid2 = true;
                                                        break;
                                                    }
                                                }
                                                if (valid2) {
                                                    console.log('hello');
                                                    console.log(size[j]);

                                                } else {
                                                    alert('please select an option size B');



                                                }
                                            }

                                        } else {
                                            alert('please select an option color B');
                                        }
                                    }

                                    // if (singeSize.length > 1) {



                                    // }


                                })

                                addSubmitBtn.click(function() {

                                    if (singeColor.length == 1) {
                                        if (yy.checked == true) {
                                            console.log('color cliked')

                                        } else {
                                            alert('please select an option');

                                        }
                                    }

                                    if (singeSize.length == 1) {
                                        if (xx.checked == true) {
                                            console.log('color cliked')

                                        } else {
                                            alert('please select an option');

                                        }
                                    }

                                    //COLOR///
                                    if (singeColor.length > 1) {
                                        var i;
                                        for (i = 0; i < color.length; i++) {
                                            if (color[i].checked == true) {
                                                // console.log(color[i]);
                                                valid = true;
                                                break;
                                            }
                                        }

                                        if (valid) {
                                            if (singeSize.length > 1) {
                                                var valid2 = false;
                                                var j;
                                                for (j = 0; j < size.length; j++) {
                                                    if (size[j].checked == true) {
                                                        // console.log(size[j]);
                                                        valid2 = true;
                                                        break;
                                                    }
                                                }
                                                if (valid2) {
                                                    console.log('hello');
                                                    console.log(size[j]);

                                                } else {
                                                    alert('please select an option');
                                                }
                                            }

                                        } else {
                                            alert('please select an option');
                                        }
                                    }

                                    // if (singeSize.length > 1) {


                                    // }


                                })

                            })
                        </script>
                        <hr>
                        <div class="container">
                            <h5>Share this product</h5>
                            <h5>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo ROOT_URL . 'product/' . $url; ?>" target="_blank"><i class=" fab fa-facebook m-2"></i></a>
                                <a href="whatsapp://send?text=<?php echo ROOT_URL . 'product/' . $url; ?>" data-action="share/whatsapp/share"><i class=" fab fa-whatsapp m-2"></i></a>
                                <a href="https://www.linkedin.com/shareArticle?url=<?php echo ROOT_URL . 'product/' . $url; ?>&title=<?php echo $post['product_name']; ?>" target="_blank"><i class="fab fa-linkedin m-2"></i></a>
                                <a href="https://twitter.com/share?url=<?php echo ROOT_URL . 'product/' . $url; ?>&text=<?php echo $post['product_name']; ?>&via=<?php echo $settings['website_name'] ?>" target="_blank"><i class="fab fa-twitter m-2"></i></a>
                            </h5>
                        </div>
                    </div>

                </div>
                <!--DETAIL CARD ENDS-->



                <div class="container-fluid">
                    <div class="row mt-5 mb-3 m-0">
                        <!--MAIN COL 2 BEGINS-->
                        <div class="col-md-12">
                            <div class="wrapper">
                                <div class="card">
                                    <div class="product-details">
                                        <div class="panel">
                                            <div class="panel-head border text-center">
                                                <h3>Product details</h3>
                                            </div>

                                            <div class="panel-body p-3">
                                                <h4>Features:</h4>
                                                <p>
                                                    <?php echo $post['product_description']; ?>
                                                </p>
                                            </div>


                                        </div>


                                    </div>
                                </div>

                            </div>

                            <?php foreach ($feedBacks as $feedBack) :; ?>
                                <div class="col-md-12 mt-5 p-1 ">
                                    <!-- <h6 class="text-muted"></h6> -->
                                    <blockquote class="blockquote bg-light card">
                                        <h5 class="m-2"><?php echo $feedBack['title'] ?></h5>

                                        <i>
                                            <div class="col-md-12 my-2 text-dark">
                                                <?php if ($feedBack['star_rating'] == 1) :; ?>
                                                    <h6 class="text-muted text-right">
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </h6>
                                                <?php elseif ($feedBack['star_rating'] == 2) :;  ?>
                                                    <h6 class="text-muted text-right">
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </h6>
                                                <?php elseif ($feedBack['star_rating'] == 3) :;  ?>
                                                    <h6 class="text-muted text-right">
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </h6>
                                                <?php elseif ($feedBack['star_rating'] == 4) :;  ?>
                                                    <h6 class="text-muted text-right">
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-startext-warning"></i>
                                                        <i class="fas fa-star"></i>
                                                    </h6>
                                                <?php elseif ($feedBack['star_rating'] == 5) :;  ?>
                                                    <h6 class="text-muted text-right">
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning text-warning"></i>
                                                        <i class="fas fa-star text-warning text-warning"></i>
                                                        <i class="fas fa-star text-warning text-warning"></i>
                                                    </h6>

                                                <?php endif ?>

                                                <p><?php echo $feedBack['feedback'] ?></p>
                                                <div class=" blockquote-footer text-muted"><?php echo $feedBack['fullname'] ?></div>
                                                <p class="text-right"><?php $time = strtotime($feedBack['added_at']);
                                                                        echo date("F j,Y,g:i a", $time); ?></p>


                                            </div>
                                        </i>
                                    </blockquote>

                                </div>
                            <?php endforeach; ?>
                            <?php if (isset($row)) :; ?>
                                <?php if ($row > 0) :; ?>



                                    <div class="col-md-12 mt-5 card ">
                                        <div class="comment-section mt-3 m-2">
                                            <form action="<?php echo ROOT_URL ?>product/<?php echo $url ?>" method="POST">
                                                <h5 class="text-center text-primary ">Rate your experience</h5>
                                                <div class="form-group text-center">
                                                    <div class="star">
                                                        <label for="rating-1" class='rating-1'><i class="fas fa-star"></i></label>
                                                        <input type="radio" id="rating-1" name="rating" value="1">

                                                        <label for="rating-2" class='rating-2'><i class="fas fa-star"></i></label>
                                                        <input type="radio" id="rating-2" name="rating" value="2">

                                                        <label for="rating-3" class='rating-3'><i class="fas fa-star"></i></label>
                                                        <input type="radio" id="rating-3" name="rating" value="3">

                                                        <label for="rating-4" class='rating-4'><i class="fas fa-star"></i></label>
                                                        <input type="radio" id="rating-4" name="rating" value="4">

                                                        <label for="rating-5" class='rating-5'><i class="fas fa-star"></i></label>
                                                        <input type="radio" id="rating-5" name="rating" value="5">
                                                        <!-- 
                                            <label for="rating-6" class='rating-6'><i class="fas fa-star"></i></label>
                                            <input type="radio" id="rating-6" name="rating" value="6"> -->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="feedbackTitle" id="feedbackTitle" placeholder="Title" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="feedback">Feedback:</label>
                                                    <textarea name="feedback" id="feedback" cols="30" rows="10" class="form-control" placeholder="" required></textarea>
                                                    <div class="form-group text-right mt-2">
                                                        <button name="postFeedback" id="" class="btn btn-primary px-5" type="submit">Post</button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <script>
                                $(document).ready(function() {

                                    var star1 = $('.rating-1');
                                    var star2 = $('.rating-2');
                                    var star3 = $('.rating-3');
                                    var star4 = $('.rating-4');
                                    var star5 = $('.rating-5');
                                    var star6 = $('.rating-6');

                                    star1.click(function() {
                                        star1.css('color', '#ffc108');
                                        $('.rating-2,.rating-3,.rating-4,.rating-5,.rating-6').css('color', '');
                                    })
                                    star2.click(function() {
                                        $('.rating-1,.rating-2').css('color', '#ffc108');
                                        $('.rating-3,.rating-4,.rating-5,.rating-6').css('color', 'black');
                                    })

                                    star3.click(function() {
                                        $('.rating-1,.rating-2,.rating-3').css('color', '#ffc108');
                                        $('.rating-4,.rating-5,.rating-6').css('color', 'black');
                                    })

                                    star4.click(function() {
                                        $('.rating-1,.rating-2,.rating-3,.rating-4').css('color', '#ffc108');
                                        $('.rating-5,.rating-6').css('color', 'black');
                                    })

                                    star5.click(function() {
                                        $('.rating-1,.rating-2,.rating-3,.rating-4,.rating-5').css('color', '#ffc108');
                                        // $('.rating-6').css('color', 'black');
                                    })

                                    // star6.click(function() {
                                    //     $('.rating-1,.rating-2,.rating-3,.rating-4,.rating-5,.rating-6').css('color', '#ffc108');

                                    // })


                                })
                            </script>

                        </div>

                        <script>

                        </script>
                        <!--MAIN COL 2 ENDS-->

                        <!--SIDEBAR 2 BEGINS-->
                        <!-- <div class="col-md-4 shadow">
                <div class="container">
                    <ul>
                        <li>Pay online using your Naira bank card.
                            Selected items below ₦2500 may be eligible for free economy postal shipping through
                            the local
                            postal provider, see details at checkout.</li>
                        <li>Pay for international delivery online and have no additional cost when your order
                            gets delivered
                            Delivery Information
                            Shipped from Abroad and normallsubmitvered between Wednesday 3 Jun and Wednesday 17
                            Jun. Please
                            check exact dates in the
                            Checkout page.</li>
                        <li>See more</li>
                        <li>Return Policy
                            Free return within 15 days for Jumia Mall items and 7 days for other
                            eligible items.See more</li>
                        <li>Warranty N/A</li>
                    </ul>
                </div>
                </div> -->
                        <!--SIDE BAR 2 ENDS-->
                    </div>



                </div>




            </div>
            <!--ITEM CARD ENDS-->
            <!--PRODUCT DETAIL CARD STARTS-->

            <!--PRODUCT DETAIL CARD ENDS HERE-->
            <!--PRODUCT SPECIFICATION-->

            <!--END OF PRODUCT SPECIFICATION-->
        </div>
        <!--Main Page ENDS-->
        <!--SIDE BAR-->
        <div class="col-md-4">
            <!--SIDE BAR 1-->
            <div class="sidebar container shadow p-2">
                <?php echo $settings['product_sidebar']; ?>
            </div>
            <!--SIDE BAR 1 ENDS-->
        </div>

    </div>
    <!--SIDE BAR ENDS-->
    <!--END OF Container Row -->

    <!--MAIN PAGE 2 BEGINS-->

    <!--MAIN PAGE 2 ENDS-->
    </div>
    <div class="footer">
        <?php require('inc/footer.php'); ?>

    </div>
</body>

</html>
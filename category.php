<?php
require('config/db.php');
require('inc/jumbotron.php');

?>

<?php
$reseve = $_GET['category'];
$query = "SELECT * FROM product_db WHERE category ='$reseve' ";
// print_r($query);
$result = mysqli_query($conn, $query);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <title>Category</title>
    <link rel="stylesheet" href=" <?php echo ROOT_URL ?>css/bootstrap.min.css">
    <link href="<?php echo ROOT_URL ?>css/all.min.css" rel="stylesheet">
    <link href="<?php echo ROOT_URL ?>css\style.css" rel="stylesheet">
    <style>
        /* .img-responsive {
            height: 300px;
        } */
    </style>
</head>

<?php require('inc/navbar.php'); ?>
<div class="container text-center">
    <div class="row text-center my-5">

        <?php if (count($posts) != 0) { ?>
            <?php foreach ($posts as $post) :; ?>

                <div class="col-md-3  col-12 my-md-0">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                        <div class="card shadow mt-1">
                            <div class="product-img">

                                <img src="<?php echo ROOT_URL . 'sellershub/' . $post['product_image_A']; ?>" alt="product" class="img-responsive img-thumbnail px-0 py-0" id="img">

                            </div>
                            <div class="card-body py-0">

                                <h6 class="card-title py-0"><?php echo $post['product_name']; ?> </h6>

                                <h6><span class="price">₦<?php echo $post['price']; ?> </span></h6>
                                <h6> <small><span class="price"> <del> ₦ <?php echo $post['compare_price']; ?></del> </span></h6> </small>

                                <h6>
                                    <small>
                                        <i class="fas fa-star text-warning"> </i>
                                        <i class="fas fa-star text-warning"> </i>
                                        <i class="fas fa-star text-warning"> </i>
                                        <i class="fas fa-star text-warning"> </i>
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    </small>
                                </h6>
                                <h6>
                                    <a href="<?php echo ROOT_URL ?>product/<?php echo $post['url']; ?>" class="btn btn-success"><i class="fas fa-info-circle"></i> Detail</a>

                                    <!-- <button type="submit" class="btn btn-success" name="details" value="<?php echo $post['id']; ?>"> </button> -->
                                </h6>
                                <input type="hidden" value="<?php echo $post['product_Id']; ?>" name="product_id">
                            </div>
                        </div>
                        <!-- <a href="<?php //echo ROOT_URL 
                                        ?>item/<?php echo $post['id']; ?>">TEST</a> -->

                    </form>

                </div>

            <?php endforeach; ?>
        <?php } else { ?>
            <div class="col-md-12 text-uppercase text-weight-bold text-muted text-center" style="padding-top:300px;padding-bottom:300px;">
                <h5 class="text-uppercase text-weight-bold text-muted text-center" style="font-size:50px; opacity:0.4;">this category is empty</h5>

            </div>

        <?php } ?>

    </div>

</div>

<div class="footer">
    <?php require('inc/footer.php'); ?>

</div>
</body>

</html>
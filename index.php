<?php
require('config/db.php');
if (!mysqli_connect_errno()) {

    $query = 'SELECT * FROM product_db ORDER BY added_at DESC';
    $result = mysqli_query($conn, $query);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
}


// print_r($feedBacksStar);
// print_r(uniqid());
// echo '<br>';
// print_r(time());
?>
<?php require('inc/jumbotron.php');
?>
<?php require('inc/navbar.php');
?>

<div class="container text-center pb-5">
    <div class="row text-center my-3">
        <?php foreach ($posts as $post) :; ?>
            <?php
            $product_id = $post['product_Id'];

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


            $star_rating_sum = $feedBacksStar[0]['SUM(star_rating)'];
            $product_star_rating =  round($star_rating_sum / $totalRating);
            ?>

            <div class="col-md-3  col-12">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                    <div class="card shadow mt-1  p-0">
                        <div class="product-img">
                            <img src="<?php echo ROOT_URL . 'sellershub/' . $post['product_image_A']; ?>" alt="product" class="img-responsive img-thumbnail px-0 py-0" id="img">
                        </div>
                        <div class="card-body py-0">

                            <h6 class="card-title p-1"><?php echo $post['product_name']; ?> </h6>

                            <h6><span class="price">₦<?php echo $post['price']; ?> </span></h6>
                            <h6> <small><span class="price"> <del> ₦ <?php echo $post['compare_price']; ?></del> </span></h6> </small>
                            <h6 class="rating">
                                <small>
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
                                            <!-- </h6>
                             
                                     
                                        <?php else : echo "<span class='text-danger'> Not rated </span>"; ?>
                                    <?php endif ?>
                                </small>
                            </h6>
                            <h6>
                                <a href="<?php echo ROOT_URL ?>product/<?php echo $post['url']; ?>" class="btn btn-success"><i class="fas fa-info-circle"></i> Detail</a>
                                <!-- <button type="submit" class="btn btn-success" name="details" value="<?php echo $post['id']; ?>"> </button> -->
                                        </h6>
                                        <input type="hidden" value="<?php echo $post['product_Id']; ?>" name="product_id">
                        </div>
                    </div>

                </form>

            </div>
        <?php endforeach; ?>

        <script>
            // window.print();
        </script>

    </div>
</div>
<div class="footer mt-5">
    <?php require('inc/footer.php'); ?>
</div>
</div>
</body>

</html>
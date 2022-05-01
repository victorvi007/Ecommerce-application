<?php require('config/db.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
</head>

<body>
    <?php
    require('inc/jumbotron.php');
    require('inc/navbar.php');
    ?>

    <div class="container-fluid">
        <div class="board m-4 mb-5">
            <div class="row bg-light card py-5">
                <div class="col-md-12">
                    <h1 class="text-center text-warning">Contact us</h1>
                </div>
                <div class="col-md-12">
                    <?php echo $settings['contact']; ?>
                </div>

            </div>

        </div>
    </div>

    <div class="footer">
        <?php require('inc/footer.php'); ?>
    </div>

</body>

</html>
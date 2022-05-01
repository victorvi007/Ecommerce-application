<?php
require('config/db.php');
$query = "SELECT * FROM sellers";
$result = mysqli_query($conn, $query);
$sellers = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>
<?php require('inc/header.php'); ?>

<div class="row">
    <div class="col-md-2 col-12 m-0 p-0 shadow bg-light"><?php require('inc/sidebar.php'); ?></div>
    <div class="col-md-10 m-0 p-0">
        <div class="container">
            <?php foreach ($sellers as $seller) :; ?>
                <div class="card shadow mt-2">
                    <div class="row">
                        <div class="col-12 mx-0">
                            <div class="row my-2  mx-0">
                                <div class="col-9 p-auto m-auto">
                                    <div class="row">
                                        <div class="col-md-12">Store Name:<?php echo $seller['business_name']; ?> </div>
                                        <div class="col-md-12">Store ID:<?php echo $seller['store_id']; ?> </div>
                                        <div class="col-md-12">Fullname:<?php echo $seller['firstname']; ?> <?php echo $seller['lastname']; ?> </div>
                                        <div class="col-md-12">Date Joined:<?php $time = strtotime($seller['date_registered']);echo date("F j,Y,g:i a", $time); ?> </div>
                                    </div>
                                </div>
                                <div class="col-3 p-auto m-auto text-right"> <a href="storeView.php?route=<?php echo $seller['store_id'] ?>" class="btn btn-primary">View</a> </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>


<script>

</script>
</div>

</body>

</html>
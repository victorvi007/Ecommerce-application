<?php
require('config/db.php');
$email = $_GET['route'];

$msg = "";
$msgClass = "";
if (isset($_POST['suspend'])) {
    $suspendQuery = "UPDATE user_login_details SET suspend_account = 1 WHERE emails='$email'";
    if (mysqli_query($conn, $suspendQuery)) {
    } else {
        mysqli_error($conn);
    }
}


if (isset($_POST['activate'])) {
    $ActivateQuery = "UPDATE  user_login_details SET suspend_account = 0 WHERE emails='$email'";
    if (mysqli_query($conn, $ActivateQuery)) {
    } else {
        mysqli_error($conn);
    }
}

$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
mysqli_free_result($result);

$accountQuery = "SELECT * FROM user_login_details WHERE emails='$email'";
$accountResult = mysqli_query($conn, $accountQuery);
$suspend_account = mysqli_fetch_assoc($accountResult);
mysqli_free_result($accountResult);


?>
<?php require('inc/header.php'); ?>

<div class="row">
    <div class="col-md-2 col-12 m-0 p-0 shadow bg-light"><?php require('inc/sidebar.php'); ?></div>
    <style>
        .col-md-12 {
            border: 1px solid #17a2b8;
            padding: 10px;
            margin-top: 5px;
        }
    </style>
    <div class="col-md-10 m-0 p-0">
        <div class="container mt-3">
            <div class="row">
                <div class="col-12 mx-0">
                    <div class="row my-2  mx-0">
                        <div class="col-12 p-auto m-auto">
                            <div class="row">
                                <div class="col-12">
                                    <form action="" method="POST">
                                        <div class="row">
                                            <div class="col-6 text-left">

                                            </div>
                                            <div class="col-6 text-right">

                                                <?php if ($suspend_account['suspend_account'] == 1) { ?>
                                                    <button type="submit" name="activate" class="btn btn-success w-100">activate Account</button>
                                                <?php } else { ?>
                                                    <button type="submit" name="suspend" class="btn btn-danger w-100">Suspend Account</button>

                                                <?php } ?>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- <div class="col-md-12  "><span>Store Name: </span><?php echo $seller['business_name']; ?> </div> -->
                                <div class="col-md-12  ">Email: <?php echo $user['email']; ?> </div>
                                <div class="col-md-12  ">Fullname: <?php echo $user['firstname']; ?> <?php echo $user['lastname']; ?> </div>
                                <div class="col-md-12  ">Postal code: <?php echo $user['postal_code'] ?> </div>
                                <div class="col-md-12  ">Phone Number: <?php echo $user['phone_number'] ?> </div>
                                <div class="col-md-12  ">Country: <?php echo $user['country'] ?> </div>
                                <div class="col-md-12  ">City: <?php echo $user['city'] ?> </div>
                                <div class="col-md-12  ">Address: <?php echo $user['address'] ?> </div>
                                <div class="col-md-12  ">Date Joined: <?php $time = strtotime($user['created_at']);echo date("F j,Y,g:i a", $time); ?></div>
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
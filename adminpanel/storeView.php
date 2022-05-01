<?php
require('config/db.php');
$seller_id = $_GET['route'];

$msg = "";
$msgClass = "";
if (isset($_POST['suspend'])) {
    $suspendQuery = "UPDATE sellers_login_details SET suspend_account =1 WHERE store_id='$seller_id'";
    if (mysqli_query($conn, $suspendQuery)) {
        $msg = "Account Suppended";
        $msgClass = "alert-danger text-danger p-1";
    } else {
        mysqli_error($conn);
    }
}


if (isset($_POST['activate'])) {
    $ActivateQuery = "UPDATE  sellers_login_details SET suspend_account = 0 WHERE store_id='$seller_id'";
    if (mysqli_query($conn, $ActivateQuery)) {
        $msg = "Account Activated";
        $msgClass = "alert-success text-white p-1";
    } else {
        mysqli_error($conn);
    }
}

$query = "SELECT * FROM sellers WHERE store_id='$seller_id'";
$result = mysqli_query($conn, $query);
$seller = mysqli_fetch_assoc($result);
mysqli_free_result($result);

$accountQuery = "SELECT * FROM sellers_login_details WHERE store_id='$seller_id'";
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
                                <div class="col-md-12  "><span>Store Name: </span><?php echo $seller['business_name']; ?> </div>
                                <div class="col-md-12  ">Store ID:<?php echo $seller['store_id']; ?> </div>
                                <div class="col-md-12  ">Fullname:<?php echo $seller['firstname']; ?> <?php echo $seller['lastname']; ?> </div>
                                <div class="col-md-12  ">Date of Birth:<?php echo $seller['date_of_birth'] ?> </div>
                                <div class="col-md-12  ">Phone Number:<?php echo $seller['phone'] ?> </div>
                                <div class="col-md-12  ">Personal Email:<?php echo $seller['email'] ?> </div>
                                <div class="col-md-12  ">Personal Address:<?php echo $seller['personal_address'] ?> </div>
                                <div class="col-md-12  ">Business Address:<?php echo $seller['business_address'] ?> </div>
                                <div class="col-md-12  ">Origin Address:<?php echo $seller['origin_address'] ?> </div>
                                <div class="col-md-12  ">Name of Person in Charge:<?php echo $seller['name_of_person_in_charge'] ?> </div>
                                <div class="col-md-12  ">Business Email:<?php echo $seller['business_email'] ?> </div>
                                <div class="col-md-12  ">Bank Name:<?php echo $seller['bank_name'] ?> </div>
                                <div class="col-md-12  ">Bank Code:<?php echo $seller['bank_code'] ?> </div>
                                <div class="col-md-12  ">Account Number:<?php echo $seller['account_number'] ?> </div>
                                <div class="col-md-12  ">BVN:<?php echo $seller['bvn'] ?> </div>
                                <div class="col-md-12">Date Joined:<?php $time = strtotime($seller['date_registered']);echo date("F j,Y,g:i a", $time); ?> </div>

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
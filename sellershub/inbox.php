<?php
require('config/db.php');
session_start();
if (!isset($_SESSION['store_id'])) {
    header("Location: ../sellersLogin.php");
}

?>
<?php require('inc/header.php');

$store_id = $_SESSION['store_name'];
$mailQuery = "SELECT * FROM mail_system ORDER BY added_at DESC";

$mailResult = mysqli_query($conn, $mailQuery);
$mails = mysqli_fetch_all($mailResult, MYSQLI_ASSOC);
mysqli_free_result($mailResult);
mysqli_close($conn);
?>
<style>
    .title {
        font-size: 70px;
    }

    a:hover {
        text-decoration: none;
    }

    #pending {
        color: #ffc107;
    }

    #delivered {
        color: #28a745;
    }
</style>
<div class="row">
    <div class="col-md-2 col-12 m-0 p-0 shadow bg-light"><?php require('inc/sidebar.php'); ?></div>
    <div class="col-md-10 m-0 p-0">
        <div class="container pt-2">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="title text-primary"> <span> <i class="fad fa-envelope-open"></i> </span> <b> Inbox </b> </h2>
                </div>
            </div>
            <?php foreach ($mails as $mail) :; ?>
                <div class="row card mt-2 p-3 btn-light">
                    <a href="read.php?mail=<?php echo $mail['id']; ?>">
                        <div class="col-md-12 text-info">
                            <h6>From: <span> <b>admin@website.com</b> </span> </h6>
                        </div>
                        <h6 class="text-right" id="<?php echo ($mail['action'] == 0) ? "pending" : "delivered"; ?>"> <?php echo ($mail['action'] == 0) ? "<i class='fas fa-check'></i> " : "<i class='fas fa-check-double'></i>"; ?> </h6>
                        <div class="col-md-12 text-primary">
                            <h6>Subject: <span> <b> <?php echo $mail['mail_subject']; ?> </b> </span> </h6>
                        </div>
                    </a>
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
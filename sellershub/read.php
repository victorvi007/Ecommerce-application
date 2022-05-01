<?php
require('config/db.php');
session_start();
if (!isset($_SESSION['store_id'])) {
    header('Location:' . ROOT_URL . 'sellersLogin.php');

}

$mail_id = $_GET['mail'];

if (!isset($mail_id)) {
    header('Location:'.ROOT_URL.'sellershub/');
}

$mailQuery = "UPDATE mail_system SET action=1 WHERE id='$mail_id'";
if(!mysqli_query($conn,$mailQuery)){
    echo mysqli_error($conn);
}

$viewQuery = "SELECT * FROM mail_system WHERE id='$mail_id' ";
$result = mysqli_query($conn, $viewQuery);
$content = mysqli_fetch_assoc($result);
mysqli_free_result($result);


?>
<?php require('inc/header.php'); ?>
<style>
    .readBody {
        background: #f0f0f0;
    }
</style>
<div class="row">
    <div class="col-md-2 col-12 m-0 p-0 shadow bg-light"><?php require('inc/sidebar.php'); ?></div>
    <div class="col-md-10 m-0 p-0">
        <div class="readBody container border my-5 p-5">
            <div class="row">
                <div class="col-md-12 card text-primary pt-2 mt-2">
                    <h5> To: <?php echo $_SESSION['store_name']['store_name']; ?> </h5>
                </div>
                <div class="col-md-12 text-primary pt-2 mt-2 card">
                    <h3>Subject: <?php echo $content['mail_subject'] ?> </h3>
                </div>

                <div class="col-md-12 py-5 card mt-2 mb-2 text-primary">
                    <div class="container">
                        <h5> <?php echo $content['mail']; ?> </h5>
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
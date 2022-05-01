<?php
require('config/db.php');

session_start();
if (!isset($_SESSION['store_id'])) {
    header("Location: ../sellersLogin.php");
}
$store_id = $_SESSION['store_id'];
$msg = "";
$msgClass = "";

if (isset($_POST['send'])) {

    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);


    $query = "INSERT INTO admin_mail(store_id,subject,personal_email,mail) VALUE('$store_id','$subject','$email','$message')";

    if (mysqli_query($conn, $query)) {

        $msg = 'Mail Sent';
        $msgClass = 'alert-success p-1 text-center text-success';
        header('Location:' . $_SERVER['PHP_SELF']);
    } else {
        echo mysqli_error($conn);
    }


    //     $reciever = "admin@website.com";
    // $query = "INSERT INTO mail_system(sender,receiver,mail_subject,email,mail) VALUE('$store_id','$reciever','$subject','$email','$message')";

    // if (mysqli_query($conn, $query)) {
    //     $msg = 'Mail Sent';
    //     $msgClass = 'alert-success p-1 text-center text-success';
    // }


}


?>
<?php require('inc/header.php'); ?>

<div class="row">
    <div class="col-md-2 col-12 m-0 p-0 card bg-light">
        <?php require('inc/sidebar.php'); ?>

    </div>
    <div class="col-md-10 m-0 p-0 ">
        <div class="container-fluid bg-light w-75">
            <div class="header text-center text-info">
                <i class="fad fa-envelope-open"></i> Mail Admin
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <?php if ($msg != "") : ?>
                    <div class="<?php echo $msgClass ?>"> <?php echo $msg ?></div>
                <?php endif ?>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" required>

                </div>

                <div class="form-group">
                    <label for="email">Personal Email:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="textarea">Message:</label>
                    <textarea name="message" id="textarea" cols="30" rows="10" class="tinymce form-control" placeholder="Message:" required></textarea>
                </div>
                <div class="text-right mb-5">
                    <button type="submit" class="btn btn-success px-5" name="send">Send <i class="fad fa-paper-plane"></i> </button>

                </div>
            </form>


        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo ROOT_URL ?>/tinymce/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT_URL ?>/tinymce/js/getdata.js"></script>
<script type="text/javascript" src="<?php echo ROOT_URL ?>/tinymce/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT_URL ?>/tinymce/plugin/tinymce/init-tinymce.js"></script>
</div>

</body>

</html>
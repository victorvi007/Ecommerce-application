<?php
require('config/db.php');

$info = "";
$infoClass = "";
$disabled = "";


if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    //$remember = htmlentities($_POST['remember']);



    if (empty($email) || empty($password)) {
        $info = "Username and Password required";
        $infoClass = "alert-danger text-center text-danger mt-1";
    } else {
        $query = "SELECT * FROM sellers_login_details WHERE business_emails='$email'";

        $result = mysqli_query($conn, $query);
        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $details = mysqli_fetch_assoc($result);
            mysqli_free_result($result);

            $checkPass = password_verify($password, $details['pass']);

            if ($checkPass == 1) {
                $details['store_id'];
                $details['store_name'];
                if ($details['payment'] == 0 ) {

                    $_SESSION['store_id'] = $details['store_id'];
                    $_SESSION['store_name'] = $details['store_name'];

                    $storeID = $details['store_id'];

                    $user_query = "SELECT * FROM sellers WHERE store_id = '$storeID'";
                    $userResult = mysqli_query($conn, $user_query);
                    $user = mysqli_fetch_assoc($userResult);
                    mysqli_free_result($userResult);
                    $_SESSION['payment_details'] = $user;
                    $_SESSION['store_id'] = $details['store_id'];
                    $_SESSION['store_name'] = $details['store_name'];
                   header('Location:' . ROOT_URL . 'paymentplan');

                } else {
                    $_SESSION['store_id'] = $details['store_id'];
                    $_SESSION['store_name'] = $details['store_name'];
               
                    header('Location:' . ROOT_URL . 'sellershub/');
                }
            }
        } else {
            $info = 'Incorrect Username or Password A';
            $infoClass = 'alert-danger text-center text-danger mt-1';
        }
            if($row == 0){
            $getPassword = "SELECT * FROM admin WHERE username ='$email'";
            $getPasswordQuery = mysqli_query($conn, $getPassword);

            if (mysqli_num_rows($getPasswordQuery) == 1) {
                $thePassword = mysqli_fetch_assoc($getPasswordQuery);
                $unhashedPassword = $thePassword['password'];
                $unhash = password_verify($password, $unhashedPassword);
                if ($unhash == 1) {
                    if (isset($_SESSION['admin'])) {
                        header('Location:' . ROOT_URL . 'adminPanel/');
                    } else {
                        $_SESSION['admin'] = [];
                        header('Location:' . ROOT_URL . 'adminPanel/');
                    }
                }
            } else {
                $info = 'Incorrect Username or Password B';
                $infoClass = 'alert-danger text-center text-danger mt-1';
            }
            }
       
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sellers Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/all.min.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script>

    </script>
    <style>
        * {
            font-family: Comic Sans MS;

        }

        #mid {
            padding: 10px;
            display: flex;
            /* border: 1px solid; */
            min-width: 100%;
            /* text-align:center; */
            justify-content:center;
            margin-top:100px;

        }

        #form{
            width:600px;
            height:400px;
            padding:20px;
            margin-top:100px;
            margin-bottom:100px;
            /* width:; */
            opacity:.9;
        }

        body {
            background-image: url(img/background_2.jpg);

            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="container">


        <div class="row">
            <!-- <div class="col-md-3 col-12"></div> -->

            <div class="" id="mid">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="card shadow" id="form">
                    <h1 class="text-center text-primary display-4">Techkron</h1>

                    <div class="form-group">

                        <label for="email" class="text-primary ">Email:</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="password" class="text-primary ">Password:</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="password">
                    </div>

                    <?php if ($info !== "") : ?>
                        <div class="<?php echo $infoClass; ?>"><?php echo $info; ?></div>
                    <?php endif; ?>
                    <div class="checkbox text-right">
                        <a href="#" class="btn btn-link">Sign up</a>
                        <input type="checkbox" name="remember" id="remember" class="p-1"> <label for="remember">
                            Remember me</label>
                        <br>
                        <input type="submit" value="Login" class="btn btn-primary pull-right" name="submit" id="submit">
                    </div>

                </form>
            </div>

            <!-- <div class="col-md-3 col-12"></div> -->
        </div>

    </div>

</body>

</html>
<?php
require('config/db.php');


$msg = "";
$msgClass = "";
if (isset($_POST['submit'])) {
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);

    if ($email == "" || $password == "") {
        $msg = "Username and Password required";
        $msgClass = "alert-danger text-center text-danger mt-1";
    } else {
        $query = "SELECT * FROM user_login_details WHERE emails='$email'";
        $result = mysqli_query($conn, $query);
        $loginStuffs = mysqli_fetch_assoc($result);
        $row = mysqli_num_rows($result);
        if ($row == 1) {
            $hashedPass = password_verify($password, $loginStuffs['pass']);
            if ($hashedPass == 1) {

                $userSessionQuery = "SELECT * FROM users WHERE email ='$email'";
                $userSessionResult = mysqli_query($conn, $userSessionQuery);
                $user = mysqli_fetch_assoc($userSessionResult);
                mysqli_free_result($userSessionResult);
                $_SESSION['user'] = $user;
                if (isset($_POST['remember'])) {
                    if(isset($_SESSION['login_email'])){
                        $_SESSION['login_email'] = $email;
                        $_SESSION['login_password'] = $password;
                    }else{
                        session_start();
                        $_SESSION['login_email'] = $email;
                        $_SESSION['login_password'] = $password;
                      
                    }
                }else{
                    unset($login_email);
                    unset($login_password);
                }
                header('Location:' . ROOT_URL);
            }else{
                $msg = 'Incorrect Username or Password';
                $msgClass = 'alert-danger text-center text-danger mt-1';
            }
        } else {
            $msg = 'Incorrect Username or Password';
            $msgClass = 'alert-danger text-center text-danger mt-1';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/all.min.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <link href="css/login.css?v=<?php echo time(); ?>" rel="stylesheet">
    <style>

    </style>
</head>

<body>

    <style>
        #theRow {
            padding-top: 100px;
            padding-bottom: 150px;
        }
    </style>

    <?php require('inc/navbar.php'); ?>
    <div class="container mb-5">
        <div class="row" id="theRow">
            <div class="col-md-6 mt-5 px-4 ">
                <div class="header">
                    <h1 class="text-warning">New Customer</h1>
                </div>
                <p>
                    By creating an account you will be able to shop faster, be up to date on an order's status, and keep
                    track of the orders
                    you have previously made.
                </p>
                <a href="<?php echo ROOT_URL; ?>account.php" name="" class=" createBtn btn btn-primary">Create Account</a>


            </div>

            <div class="col-md-6 mt-5 mb-5">


                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class=" login-form">
                    <div class="header">
                        <h1 class="text-warning">Login</h1>
                        <p class="text-warning">Returning customer</p>
                    </div>
                    <div class="form-group">

                        <label for="lastname">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo (isset($_SESSION['login_email']))? $_SESSION['login_email']:"";?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="<?php echo (isset($_SESSION['login_password']))? $_SESSION['login_password']:"" ; ?>">
                        <?php if ($msg != "") : ?>
                            <div class="<?php echo  $msgClass ?>"> <?php echo $msg; ?> </div>
                        <?php endif ?>
                    </div>

                    <div class="form-group  text-right">
                        <div class="form-group">
                            <input type="checkbox" name="remember" id="remember" class="p-1"> <label for="remember">
                                Remember me</label>
                        </div>
                        <p class=" text-left">
                            <a href="#" class="btn-link">Forget Password</a>
                        </p>

                        <button type="submit" class="log-in btn btn-primary" name="submit">Login</button>
                    </div>
                    
                    
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <?php require('inc/footer.php'); ?>
    </div>
</body>

</html>
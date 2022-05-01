<?php
require('config/db.php');

$info = "";
$infoClass = "";
$disabled = "";


if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
  $hashed =   password_hash($password,PASSWORD_DEFAULT);
echo $hashed;
        $query = "INSERT INTO admin(username,password)VALUE('$email','$hashed')";
        if(mysqli_query($conn,$query)){
            $info =  'worked';
        }else{
         echo   mysqli_error($conn);
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
            margin-top: 30px;
        }

        /* body {
            background-image: url(img/background_2.jpeg);

            background-size: cover;
        } */
    </style>
</head>

<body>
    <div class="container">


        <div class="row">
            <div class="col-md-3 col-12"></div>
            <div class="col-md-6 col-12 card shadow py-5 my-5" id="mid">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
                        <input type="checkbox" name="remember" id="remember" class="p-1"> <label for="remember"> Remember me</label>
                        <br>
                        <input type="submit" value="Login" class="btn btn-primary pull-right" name="submit" id="submit">

                    </div>

                </form>
            </div>
            <div class="col-md-3 col-12"></div>
        </div>

    </div>
</body>

</html>
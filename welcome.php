<?php require('config/db.php');
                    //  if(isset($_SESSION['reg'])){
                    //   echo 'here';
                    //  }else{
                    // header('Location:'.ROOT_URL.'success');
                    //  }


                    // $entittes = 'abcdefghijklmnopqrstabcdefgjhdsafhfkjshakdfgbsakjhfjsghabfhewgbfbsavjefuhwijerdbdsxfnjsfvbsjbdfjsdgjhfdbshijklmnopqrstuvwxyzuvwxyabcdefghijklmnopqrstabcdefghijklmnopqrstuvwxyzuvwxyzzabcdefghijklmnopqrstuvwxyz';
                    // $entittesprocess =  uniqid($entittes);
                    // $processing =  str_shuffle($entittesprocess);
                    // $letters = strtoupper(substr($processing, 0, 3));

                    // $entittes ='abcdefghijklmnopqrstabcdsjdehsiguhdsfhnreiuwahfhbsvagfhsdbnlfiuewhgfhbjshbfsgfsjbdfhsgajfhbeawsbfjdbgvbfjahfefghijklmnopqrstuvwxyzuvwxyabcdefghijklmnopqrstabcdefghijklmnopqrstuvwxyzuvwxyzzabcdefghijklmnopqrstuvwxyz';
                    // $entittesprocess =  uniqid($entittes);
                    // $processing =  str_shuffle($entittesprocess);
                    // $letters2 = strtoupper(substr($processing, 0, 3));

                    // $entittes = time() . '1234567890990876564312243454768553643234567890987656769586490869845986043689856758673939487569304985094873695739865738975694386985769438452463410384756839237449348467468349849238473294385737483293874939484374938';
                    // $entittesprocess =  uniqid($entittes);
                    // $processing =  str_shuffle($entittesprocess);
                    // $numbers = strtoupper(substr($processing, 0, 2));

                    // $store_id = $letters . $letters2 . $numbers;

header('refresh:5; url='.ROOT_URL.'sellersLogin.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/all.min.css" rel="stylesheet">
    <script src="js/jquery.js"></script>



    <style>
        * {
            font-family: Comic Sans MS;
            font-size: 15px;
        }
    </style>

</head>

<body>
    <div class="container text-center">
<!-- 
        <div class="header text-center">
            <h3>SELLER CENTER</h3>
            <hr>
            <h6>Register and start selling today - create your own seller account</h6>
        </div> -->
        <?php require('sellershub/inc/header.php') ;?>
        <div class="content text-center my-5">
            <h1 class="text-success">
                Registration complete!!!
            </h1>
            <h6 class="text-info">
                Please await a confirmation email from us .
            </h6>
            <p class="text-info">Which might take 2 to 3 days. thank you for using us!</p>
        </div>

        <a href="<?php echo ROOT_URL ?>" class="btn btn-primary btn-lg">
            return toHome page <i class="fad fa-home-lg-alt"></i>

        </a>
    </div>
    <script>
        $(document).ready(function() {
            function preback() {
                window.history.forward();
            }
            setTimeout(preback(), 0);
            window.onload() = function() {
                null
            };
        })
    </script>
</body>

</html>
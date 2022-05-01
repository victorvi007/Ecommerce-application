<?php
$settingsQuery = "SELECT * FROM settings";
$settingsResult = mysqli_query($conn, $settingsQuery);
$settings = mysqli_fetch_assoc($settingsResult);
mysqli_free_result($settingsResult);
ob_start();
if (isset($_POST['cart_btn'])) {
    header("Location:" . ROOT_URL . "cart");
}

if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
}

$queryCategories = "SELECT * FROM categories";
$resultCategories = mysqli_query($conn, $queryCategories);
$categories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);
mysqli_free_result($resultCategories);

$warningText = "";

 if (isset($_POST['remove'])) {
                            foreach ($_SESSION['cart'] as $key => $value) {
                                // print_r($value);

                                if ($value['ids'] === $_GET['id']) {

                                    unset($_SESSION['cart'][$key]);
                                }
                            }
                        }

?>

<?php
if (isset($_POST['pay_button'])) {

    if (isset($_SESSION['cart'])) {


        $item_array_id = array_column($_SESSION['cart'], 'ids');
        if (in_array($_POST['product_id'], $item_array_id)) {
            echo "<script>alert('Item already added to cart');</script>";
            // echo count($_SESSION['cart']);
        } else {
            $count = count($_SESSION['cart']);
            $item_array = [
                'ids' => $_POST['product_id'],
                'color' => (isset($_POST['color'])) ? $_POST['color'] : "",
                'size' => (isset($_POST['size'])) ? $_POST['size'] : "",
                'quantity' => $_POST['screen']
            ];
            $_SESSION['cart'][$count] = $item_array;
            header('Location:' . ROOT_URL . 'cart');
        }
    } else {

        // echo count($_SESSION['cart']);
        $item_array = [
            'ids' => $_POST['product_id'],
            'color' => (isset($_POST['color'])) ? $_POST['color'] : "",
            'size' => (isset($_POST['size'])) ? $_POST['size'] : "",
            'quantity' => $_POST['screen']
        ];

        $_SESSION['cart'][0] = $item_array;
        $number =  count($_SESSION['cart']);
        header('Location:' . ROOT_URL . 'cart');
    }
} else {
    // if (isset($_SESSION['cart'])) {
    //     echo count($_SESSION['cart']);
    // } else {
    //     echo count($_SESSION['cart']) ;
    // }
}

if (isset($_POST['add'])) {
    if (isset($_SESSION['cart'])) {


        // echo count($_SESSION['cart']);

        $item_array_id = array_column($_SESSION['cart'], 'ids');
        if (in_array($_POST['product_id'], $item_array_id)) {
            echo "<script>alert('Item already added to cart');</script>";
            // print_r($item_array);
        } else {
            $count = count($_SESSION['cart']);
            $item_array = [
                'ids' => $_POST['product_id'],
                'color' => (isset($_POST['color'])) ? $_POST['color'] : "",
                'size' => (isset($_POST['size'])) ? $_POST['size'] : "",
                'quantity' => $_POST['screen']

            ];
            $_SESSION['cart'][$count] = $item_array;
             $number =  count($_SESSION['cart']);
        }
    } else {

        $item_array = [
            'ids' => $_POST['product_id'],
            'color' => (isset($_POST['color'])) ? $_POST['color'] : "",
            'size' => (isset($_POST['size'])) ? $_POST['size'] : "",
            'quantity' => $_POST['screen']

        ];

        $_SESSION['cart'][0] = $item_array;
       $number =  count($_SESSION['cart']);
    }
} else {
    if (isset($_SESSION['cart'])) {
        $number =  count($_SESSION['cart']);
    } else {
       // echo 0;
    }
}

ob_end_flush();
?>
<script src="js/jquery.js"></script>

<style>
    .btn {
        color: white;
    }

    .navbar-brand {
        height: 60px;
        width: 140px;

    }

    .navbar {
        font-weight: bolder;
        font-family: arial;
        font-size: 20px;
    }

    #logout {
        font-weight: bolder;
        font-family: Comic Sans MS;
        font-size: 16px;
    }

    .navbar-nav>li {
        margin-right: 25px;
        margin-left: 20px;
    }


    .navbar-nav>li>a:hover {
        color: #ffc107 !important;
    }

    #logout:hover,
    #signup:hover,
    #login:hover {
        color: #ffff !important;
    }

    .title {
        font-size: 30px;
    }
    #logout{
        border-radius:0px;
    }
</style>
<nav class="navbar navbar-expand-md bg-light navbar-light sticky-top p-0 ">

    <button class="navbar-toggler m-1" data-target="#collapse_target" data-toggle="collapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapse_target">

        <!--LOGO STARTS-->


        <a href="<?php echo ROOT_URL ?>" class="navbar-brand">
            <img src="<?php echo ROOT_URL ?>/adminpanel/<?php echo $settings['logo']?>" alt="" class="navbar-brand img-fluid">
        </a>

        <!--LOGO ENDS-->

        <ul class="navbar-nav pl-3">
            <li class="nav-item"> <a href="<?php echo ROOT_URL; ?>" class="nav-link">Home</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" data_target="dropdown_target" style="cursor:pointer;">Categories</a>
                <div class="dropdown-menu" aria-labelledby="dropdown_target">

                    <?php foreach ($categories as $category) : ?>
                        <a href="<?php echo ROOT_URL; ?>categories/<?php echo  str_replace(', ', '-', str_replace(' ', '-',  str_replace('\'', '', str_replace(' & ', '-', str_replace(',', '', $category['categories'])))));   ?>" class="dropdown-item"><?php echo $category['categories']; ?></a>
                        <!-- <div class="dropdown-divider"></div> -->
                    <?php endforeach; ?>

                </div>
            </li>
            <li class="nav-item">
                <a href="<?php echo ROOT_URL ?>contact" class="nav-link">Contact us</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo ROOT_URL ?>about" class="nav-link">About Us</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" data_target="dropdown_target" style="cursor:pointer;"> <i class="far fa-user-circle"></i> <?php echo (!empty($_SESSION['user'])? "Hi, ".$_SESSION['user']['firstname']:"Login" ) ?></a>
                <div class="dropdown-menu p-0" aria-labelledby="dropdown_target">
                                                    <?php if (empty($_SESSION['user'])) :; ?>                       
                    <a class="dropdown-item bg-warning m-0" href="<?php echo ROOT_URL ?>login" id="login"> <i class="fas fa-user"></i> Login
                    </a>
                                                                        <?php endif ?>
                    <div class="dropdown-divider m-0"></div>
                    <a href="<?php echo ROOT_URL ?>createAccount" class="dropdown-item bg-success" id="signup"> <i class="fas fa-user-plus"></i>Signup</a>

                    <form action="" method="POST">
                                    <?php if (!empty($_SESSION['user'])) :; ?>
                        <button type="submit" name="logout" class="nav-link btn btn-link bg-danger w-100" id="logout"> <i class="fal fa-sign-out-alt text-white"></i> LogOut</button>
                                                       <?php endif ?>
                    </form>
                </div>
            </li>

            <li class="nav-item">
                <?php if (isset($_SESSION['user'])) :; ?>

                <?php endif ?>
            </li>


        </ul>

    </div>
    <form action="" method="POST">
        <button type="submit" class="btn btn-warning  my-2" name="cart_btn">
            <i class="fas fa-shopping-cart"></i>
            <span>Cart </span>
            <span class="badge badge-light"><?php echo (isset($number)) ?$number:0; ?></span>
        </button>
    </form>
</nav>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
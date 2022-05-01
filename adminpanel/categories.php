<?php
require('config/db.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location:' . ROOT_URL . 'sellersLogin.php');
}

if (isset($_POST['addBtn'])) {
    $textBox = mysqli_real_escape_string($conn, $_POST['addTextBox']);
    $addQuery = "INSERT INTO categories(categories)VALUES('$textBox')";
    if (mysqli_query($conn, $addQuery)) {
        header('Location:' . ROOT_URL . 'adminpanel/categories.php');
    } else {
        echo  mysqli_error($conn);
    }
}


if (isset($_POST['remove'])) {
    $route = $_GET['route'];

    $removeQuery = "DELETE FROM categories WHERE id='$route'";

    if (mysqli_query($conn, $removeQuery)) {
        header('Location:' . ROOT_URL . 'adminpanel/categories.php');
    } else {
        echo  mysqli_error($conn);
    }
}

$hiddenClass = "";
$value = 0;
if (isset($_POST['rename'])) {
}

if (isset($_POST['update'])) {
    $route = $_GET['route'];
    $updateText = mysqli_real_escape_string($conn, $_POST['textBox']);

    $updateQuery = "UPDATE categories SET categories = '$updateText' WHERE id =$route";

    if (mysqli_query($conn, $updateQuery)) {
        header('Location:' . ROOT_URL . 'adminpanel/categories.php');
    } else {
        echo mysqli_error($conn);
    }
}



$categoryQuery = "SELECT * FROM categories";
$result = mysqli_query($conn, $categoryQuery);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);


?>
<?php require('inc/header.php');
?>
<div class="row">
    <div class="col-md-2 col-12 m-0 p-0 shadow bg-light"><?php require('inc/sidebar.php'); ?></div>
    <div class="col-md-10">

        <div class="container my-3 card pt-3">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <form action="<?php echo ROOT_URL ?>adminpanel/categories.php?>" method="POST" class="my-1">
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="text" name="addTextBox" id="" class="form-control" placeholder="Add categories">
                                </div>
                            </div>
                            <div class="col-3 p-0">
                                <div class="form-group">
                                    <button type="submit" name="addBtn" class="btn btn-primary">Add</button>
                                </div>

                            </div>

                        </div>
                    </form>

                </div>
            </div>

            <div class="card-header bg-info">
                <h3 class="text-center text-white">Categories</h3>
            </div>
            <?php foreach ($categories as $category) :; ?>
                <form action="<?php echo ROOT_URL ?>adminpanel/categories.php?route=<?php echo $category['id'] ?>" method="POST" class="">
                    <div class="row card-header m-auto">
                        <div class="col-9 p-auto">
                            <input type="text" name="textBox" id="" class="form-control" value="<?php echo $category['categories'] ?>">

                        </div>
                        <div class="col-3 m-auto text-right">
                            <button type="submit" name="update" class="btn btn-info m-1">Update</button>
                            <button type="submit" name="remove" class="btn btn-danger m-1">Remove</button>
                        </div>
                        <!-- <input type="hidden" name="<?php echo $category['id'] ?>"> -->

                    </div>
                </form>
            <?php endforeach; ?>

        </div>

    </div>

</div>

</body>

</html>
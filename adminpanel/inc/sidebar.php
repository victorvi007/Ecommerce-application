<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location:' . ROOT_URL . '/sellersLogin');
}

?>

<div class="nav-bar p-auto m-auto">
    <ul class="list list-unstyled">
        <li> <a href="index.php" class="btn btn-light"> <i class="fas fa-home-lg-alt"></i> Home</a> </li>

        <li> <a href="order.php" class="btn btn-light"> <i class="fad fa-cart-arrow-down"></i> Orders</a> </li>

        <li><a class="product btn btn-light"> <i class="fad fa-tags"></i> Product <span class="up"><i class="fad fa-caret-right"></i> </span> <span class="down"> <i class="fad fa-caret-down"></i></span> </a>
            <ul class="sub-list list-unstyled">
                <li> <a href="products.php" class="btn btn-light text-info"> <i class="fal fa-list"></i>View Products</a></li>
                <!-- <li> <a href="addProduct.php" class="btn btn-light" id="addProduct"> <i class="fad fa-layer-plus"></i> Add
                        Products</a> </li> -->
            </ul>
        </li>
        <li> <a class="mail btn btn-light"> <i class="fad fa-envelope"></i> Mail<span class="mailup"> <i class="fad fa-caret-right"></i> </span> <span class="maildown"> <i class="fad fa-caret-down"></i> </span> </a>
            <ul class="list-unstyled" id="mail-list">
                <li> <a href="inbox.php" class="btn btn-light text-info"> <i class="fad fa-envelope-open"></i> Inbox </a> </li>
                <li> <a href="contactAdmin.php" id="contactAdmin" class="btn btn-light text-info"> <i class="fad fa-paper-plane"></i> Contact Admin </a></li>
            </ul>
        </li>
        <li> <a class="users btn btn-light"> <i class="fad fa-users-cog"></i> Users <span class="userup"><i class="fad fa-caret-right"></i> </span> <span class="userdown"><i class="fad fa-caret-down"></i></span> </a>
            <ul class="sub-list-users list-unstyled bg-white">
                <li> <a href="customers.php" class="btn btn-light  text-info"> <i class="fad fa-user"></i> Customers </a> </li>
                <li> <a href="stores.php" class="btn btn-light text-info"> <i class="fas fa-store-alt"></i> Stores </a> </li>
            </ul>
        </li>
        <li> <a href="categories.php" class="btn btn-light"><i class="fad fa-list-ul"></i> Categories </a> </li>
        <li> <a href="settings.php" class="btn btn-light"> <i class="fas fa-cogs"></i> Settings </a> </li>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <li> <button name="logout" class="btn btn-light text-danger"> <i class="fal fa-sign-out-alt"></i> Log Out </button> </li>
                                        </form>
    </ul>
</div>


<script>
    $(document).ready(function() {
        $('.sub-list').hide();
        $('.sub-list-users').hide();
        $('#mail-list').hide();


        $('.down').hide();
        $('.maildown').hide();
        $('.userdown').hide();


        $('.product').click(function() {
            $('.down').toggle();
            $('.sub-list').toggle(500);
            $('.up').toggle()
        })


        $('.users').click(function() {
            $('.userdown').toggle();
            $('.sub-list-users').toggle(500);
            $('.userup').toggle()
        })

        $('.mail').click(function() {
            $('#mail-list').toggle(500);
            $('.maildown').toggle();
            $('.mailup').toggle()


        })
    })
</script>
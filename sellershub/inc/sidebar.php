<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location:' . ROOT_URL . '/sellersLogin');
}

?>
<div class="nav-bar">
    <ul class="list list-unstyled">
        <li> <a href="index.php" class="btn btn-light"> <i class="fas fa-home-lg-alt"></i> Home</a> </li>

        <li> <a href="order.php" class="btn btn-light"> <i class="fad fa-cart-arrow-down"></i> Orders</a> </li>

        <li><a class="product btn btn-light"> <i class="fad fa-tags"></i> Product <span class="up">
                    <i class="fad fa-caret-right"></i> </span> <span class="down"> <i class="fad fa-caret-down"></i></span> </a>
            <ul class="sub-list list-unstyled">
                <li> <a href="products.php" class="btn btn-light text-info"> <i class="fal fa-list"></i>View Products</a></li>
                <li> <a href="addProduct" class="btn btn-light text-info" id="addProduct"> <i class="fad fa-layer-plus"></i> Add
                        Products</a> </li>
            </ul>
        </li>
        <li> <a class="mail btn btn-light"> <i class="fad fa-envelope"></i> Mail<span class="mailup"> <i class="fad fa-caret-right"></i> </span> <span class="maildown"> <i class="fad fa-caret-down"></i> </span> </a>
            <ul class="list-unstyled" id="mail-list">
                <li> <a href="inbox.php" class="btn btn-light text-info"> <i class="fad fa-envelope-open"></i> Inbox </a> </li>
                <li> <a href="contactAdmin.php" id="contactAdmin" class="btn btn-light text-info"> <i class="fad fa-paper-plane"></i> Contact Admin </a></li>
            </ul>
        </li>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <li> <button name="logout" class="btn btn-light"> <i class="fal fa-sign-out-alt"></i> Log Out </button> </li>
                                </form>
    </ul>
</div>


<script>
    $(document).ready(function() {
        $('.sub-list').hide();
        $('#mail-list').hide();

    })
    $('.down').hide();
    $('.maildown').hide();


    $('.product').click(function() {


        $('.down').toggle();

        $('.sub-list').toggle(500);
        $('.up').toggle()
    })

    $('.mail').click(function() {
        $('#mail-list').toggle(500);
        $('.maildown').toggle();
        $('.mailup').toggle()


    })
</script>
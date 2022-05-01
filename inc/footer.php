<style>
    p>a:hover {
        color: #ffffff;
        text-decoration: underline;
    }

    p>a {
        color: #ffffff;
        text-decoration: none;
    }

    #social_link {
        font-weight: 700;
    }

    /* .fb-ic:hover,.tw-ic:hover,.wtapp-ic:hover,.li-ic:hover,.ins-ic:hover{
            color:#ffc107;
    } */

    .fab:hover {
        color: #ffc107;
    }

    .fab {
        color:gray;
        font-size: 20px;
    }

    .footer-logo {
        display: flex;
        width: 100%;
        height: 200px;
    }

    .logo {
        width: 100%;
        height: 200px;
    }
</style>
<!-- Footer -->
<footer class="page-footer font-small" style="background-color:#323232; color:white;">

    <div style="background:#282828;">
        <div class="container">

            <!-- Grid row-->
            <div class="row py-4 d-flex align-items-center">

                <!-- Grid column -->
                <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
                    <h6 class="mb-0 text-white" id="social_link">Get connected with us on social networks!</h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-6 col-lg-7 text-center text-md-right">

                    <!-- Facebook -->
                    <a class="fb-ic" href="https://www.facebook.com/<?php echo $settings['facebook'] ?>">
                        <i class="fab fa-facebook-f white-text mr-4"> </i>
                    </a>
                    <!-- Twitter -->
                    <a class="tw-ic" href="https://twitter.com/<?php echo $settings['twitter'] ?>">
                        <i class="fab fa-twitter white-text mr-4"> </i>
                    </a>
                    <!-- Google +-->
                    <a class="wtapp-ic" href="https://wa.me/<?php echo $settings['whatsapp'] ?>">
                        <i class="fab fa-whatsapp white-text mr-4"> </i>
                    </a>
                    <!--Linkedin -->
                    <a class="li-ic" href="https://www.linkedin.com/in/<?php echo $settings['linkedin'] ?>">
                        <i class="fab fa-linkedin-in white-text mr-4"> </i>
                    </a>
                    <!--Instagram-->
                    <a class="ins-ic" href="https://www.instagram.com/<?php echo $settings['instagram'] ?>">
                        <i class="fab fa-instagram white-text"> </i>
                    </a>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row-->

        </div>
    </div>
    <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5">

        <!-- Grid row -->
        <div class="row mt-3">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

                <!-- Content -->
                <h6 class="text-uppercase font-weight-bold"><?php echo $settings['website_name'] ?></h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p class="footer-logo"><img src="<?php echo ROOT_URL ?>adminpanel/<?php echo $settings['logo'] ?>" alt="" class="logo"></p>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold">Products</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    <a href="#!">MDBootstrap</a>
                </p>
                <p>
                    <a href="#!">MDWordPress</a>
                </p>
                <p>
                    <a href="#!">BrandFlow</a>
                </p>
                <p>
                    <a href="#!">Bootstrap Angular</a>
                </p>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold">Join the family</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    <a href="<?php echo ROOT_URL ?>createAccount">Create an Account</a>
                </p>
                <p>
                    <a href="login">Login</a>
                </p>
                <p>
                    <a href="<?php echo ROOT_URL ?>sellersLogin">Sellers Dashboard</a>
                </p>
                <p>
                    <a href="<?php echo ROOT_URL ?>form-1">Become a seller</a>
                </p>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold">Contact</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    <i class="fas fa-home mr-3"></i><?php echo $settings['address'] ?></p>
                <p>
                    <i class="fas fa-envelope mr-3"></i><?php echo $settings['email'] ?></p>
                <p>
                    <i class="fas fa-phone mr-3"></i><?php echo $settings['phone1'] ?></p>
                <p>
                    <i class="fas fa-print mr-3"></i><?php echo $settings['phone2'] ?></p>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">&copy; 2020 Copyright
        <a href="#" class="text-white text-uppercase">Techkron tech</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
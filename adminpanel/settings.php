<?php
require('config/db.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location:' . ROOT_URL . 'sellersLogin.php');
}

$headerMsg = "";
$headerMsgClass = "";
if (isset($_POST['header'])) {
    $site_name = mysqli_real_escape_string($conn, $_POST['site_name']);
    $site_description = mysqli_real_escape_string($conn, $_POST['site_description']);

    if (!empty($site_name) && !empty($site_description)) {
        $headerQuery = "UPDATE settings SET website_name = '$site_name',website_description = '$site_description'";
        if (mysqli_query($conn, $headerQuery)) {
            header('Location:' . ROOT_URL . 'adminpanel/settings.php');
        } else {
            echo  mysqli_error($conn);
        }
    } else {
        $headerMsg = "Please ensure all fields in Header is filled";
        $headerMsgClass = "alert-danger p-1 text-danger text-center m-1";
    }
}

$logoMsg = "";
$logoMsgClass = "";
if (isset($_POST['logoBtn'])) {

    // print_r($logo);
    $logo = $_FILES['logo'];

    if ($logo['size'] != 0) {

        $logoName = $logo['name'];
        $logoType = $logo['type'];
        $logoTemp = $logo['tmp_name'];
        $logoError = $logo['error'];
        $logoSize = $logo['size'];

        $fileExp = explode('.', $logoName);
        $fileActualExt = strtolower(end($fileExp));
        $allowed = ['jpg', 'jpeg', 'png'];
        if ($logoError === 0) {
            if (in_array($fileActualExt, $allowed)) {
                if ($logoSize < 10000000) {
                    $newFileName = 'logo' . uniqid('', true) . "." . $fileActualExt;
                    $newDestination_logo = 'upload/' . $newFileName;
                    move_uploaded_file($logoTemp, $newDestination_logo);
                } else {
                    $msg =  'file size must be less than 1mb in image 2';
                    $msgClass = 'alert-danger text-danger text-center m-1';
                }
            } else {
                $msg = 'file formart in not allowed';
                $msgClass = 'alert-danger text-danger text-center m-1';
            }
        } else {
            $msg = 'Pls try again';
            $msgClass = 'alert-danger text-danger text-center m-1';
        }

        $logoQuery = "UPDATE settings SET logo = '$newDestination_logo'";
        if (mysqli_query($conn, $logoQuery)) {
            header('Location:' . ROOT_URL . 'adminpanel/settings.php');
        } else {
            echo  mysqli_error($conn);
        }
    } else {
        $logoMsg = "No image selected";
        $logoMsgClass = "alert-danger p-1 text-danger text-center m-1";
    }
}

$bannerMsg = "";
$bannerMsgClass = "";

if (isset($_POST['bannerBtn'])) {
    $banner = $_FILES['banner'];

    if ($banner['size'] != 0) {
        $bannerName = $banner['name'];
        $bannerType = $banner['type'];
        $bannerTemp = $banner['tmp_name'];
        $bannerError = $banner['error'];
        $bannerSize = $banner['size'];


        $fileExp = explode('.', $bannerName);
        $fileActualExt = strtolower(end($fileExp));
        $allowed = ['jpg', 'jpeg', 'png'];
        if ($bannerError === 0) {
            if (in_array($fileActualExt, $allowed)) {
                if ($bannerSize < 10000000) {
                    $newFileName = 'banner' . uniqid('', true) . "." . $fileActualExt;
                    $newDestination_banner = 'upload/' . $newFileName;
                    move_uploaded_file($bannerTemp, $newDestination_banner);
                } else {
                    $msg =  'file size must be less than 1mb in image 1';
                    $msgClass = 'alert-danger text-danger text-center m-1';
                }
            } else {
                $msg = 'file formart in not allowed';
                $msgClass = 'alert-danger text-danger text-center m-1';
            }
        } else {
            $msg = 'Pls try again';
            $msgClass = 'alert-danger text-danger text-center m-1';
        }

        $bannerQuery = "UPDATE settings SET jumbotron = '$newDestination_banner'";
        if (mysqli_query($conn, $bannerQuery)) {
            header('Location:' . ROOT_URL . 'adminpanel/settings.php');
        } else {
            echo  mysqli_error($conn);
        }
    } else {
        $bannerMsg = "No image selected";
        $bannerMsgClass = "alert-danger p-1 text-danger text-center m-1";
    }
}


$sidebarMsg = "";
$sidebarMsgClass = "";
if (isset($_POST['sidebarBtn'])) {
    $sidebar = mysqli_real_escape_string($conn, $_POST['sidebar']);
    if (!empty($sidebar)) {
        $sidebarQuery = "UPDATE settings SET product_sidebar = '$sidebar'";
        if (mysqli_query($conn, $sidebarQuery)) {
            header('Location:' . ROOT_URL . 'adminpanel/settings.php');
        } else {
            echo  mysqli_error($conn);
        }
    } else {
        $sidebarMsg = "sidebar is empty, please fill";
        $sidebarMsgClass = "alert-danger p-1 text-danger text-center m-1";
    }
}


$aboutMsg = "";
$saboutMsgClass = "";
if (isset($_POST['aboutBtn'])) {
    $about = mysqli_real_escape_string($conn, $_POST['about']);
    if (!empty($about)) {
        $aboutQuery = "UPDATE settings SET about = '$about'";
        if (mysqli_query($conn, $aboutQuery)) {
            header('Location:' . ROOT_URL . 'adminpanel/settings.php');
        } else {
            echo  mysqli_error($conn);
        }
    } else {
        $aboutMsg = "sidebar is empty, please fill";
        $aboutMsgClass = "alert-danger p-1 text-danger text-center m-1";
    }
}


$contactMsg = "";
$contactMsgClass = "";
if (isset($_POST['contactBtn'])) {
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    if (!empty($contact)) {
        $contactQuery = "UPDATE settings SET contact = '$contact'";
        if (mysqli_query($conn, $contactQuery)) {
            header('Location:' . ROOT_URL . 'adminpanel/settings.php');
        } else {
            echo  mysqli_error($conn);
        }
    } else {
        $contactMsg = "sidebar is empty, please fill";
        $contactMsgClass = "alert-danger p-1 text-danger text-center m-1";
    }
}

$socialMsg = "";
$socialMsgClass = "";
if (isset($_POST['socials'])) {
    $facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
    $twitter = mysqli_real_escape_string($conn, $_POST['twitter']);
    $whatsapp = mysqli_real_escape_string($conn, $_POST['whatsapp']);
    $linkedin = mysqli_real_escape_string($conn, $_POST['linkedin']);
    $instagram = mysqli_real_escape_string($conn, $_POST['instagram']);

    if (!empty($facebook) && !empty($twitter) && !empty($whatsapp) && !empty($linkedin) && !empty($instagram)) {

        $socialsQuery = "UPDATE settings SET facebook = '$facebook',twitter = '$twitter',whatsapp ='$whatsapp',linkedin = '$linkedin',instagram='$instagram' ";
        if (mysqli_query($conn, $socialsQuery)) {
            header('Location:' . ROOT_URL . 'adminpanel/settings.php');
        } else {
            echo  mysqli_error($conn);
        }
    } else {
        $socialMsg = "Please filled all fields in socials";
        $socialMsgClass = "alert-danger p-1 text-danger text-center m-1";
    }
}

$contactMsg = "";
$contactMsgClass = "";
if (isset($_POST['contacts'])) {
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone1 = mysqli_real_escape_string($conn, $_POST['phone1']);
    $phone2 = mysqli_real_escape_string($conn, $_POST['phone2']);

    if (!empty($address) && !empty($email) && !empty($phone1) && !empty($phone2)) {
        $contactsQuery = "UPDATE settings SET address = '$address',email = '$email',phone1 ='$phone1',phone2 = '$phone2'";
        if (mysqli_query($conn, $contactsQuery)) {
            header('Location:' . ROOT_URL . 'adminpanel/settings.php');
        } else {
            echo  mysqli_error($conn);
        }
    } else {
        $contactMsg = "Please filled all fields in contacts";
        $contactMsgClass = "alert-danger p-1 text-danger text-center m-1";
    }
}


if (isset($_POST['copyrightBtn'])) {
    $copyright = mysqli_real_escape_string($conn, $_POST['copyright']);

    $copyrightQuery = "UPDATE settings SET copyright = '$copyright'";
    if (mysqli_query($conn, $copyrightQuery)) {
        header('Location:' . ROOT_URL . 'adminpanel/settings.php');
    } else {
        echo  mysqli_error($conn);
    }
}



$settingsQuery = "SELECT * FROM settings";
$settingsResult  = mysqli_query($conn, $settingsQuery);
$settings = mysqli_fetch_assoc($settingsResult);
mysqli_free_result($settingsResult);
// print_r($settings);

?>



<?php require('inc/header.php'); ?>

<body>
    <style>
        .upload {
            font-size: 100px;
            color: #ffffff;
        }
    </style>
    <div class="row">
        <div class="col-md-2 col-12 shadow bg-light"><?php require('inc/sidebar.php'); ?></div>
        <div class="col-md-10">

            <!-- <div class="container-fluid"> -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="card p-2 m-1 mt-3 ">
                <div class="card m-2 px-3">
                    <h3>Header Settings</h3>
                    <?php if ($headerMsg != "") :; ?>
                        <div class="<?php echo $headerMsgClass; ?>"><?php echo $headerMsg ?></div>

                    <?php endif; ?>
                    <div class="form-group">
                        <label for="" class="text-primary"> Header namespace </label>
                        <input type="text" name="site_name" id="siteName" class="form-control" value="<?php echo $settings['website_name']; ?>">
                    </div>

                    <div class="form-group">
                        <label class="text-primary"> Site Description </label>
                        <input type="text" name="site_description" id="siteDescription" class="form-control" value="<?php echo $settings['website_description']; ?>">
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" name="header" class="btn btn-primary px-5">Save</button>

                    </div>
                </div>
            </form>


            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="card m-1 mt-3" enctype="multipart/form-data">
                <div class="card m-2 px-3">
                    <h3>Logo</h3>
                    <?php if ($logoMsg != "") :; ?>
                        <div class="<?php echo $logoMsgClass; ?>"><?php echo $logoMsg ?></div>

                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group text-center ">
                                <!-- <h5 class="upload text-info"><i class="fal fa-image-polaroid"></i></h5> -->
                                <label for="logoBtn" class="uploadBtn">
                                    <div class="label">
                                        <p class="btnContent" id="btnContent">Upload Images</p>
                                        <img src="" alt="" class="img-fluid img-thumbnail" id=logoPreview>
                                    </div>
                                </label>
                                <input type="file" name="logo" id="logoBtn" class="form-control-file">

                            </div>
                        </div>
                        <div class="col-md-7 text-right">
                            <img src="<?php echo ROOT_URL . 'adminpanel/' . $settings['logo'] ?>" alt="" class="img-fluid img-thumbnail" id="logo">
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" name="logoBtn" class="btn btn-primary px-5 mt-2">Save</button>
                    </div>
                </div>
            </form>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="card p-2 m-1 mt-3" enctype="multipart/form-data">
                <div class="m-2 px-3">
                    <h3>Banner</h3>
                    <?php if ($bannerMsg != "") :; ?>
                        <div class="<?php echo $bannerMsgClass; ?>"><?php echo $bannerMsg ?></div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group text-center">
                                <label for="bannerInputBtn" class="uploadBtn">
                                    <div class="label">
                                        <p class="btnContentBanner" id="btnContentBanner">Upload Images</p>
                                        <img src="" alt="" class="img-fluid img-thumbnail" id="bannerPreview">
                                    </div>
                                </label>
                                <input type="file" name="banner" id="bannerInputBtn" class="form-control-file">
                            </div>
                        </div>
                        <div class="col-md-7 text-right"> <img src="<?php echo ROOT_URL . 'adminpanel/' . $settings['jumbotron']; ?>" alt="" class="img-fluid img-thumbnail" id="banner"> </div>

                    </div>
                    <div class="form-group text-right mt-2">
                        <button type="submit" name="bannerBtn" class="btn btn-primary px-5">Save</button>
                    </div>
                </div>

            </form>

            <script src="js/settings.js"></script>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="card p-2 m-1 mt-3">
                <h3>SideBar Settings</h3>
                <?php if ($sidebarMsg != "") :; ?>
                    <div class="<?php echo $sidebarMsgClass; ?>"><?php echo $sidebarMsg ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label class="text-primary"> sideBar Content </label>
                    <textarea name="sidebar" id="" cols="30" rows="10" class=" tinymce form-control"> <?php echo $settings['product_sidebar']; ?> </textarea>
                </div>

                <div class="form-group text-right">
                    <button type="submit" name="sidebarBtn" class="btn btn-primary px-5">Save</button>
                </div>
            </form>


            <!-- ABOUT US -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="card p-2 m-1 mt-3">
                <h3>About</h3>
                <?php if ($aboutMsg != "") :; ?>
                    <div class="<?php echo $aboutMsgClass; ?>"><?php echo $aboutMsg ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label class="text-primary"> </label>
                    <textarea name="about" id="" cols="30" rows="10" class=" tinymce form-control"> <?php  echo $settings['about']; ?> </textarea>
                </div>

                <div class="form-group text-right">
                    <button type="submit" name="aboutBtn" class="btn btn-primary px-5">Save</button>
                </div>
            </form>
            <!-- END ABOUT US -->

            <!-- CONTACT US -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="card p-2 m-1 mt-3">
                <h3>Contact Us</h3>
                <?php if ($contactMsg != "") :; ?>
                    <div class="<?php echo $contactMsgClass; ?>"><?php echo $contactMsg ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <!-- <label class="text-primary"> sideBar Content </label> -->
                    <textarea name="contact" id="" cols="30" rows="10" class=" tinymce form-control"> <?php echo $settings['contact'];?> </textarea>
                </div>

                <div class="form-group text-right">
                    <button type="submit" name="contactBtn" class="btn btn-primary px-5">Save</button>
                </div>
            </form>
            <!-- END CONTACT US -->

            <div class="row">
                <div class="col-md-6">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="card p-2 m-1 mt-3">
                        <h5>Social handles</h5>
                        <?php if ($socialMsg != "") :; ?>
                            <div class="<?php echo $socialMsgClass; ?>"><?php echo $socialMsg ?></div>
                        <?php endif; ?>
                        <div class="form-group">

                            <input type="text" name="facebook" id="" class="form-control" placeholder="Facebook" value="<?php echo $settings['facebook']; ?>">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="twitter" id="" class="form-control" placeholder="twitter" value="<?php echo $settings['twitter']; ?>">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="whatsapp" id="" class="form-control" placeholder="Whatsapp" value="<?php echo $settings['whatsapp']; ?>">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="linkedin" id="" class="form-control" placeholder="LinkedIn" value="<?php echo $settings['linkedin']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="instagram" id="" class="form-control" placeholder="instagram" value="<?php echo $settings['instagram']; ?>">
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" name="socials" class="btn btn-primary px-5">Save</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="card p-2 m-1 mt-3">
                        <h5>Contacts</h5>
                        <?php if ($contactMsg != "") :; ?>
                            <div class="<?php echo $contactMsgClass; ?>"><?php echo $contactMsg ?></div>
                        <?php endif; ?>
                        <div class="form-group">

                            <input type="address" name="address" id="" class="form-control" placeholder="Address" value="<?php echo $settings['address']; ?>">
                        </div>

                        <div class="form-group">
                            <label for=""></label>
                            <input type="email" name="email" id="" class="form-control" placeholder="Email" value="<?php echo $settings['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="phone1" id="" class="form-control" placeholder="Phone number" value="<?php echo $settings['phone1']; ?>">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="phone2" id="" class="form-control" placeholder="Another phone number" value="<?php echo $settings['phone2']; ?>">
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" name="contacts" class="btn btn-primary px-5">Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class=" card p-2 m-2 mt-3 mb-3 col-12">
                <div class="row"> -->
            <!-- <div class="row my-5"> -->
            <!-- <div class="col-md-8">
                        <input type="text" name="copyright" id="" class="form-control m-2" placeholder="Copyright" value="<?php echo $settings['copyright']; ?>">
                    </div>

                    <div class="col-md-4 col-12">
                        <button type="submit" name="copyrightBtn" class="btn btn-primary px-5 m-2">Save</button>
                    </div>
                </div>
            </form> -->









        </div>

    </div>


    <script type="text/javascript" src="<?php echo ROOT_URL ?>/tinymce/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_URL ?>/tinymce/js/getdata.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_URL ?>/tinymce/plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_URL ?>/tinymce/plugin/tinymce/init-tinymce.js"></script>

</body>

</html>
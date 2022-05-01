<?php
$settingsQuery = "SELECT * FROM settings";
$settingsResult = mysqli_query($conn, $settingsQuery);
$settings = mysqli_fetch_assoc($settingsResult);
mysqli_free_result($settingsResult);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=" stylesheet" href="css/bootstrap.min.css">
    <link href="css/all.min.css" rel="stylesheet">
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <title>Home</title>
    <style>
        .jumbotron {
            background-image: url("<?php echo ROOT_URL ?>adminpanel/<?php echo $settings['jumbotron'] ?>");
            background-size: cover;
            border-radius: 0px;
        }
    </style>
</head>

<body>
    <div id="container">
    <!--JUMBOTRON STARTS-->
    <div class="jumbotron" style="margin-bottom:0px;">
        <h1><?php echo $settings['website_name'] ?></h1>
        <p><?php echo $settings['website_description'] ?></p>
    </div>
    <!--JUMBOTRON ENDS-->
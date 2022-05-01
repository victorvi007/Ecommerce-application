<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sellers Hub</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/all.min.css" rel="stylesheet">
    <link href="css/settings.css" rel="stylesheet">
    <!-- <link href="../css/sellershub.css" rel="stylesheet"> -->
    <script src="js/jquery.js"></script>
    <style>
        .col-sm-3 {
            height: 2px;
        }

        * {
            font-family: Comic Sans MS;

        }

        .header {
            font-size: 14px;
        }

        li {
            margin: 5px;

        }

        ul li a {
            width: 100%;
        }
        ul li button {
            width: 100%;
        }


        ul li ul li a {
            width: 100%;
            padding-right: 40px;

        }

        .sub-list li {
            list-style: none;
        }

        .form-control-file {
            display: none;
        }


        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0px
        }

        .logOut {
            border: 0px;
            background: red;
        }

        .logOut:active {
            box-shadow: 0px;

        }

        .title {
            font-size: 50px;
        }

        /* .card{
            margin-top:100px;
        } */
    </style>
</head>

<body class=" bg-light">
    <div class="container-fluid m-0 ">

        <div class="header">
            <h1 class="text-center"> <span class="text-primary">SELLER</span> <span class="text-danger"> HUB </span>
            </h1>
            <div class="row">
                <div class="col-sm-3 col-3 bg-info"></div>
                <div class="col-sm-3 col-3 bg-warning"></div>
                <div class="col-sm-3 col-3 bg-success"></div>
                <div class="col-sm-3 col-3 bg-danger"></div>

            </div>
        </div>
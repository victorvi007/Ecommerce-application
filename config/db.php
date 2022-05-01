<?php
require('config.php');
    $conn= mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if(mysqli_connect_errno()){
            echo "error". mysqli_connect_errno();
        }
session_start();

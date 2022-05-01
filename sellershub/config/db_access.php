<?php
require('config/db.php');
if (!mysqli_connect_errno()) {

    $query = 'SELECT * FROM products ORDER BY added_at DESC';
    $result = mysqli_query($conn, $query);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
}


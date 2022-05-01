<?php
session_start();
session_destroy();
?>

<style>
.container{
    /* border:2px solid gray; */
    padding:40px;
    border-radius:10px;
    height:200px;
    width:500;
    color:red;
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
}
h1{
    border:2px solid gray;
    padding:40px;
    border-radius:10px;
    color:red;
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
    font-size:100px;
    font-family:arial;
}
</style>
<div class="container">
    <h1>
        ERROR
    </h1>
</div>
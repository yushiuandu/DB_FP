<?php 
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['nickname']);
    session_destroy();
    header("Location:../index/index.php");
?>
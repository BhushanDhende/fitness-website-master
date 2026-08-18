<?php

session_start();
 if(isset($_SESSION['auth'])){
    unset($_SESSION['auth']);
    unset($_SESSION['uname']);
 }
 header('location:../../index.php');
 
?>
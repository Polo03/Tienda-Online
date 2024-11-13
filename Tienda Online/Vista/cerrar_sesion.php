<?php

session_start();

$_SESSION['cliente']=[];
$_SESSION['carrito']=[];
header('location:../Vista/login.php');
?>
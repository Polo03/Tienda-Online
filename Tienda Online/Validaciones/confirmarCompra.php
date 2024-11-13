<?php
session_start();
$_SESSION['carrito']=[];
header("Location: ../Vista/tienda.php");

?>
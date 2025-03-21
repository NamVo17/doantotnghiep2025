<?php
include(__DIR__ . '/../config/config.php');
error_reporting(0);
session_start();

mysqli_query($conn,"DELETE FROM tra_banhngot WHERE id = '".$_GET['menu_del']."'");
header("location:all_menu.php");  

?>

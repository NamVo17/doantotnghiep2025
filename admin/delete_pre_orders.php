
<?php
include(__DIR__ . '/../config/config.php');
error_reporting(0);
session_start();
mysqli_query($conn,"DELETE FROM dathang WHERE id = '".$_GET['pre_order_del']."'");
header("location:all_pre_orders.php");  
?>

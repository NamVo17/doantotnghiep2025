
<?php
include(__DIR__ . '/../config/config.php');
error_reporting(0);
session_start();
mysqli_query($conn,"DELETE FROM donhang WHERE id = '".$_GET['order_del']."'");
header("location:all_orders.php");  
?>

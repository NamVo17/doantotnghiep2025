
<?php
include(__DIR__ . '/../config/config.php');
error_reporting(0);
session_start();

mysqli_query($conn,"DELETE FROM account WHERE User_id = '".$_GET['user_del']."'");
header("location:all_users.php");  

?>

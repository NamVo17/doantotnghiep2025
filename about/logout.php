<?php
session_start();
session_unset();
session_destroy();
header("Location: ../index.php"); // Chuyển hướng về trang chính
exit();
?>

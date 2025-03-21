<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) {
    header("Location: ../index.php");
    exit();
}
?>

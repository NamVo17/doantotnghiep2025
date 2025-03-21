<?php
// Kết nối đến MySQL
$servername = "localhost";
$username   = "root";  // thay đổi username của bạn
$password   = "";  // thay đổi password của bạn
$dbname     = "tltn2025";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
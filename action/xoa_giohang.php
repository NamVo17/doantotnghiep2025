<?php
session_start();
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

if (isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);


    $sql_xoagiohang = "DELETE FROM giohang WHERE user_id = ?";
    $stmt = $conn->prepare($sql_xoagiohang);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Lỗi MySQL: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

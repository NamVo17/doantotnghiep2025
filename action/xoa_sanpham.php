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

// Kiểm tra nếu có gửi id sản phẩm
if (isset($_POST['id'])) {
    $product_id = $_POST['id'];

    // Xóa sản phẩm khỏi giỏ hàng
    $sql_xoasanpham = "DELETE FROM giohang WHERE id = ?";
    $stmt = $conn->prepare($sql_xoasanpham);

    if ($stmt === false) {
        die("Lỗi trong việc chuẩn bị câu lệnh SQL: " . $conn->error); // Debug lỗi SQL
    }

    // Liên kết tham số và thực thi câu lệnh
    $stmt->bind_param("i", $product_id);
    $result_xoasanpham = $stmt->execute();


    $stmt->close();
    $conn->close();
} 
?>

<?php
include(__DIR__ . '/../config/config.php');

if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = intval($_POST['order_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "UPDATE donhang SET trang_thai = '$status' WHERE id = $order_id";
    if (mysqli_query($conn, $sql)) {
        echo "Cập nhật thành công!";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
        header("location: all_orders.php");
        exit;
    }
} else {
    echo "Dữ liệu không hợp lệ!";
}
?>

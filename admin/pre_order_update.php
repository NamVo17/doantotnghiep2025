<?php
include(__DIR__ . '/../config/config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = intval($_POST['order_id']);
    $price = floatval($_POST['price']);
    $status = $_POST['status'];

    // Lấy thông tin từ bảng dathang
    $query = "SELECT * FROM dathang WHERE id = $order_id";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $cake_info = $row['thongtin_banh'];
        $booker_info = $row['thongtin_khach'];
        $reg_date = $row['ngay_dat'];

        // Chèn dữ liệu vào bảng donhang
        // $user_id = $row['user_id'];  Lấy user_id từ bảng dathang
        $user_id = 37;
        $insert = "INSERT INTO donhang (user_id, ghichu, dia_chi, tong_cong, ngay_tao, trang_thai) 
           VALUES ('$user_id', '$cake_info', '$booker_info', $price, '$reg_date', '$status')";


        if (mysqli_query($conn, $insert)) {
            echo "Cập nhật đơn hàng thành công!";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        echo "Không tìm thấy đơn hàng!";
    }
}
?>
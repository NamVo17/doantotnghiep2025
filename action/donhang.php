<?php
include(__DIR__ . '/../config/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = intval($_POST['user_id']);
    $ten = $_POST['ten'];
    $sdt = $_POST['sdt'];
    $dia_chi = $_POST['dia_chi'];
    $id_sanpham = $_POST['id_sanpham']; 
    $tong_tien = floatval($_POST['tong_tien']);
    $phi_van_chuyen = floatval($_POST['phi_van_chuyen']);
    $tong_cong = floatval($_POST['tong_cong']);
    $pttt = $_POST['pttt'];

    $sql = "INSERT INTO donhang (user_id, ten, sdt, dia_chi, id_sanpham, tong_tien, phi_van_chuyen, tong_cong, pttt, trang_thai, ngay_tao) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'processing', NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssddds", $user_id, $ten, $sdt, $dia_chi, $id_sanpham, $tong_tien, $phi_van_chuyen, $tong_cong, $pttt);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>

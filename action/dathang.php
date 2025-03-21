<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Cho phép truy cập từ mọi nguồn
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli("localhost", "root", "", "tltn2025"); // Thay your_database_name bằng tên database của bạn

if ($conn->connect_error) {
    die(json_encode(["error" => "Lỗi kết nối CSDL: " . $conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["banh"]) && isset($data["contact"])) {
    $banh = $conn->real_escape_string($data["banh"]);
    $contact = $conn->real_escape_string($data["contact"]);

    $sql = "INSERT INTO dathang (thongtin_banh, thongtin_khach, ngay_dat) VALUES ('$banh', '$contact', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Đặt hàng thành công"]);
    } else {
        echo json_encode(["error" => "Lỗi khi đặt hàng: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Thiếu thông tin đặt hàng"]);
}

$conn->close();
?>

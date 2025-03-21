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
    die(json_encode(['error' => 'Kết nối đến cơ sở dữ liệu thất bại: ' . $conn->connect_error]));
}
// Lấy dữ liệu POST từ frontend
$data = json_decode(file_get_contents('php://input'), true);
// Debug xem PHP nhận được gì
file_put_contents("debug_log.txt", print_r($data, true));
if (!$data) {
    echo json_encode(['error' => 'Không nhận được dữ liệu hoặc dữ liệu không hợp lệ']);
    exit;
}

// Kiểm tra dữ liệu hợp lệ
if (!isset($data['user_id'], $data['product_id'], $data['img'], $data['name'], $data['price'], $data['so_luong'])) {
    echo json_encode(['error' => 'Dữ liệu không hợp lệ']);
    exit;
}

$userId = $data['user_id'];
$productId = $data['product_id'];
$img = $data['img'];
$name = $data['name'];
$price = floatval(str_replace('.', '', $data['price'])); 
$soLuong = intval($data['so_luong']); // Chuyển đổi số lượng thành số nguyên

// Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
$sql = "SELECT * FROM giohang WHERE user_id = ? AND id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $userId, $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Nếu sản phẩm đã có, cập nhật số lượng mới
    $sql = "UPDATE giohang SET so_luong = so_luong + ? WHERE user_id = ? AND id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $soLuong, $userId, $productId);
    $stmt->execute();
} else {
    // Nếu sản phẩm chưa có, thêm mới với số lượng từ input
    $sql = "INSERT INTO giohang (user_id, id, so_luong, img, name, price) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiissd', $userId, $productId, $soLuong, $img, $name, $price);
    $stmt->execute();
}

echo json_encode(['success' => true, 'product_id' => $productId, 'product_name' => $name, 'product_price' => $price, 'product_img' => $img, 'so_luong' => $soLuong]);
?>
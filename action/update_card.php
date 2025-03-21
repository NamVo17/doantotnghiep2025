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

// Kiểm tra nếu dữ liệu không hợp lệ
if (!$data) {
    echo json_encode(['error' => 'Không nhận được dữ liệu hoặc dữ liệu không hợp lệ']);
    exit;
}

// Kiểm tra xem user_id và product_id có tồn tại trong dữ liệu không
if (isset($data['user_id'], $data['product_id'], $data['img'], $data['name'], $data['price'])) {
    $userId = $data['user_id'];
    $productId = $data['product_id'];
    $img = $data['img'];
    $name = $data['name'];
    
    // Loại bỏ dấu phẩy trong giá và chuyển thành số nguyên
    $price = str_replace(',', '', $data['price']); // Loại bỏ dấu phẩy

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng hay chưa
    $sql = "SELECT * FROM giohang WHERE user_id = ? AND id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Sản phẩm đã có trong giỏ, tăng số lượng lên 1
        $sql = "UPDATE giohang SET so_luong = so_luong + 1 WHERE user_id = ? AND id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $userId, $productId);
        $stmt->execute();
    } else {
        // Sản phẩm chưa có trong giỏ, thêm sản phẩm với số lượng là 1
        $sql = "INSERT INTO giohang (user_id, id, so_luong, img, name, price) VALUES (?, ?, 1, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iissd', $userId, $productId, $img, $name, $price);
        $stmt->execute();
    }

    echo json_encode(['success' => true, 'product_id' => $productId, 'product_name' => $name, 'product_price' => $price, 'product_img' => $img]);
} else {
    echo json_encode(['error' => 'Dữ liệu không hợp lệ: user_id hoặc product_id hoặc các thông tin sản phẩm không có']);
}
?>

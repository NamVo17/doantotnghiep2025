<?php
header("Content-Type: application/json");
include("../config/config.php"); // Kết nối database

// Kiểm tra dữ liệu gửi từ chatbot
$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !isset($data["price"]) || !isset($data["flavor"])) {
    echo json_encode(["status" => "error", "message" => "Thiếu dữ liệu"]);
    exit;
}

// Chuyển đổi giá từ text thành số
$priceRange = $data["price"];
if ($priceRange === "100k - 200k") {
    $minPrice = 100000;
    $maxPrice = 200000;
} elseif ($priceRange === "200k - 300k") {
    $minPrice = 200000;
    $maxPrice = 300000;
} else {
    $minPrice = 300000;
    $maxPrice = 1000000; // Giá tối đa giả định
}

$flavor = $data["flavor"];

// Truy vấn MySQL
$sql = "SELECT * FROM tra_banhngot WHERE price BETWEEN ? AND ? AND introduce LIKE ?";
$stmt = $conn->prepare($sql);
$searchFlavor = "%$flavor%";
$stmt->bind_param("iis", $minPrice, $maxPrice, $searchFlavor);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Trả kết quả về chatbot
if (count($products) > 0) {
    echo json_encode(["status" => "success", "data" => $products]);
} else {
    echo json_encode(["status" => "not_found", "message" => "Không tìm thấy bánh phù hợp!"]);
}
?>

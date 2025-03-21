<?php
include __DIR__ . '/../config/config.php'; // Kết nối database

header("Content-Type: application/json"); // Trả về JSON

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_ids"])) {
    $ids = json_decode($_POST["product_ids"], true);

    if (!empty($ids)) {
        // Chuyển đổi ID thành danh sách chuỗi
        $idPlaceholders = implode(',', array_fill(0, count($ids), '?'));

        // Chuẩn bị câu SQL
        $sql = "SELECT id, name, price, sale, img FROM tra_banhngot WHERE id IN ($idPlaceholders)";

        if ($stmt = $conn->prepare($sql)) {
            // Gán tham số cho SQL
            $types = str_repeat('i', count($ids)); // 'i' = integer
            $stmt->bind_param($types, ...$ids);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $products = $result->fetch_all(MYSQLI_ASSOC);
                echo json_encode($products);
            } else {
                echo json_encode(["error" => "Lỗi khi thực thi SQL: " . $stmt->error]);
            }
        } else {
            echo json_encode(["error" => "Lỗi chuẩn bị SQL: " . $conn->error]);
        }
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode(["error" => "Dữ liệu không hợp lệ"]);
}
?>

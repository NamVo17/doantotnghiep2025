<?php
include(__DIR__ . '/../about/connect.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT id, name, price, sale, img, img1, introduce FROM tra_banhngot WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $final_price = $row["price"] - ($row["price"] * $row["sale"] / 100);
    echo json_encode([
        "id" => $row["id"],
        "name" => $row["name"],
        "price" => number_format($final_price, 0, ",", "."),
        "img" => $row["img"],
        "img1" => $row["img1"],
        "introduce" => $row["introduce"] ?? "Không có mô tả"
    ]);
} else {
    echo json_encode(["error" => "Sản phẩm không tồn tại"]);
}

$conn->close();
?>

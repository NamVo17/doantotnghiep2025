<?php
session_start();
// Kết nối đến MySQL
include(__DIR__ . '/../config/config.php');

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Lấy danh sách sản phẩm yêu thích của người dùng
$likedProducts = [];
if ($user_id) {
  $queryLiked = "SELECT product_id FROM yeuthich WHERE user_id = ?";
  $stmt = $conn->prepare($queryLiked);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $resultLiked = $stmt->get_result();
  while ($row = $resultLiked->fetch_assoc()) {
    $likedProducts[] = $row['product_id'];
  }
  $stmt->close();
}


// Lấy tham số "groups" (VD: "1,2") và "page"
$groups = isset($_GET['groups']) ? $_GET['groups'] : "";
$page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Cấu hình phân trang
$limit  = 12;
$offset = ($page - 1) * $limit;

// Nếu có nhóm được chọn, tách thành mảng
if (!empty($groups)) {
  $groupsArray = explode(",", $groups);       // "1,2" -> ["1","2"]
  $groupsArray = array_map('intval', $groupsArray); // Ép sang int
  $groupsStr   = implode(",", $groupsArray);  // [1,2] -> "1,2"

  // Truy vấn đếm số sản phẩm thỏa mãn
  $countSql = "SELECT COUNT(*) as total
                 FROM tra_banhngot
                 WHERE `group` IN ($groupsStr)";
} else {
  // Không chọn gì => lấy tất cả
  $countSql = "SELECT COUNT(*) as total
                 FROM tra_banhngot";
}

$countResult = $conn->query($countSql);
$countRow    = $countResult->fetch_assoc();
$totalProducts = $countRow['total'];
$totalPages    = ceil($totalProducts / $limit);

// Lấy danh sách sản phẩm
if (!empty($groupsStr)) {
  $sql = "SELECT id, name, price, sale, img
            FROM tra_banhngot
            WHERE `group` IN ($groupsStr)
            ORDER BY (sale > 0) DESC, price DESC
            LIMIT $offset, $limit";
} else {
  // Không chọn => lấy tất cả
  $sql = "SELECT id, name, price, sale, img
            FROM tra_banhngot
            ORDER BY (sale > 0) DESC, price DESC
            LIMIT $offset, $limit";
}

$result = $conn->query($sql);

// Dùng ob_start để gom HTML trả về
ob_start();
?>
<div class="products">
  <?php
  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $id = $row["id"];
      $name  = $row["name"];
      $price = $row["price"];
      $sale  = $row["sale"];
      $image = $row["img"];
      $new_price = $price - ($price * $sale / 100);
      // Kiểm tra sản phẩm có trong danh sách yêu thích không
      $isLiked = in_array($row['id'], $likedProducts);
      $likedClass = $isLiked ? 'text-red' : '';
      $likedAction = $isLiked ? 'remove' : 'add';
  ?>
      <div class="product">
        <?php if ($sale > 0): ?>
          <div class="discount">-<?php echo $sale; ?>%</div>
        <?php endif; ?>
        <a href="/about/chitietsanpham.php?id=<?= $id ?>">
    <img alt="<?= htmlspecialchars($name); ?>" src="<?= htmlspecialchars($image); ?>" />
</a>
        <div class="name"><?php echo htmlspecialchars($name); ?></div>
        <div class="oldnew">
          <div class="old-price">
            <?php echo number_format($price, 0, ",", "."); ?>₫
          </div>
          <div class="new-price">
            <?php echo number_format($new_price, 0, ",", "."); ?>₫
          </div>
        </div>
        <div class="flex space-x-2 items-center justify-center w-full">
          <!-- Shopping Basket Icon -->
          <button class="w-8 h-8 bg-yellow-600 rounded-full flex items-center justify-center  " title="Thêm vào giỏ hàng" onclick="viewPurchase(<?= $row['id'] ?>)">
            <i class="fas fa-shopping-basket text-white"></i>
          </button>
          <!-- Search Icon -->
          <button class="w-8 h-8 bg-yellow-600 rounded-full flex items-center justify-center" title="Xem thêm" onclick="viewProduct(<?= $row['id'] ?>)">
            <i class="fas fa-search text-white"></i>
          </button>
          <?php
          $heartIcon = ($likedAction == "remove")
            ? '<i class="fas fa-heart text-red-500"></i>'
            : '<i class="fas fa-heart text-white"></i>';
          ?>
          <!-- Heart Icon -->
          <button class="w-8 h-8 bg-yellow-600 rounded-full flex items-center justify-center heart-btn"
            data-id="<?= $row['id'] ?>"
            data-action="<?= $likedAction ?>">
            <?= $heartIcon ?>
          </button>
        </div>
      </div>

  <?php
    }
  } else {
    echo "<p>Không có sản phẩm phù hợp.</p>";
  }
  ?>
</div>
<!-- Phân trang -->
<div class="pagination-links">
  <?php if ($page > 1): ?>
    <a href="#" class="page-link" data-page="<?php echo $page - 1; ?>">
      <
        </a>
      <?php endif; ?>

      <?php
      for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($i == $page) ? "active" : "";
        echo '<a href="#" class="page-link ' . $active .
          '" data-page="' . $i . '">' . $i . '</a>';
      }
      ?>

      <?php if ($page < $totalPages): ?>
        <a href="#" class="page-link" data-page="<?php echo $page + 1; ?>">
          >
        </a>
      <?php endif; ?>
</div>

<?php
$html = ob_get_clean();
echo $html;
$conn->close();

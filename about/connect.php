<?php
session_start();
include(__DIR__ . '/../config/config.php');

// Kiểm tra đăng nhập và lưu user_id vào session
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM account WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result_dangnhap = $stmt->get_result();
    
    if ($result_dangnhap->num_rows == 0) {
        $_SESSION['error'] = "Email không hợp lệ!";
    } else {
        $row = $result_dangnhap->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['User_id']; // Lưu user_id vào session
            $_SESSION['user'] = $row; // Lưu thông tin user vào session

            if ($row['User_id'] == 1) {
                // Nếu là admin, chuyển đến dashboard
                header("Location: ../admin/dashboard.php");
            } else {
                // Người dùng bình thường, chuyển về trang chủ
                header("Location: ../index.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Mật khẩu chưa chính xác!";
        }
    }
    $stmt->close();
}


// Kiểm tra xem người dùng đã đăng nhập chưa
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Truy vấn số lượng sản phẩm yêu thích, chỉ lấy nếu người dùng đã đăng nhập
if ($user_id) {
    // Nếu đã đăng nhập, đếm số lượng sản phẩm yêu thích của người dùng
    $query_count_wishlist = "SELECT COUNT(*) AS total FROM yeuthich WHERE user_id = ?";
    $stmt = $conn->prepare($query_count_wishlist);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result_count_wishlist = $stmt->get_result();
    $wishlist_count = 0;
    if ($result_count_wishlist && $result_count_wishlist->num_rows > 0) {
        $row = $result_count_wishlist->fetch_assoc();
        $wishlist_count = $row['total'];  // Số lượng sản phẩm yêu thích của người dùng
    }
    $stmt->close();
} else {
    // Nếu chưa đăng nhập, wishlist_count = 0
    $wishlist_count = 0;
}




// Xử lý thêm vào yêu thích
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['action'])) {
    $productId = intval($_POST['product_id']);
    $action = $_POST['action'];

    // Kiểm tra user đăng nhập
    if (!$user_id) {
        echo "Bạn cần đăng nhập để thêm sản phẩm vào yêu thích.";
        exit();
    }

    if ($action === "add") {
        // Kiểm tra nếu chưa có trong danh sách yêu thích
        $checkQuery = "SELECT * FROM yeuthich WHERE product_id = ? AND user_id = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("ii", $productId, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Thêm vào yêu thích
            $insertQuery = "INSERT INTO yeuthich (product_id, user_id) VALUES (?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("ii", $productId, $user_id);
            $stmt->execute();
        }
        echo "success";

    } elseif ($action === "remove") {
        // Xóa khỏi danh sách yêu thích
        $deleteQuery = "DELETE FROM yeuthich WHERE product_id = ? AND user_id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("ii", $productId, $user_id);
        $stmt->execute();
        echo "success";
    } else {
        echo "Lỗi: Hành động không hợp lệ!";
    }
}



// Truy vấn bảng 'yeuthich' để lấy tất cả 'product_id' của user_id đang đăng nhập sanphamyeuthich.php
$query_yeuthich = "SELECT product_id FROM yeuthich WHERE user_id = ?";
$stmt = $conn->prepare($query_yeuthich);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result_yeuthich = $stmt->get_result();

// Lưu tất cả các product_id vào mảng
$wishlist_products = [];
if ($result_yeuthich->num_rows > 0) {
    while ($wishlist_product = $result_yeuthich->fetch_assoc()) {
        $wishlist_products[] = $wishlist_product['product_id'];
    }
}

// Lấy thông tin chi tiết cho tất cả sản phẩm yêu thích
$product_details = [];
foreach ($wishlist_products as $product_id) {
    $query_product = "SELECT id, name, price, sale, img FROM tra_banhngot WHERE id = ?";
    $stmt = $conn->prepare($query_product);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result_product = $stmt->get_result();

    if ($result_product->num_rows > 0) {
        $product = $result_product->fetch_assoc();
        $product_details[] = $product; 
    }
}










// Xử lý yêu cầu từ phía client (JavaScript)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Kiểm tra xem yêu cầu có xóa sản phẩm không
    if (isset($_POST['action']) && $_POST['action'] == 'remove') {
        // Xóa sản phẩm khỏi bảng 'yeuthich'
        $deleteQuery = "DELETE FROM yeuthich WHERE product_id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $productId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Sản phẩm với ID: " . $productId . " đã được xóa khỏi yêu thích!";
        } else {
            echo "Không tìm thấy sản phẩm với ID: " . $productId;
        }
    }
}




$sql_tra = "SELECT id, name FROM tra_banhngot WHERE `group` = 1 ORDER BY id ASC";
$result_tra = $conn->query($sql_tra);

if (!$result_tra) {
    die("Query error: " . $conn->error);
}



$sql_banhkem = "SELECT id, name FROM tra_banhngot WHERE `group` = 2 ORDER BY id ASC";
$result_banhkem = $conn->query($sql_banhkem);

if (!$result_banhkem) {
    die("Query error: " . $conn->error);
}



$sql_banhngot = "SELECT id, name FROM tra_banhngot WHERE `group` = 3 ORDER BY id ASC";
$result_banhngot = $conn->query($sql_banhngot);

if (!$result_banhngot) {
    die("Query error: " . $conn->error);
}



$sql_banhkho = "SELECT id, name FROM tra_banhngot WHERE `group` = 4 ORDER BY id ASC";
$result_banhkho = $conn->query($sql_banhkho);

if (!$result_banhkho) {
    die("Query error: " . $conn->error);
}



$sql_douong = "SELECT id, name FROM tra_banhngot WHERE `group` = 5 ORDER BY id ASC";
$result_douong = $conn->query($sql_douong);

if (!$result_douong) {
    die("Query error: " . $conn->error);
}



$sql_tinmoi = "SELECT * FROM tin_moi ORDER BY id ASC"; 
$result_tinmoi = $conn->query($sql_tinmoi);


// Truy vấn chỉ lấy những dòng có sale > 0
$sql_sale = "SELECT * FROM tra_banhngot WHERE sale > 0 ORDER BY id ASC";
$result_sale = $conn->query($sql_sale);



//đăng ký
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // Kiểm tra xem form có phải là POST không
    // Kiểm tra xem các trường dữ liệu có tồn tại trong $_POST không
    if (isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['email']) && isset($_POST['PhoneNumber']) && isset($_POST['password'])) {
        // Lấy dữ liệu từ form
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $Email = $_POST['email'];
        $PhoneNumber = $_POST['PhoneNumber'];
        $password = $_POST['password'];

        // Kiểm tra email đã tồn tại chưa
        $check_Email = $conn->prepare("SELECT * FROM account WHERE Email = ?");
        $check_Email->bind_param("s", $Email);
        $check_Email->execute();
        $result_dangki = $check_Email->get_result();
        
        if ($result_dangki->num_rows > 0) {
            // Nếu email đã tồn tại, trả về thông báo lỗi mà không thực hiện insert
            $errorMessage = "Email đã tồn tại!";
        } else {
            // Mã hóa mật khẩu
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Chèn dữ liệu vào bảng Account
            $sql_dangki = $conn->prepare("INSERT INTO Account (lastName, firstName, Email, PhoneNumber, password) VALUES (?, ?, ?, ?, ?)");
            $sql_dangki->bind_param("sssss", $lastName, $firstName, $Email, $PhoneNumber, $hashed_password);

            if ($sql_dangki->execute()) {
                // Sau khi đăng ký thành công, chuyển hướng sang trang login.php
                echo '<script type="text/javascript">window.location.href="login.php";</script>';
                exit; // Dừng script để không chạy thêm mã dưới đây
            } else {
                $errorMessage = "Lỗi: " . $sql_dangki->error;
            }
        }
    } else {
        $errorMessage = "Vui lòng điền đầy đủ thông tin.";
    }
}


//liên hệ
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['contact']['Name'];
    $email = $_POST['contact']['email'];
    $phone = $_POST['contact']['phone'];
    $message = $_POST['contact']['body'];

    $sql_contact = "INSERT INTO contact_info (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_contact);
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        echo "<script> window.location.href='../';</script>";
    } else {
        echo "<script>alert('Lỗi khi gửi thông tin!');</script>";
    }
    $stmt->close();
}


// Kiểm tra xem user_id có tồn tại trong session không
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Lấy user_id từ session

    // Truy vấn giỏ hàng của người dùng theo user_id
    $sql_giohang = "SELECT id, name, price, img, so_luong FROM giohang WHERE user_id = ?";
    $stmt = $conn->prepare($sql_giohang);
    $stmt->bind_param("i", $user_id); // Ràng buộc tham số user_id
    $stmt->execute();
    $result_giohang = $stmt->get_result();

    // Truy vấn tổng số lượng sản phẩm trong giỏ hàng của user_id
    $sql_so_luong = "SELECT SUM(so_luong) AS total_quantity FROM giohang WHERE user_id = ?";
    $stmt_so_luong = $conn->prepare($sql_so_luong);
    $stmt_so_luong->bind_param("i", $user_id); // Ràng buộc tham số user_id
    $stmt_so_luong->execute();
    $result_so_luong = $stmt_so_luong->get_result();
// Kiểm tra nếu có kết quả trả về từ truy vấn
if ($row_so_luong = $result_so_luong->fetch_assoc()) {
    $total_quantity = $row_so_luong['total_quantity'] ? $row_so_luong['total_quantity'] : 0;  // Nếu không có sản phẩm, gán $total_quantity = 0
} else {
    $total_quantity = 0;  // Trường hợp không có dữ liệu
}    // Lấy số lượng sản phẩm trong giỏ hàng
    $count_items = $result_giohang->num_rows;
} else {
    // Nếu người dùng chưa đăng nhập (đã đăng xuất), gán $total_quantity = 0
    $total_quantity = 0;
    $count_items = 0;  // Không có giỏ hàng khi đăng xuất

}



?>




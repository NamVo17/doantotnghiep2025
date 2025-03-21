<!DOCTYPE html>
<html lang="en">
<?php
include(__DIR__ . '/../config/config.php');
include 'admin_auth.php';
error_reporting(0);
if (isset($_POST['submit'])) {
    // Lấy dữ liệu từ form và tránh SQL Injection
    $res_name = mysqli_real_escape_string($conn, $_POST['res_name']);
    $d_name = mysqli_real_escape_string($conn, $_POST['d_name']);
    $about = mysqli_real_escape_string($conn, $_POST['about']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $sale = mysqli_real_escape_string($conn, $_POST['sale']);
    
    // Xử lý ảnh chính
    $imagePath = "";
    if (!empty($_FILES['file']['name'])) {
        $fname = basename($_FILES['file']['name']);
        $temp = $_FILES['file']['tmp_name'];
        $store = "../image/" . $fname;
        if (move_uploaded_file($temp, $store)) {
            $imagePath = "/image/" . $fname;
        }
    }
    
    // Xử lý ảnh phụ
    $imagePath1 = "";
    if (!empty($_FILES['file1']['name'])) {
        $fname1 = basename($_FILES['file1']['name']);
        $temp1 = $_FILES['file1']['tmp_name'];
        $store1 = "../image/" . $fname1;
        if (move_uploaded_file($temp1, $store1)) {
            $imagePath1 = "/image/" . $fname1;
        }
    }
    
    $product_types = [
        "Trà" => 1,
        "Bánh Kem" => 2,
        "Bánh Ngọt" => 3,
        "Bánh Khô" => 4,
        "Đồ Uống" => 5
    ];
    
    $group_value = isset($_POST['res_name']) ? $product_types[$_POST['res_name']] : null;
    
    // Chỉ lưu vào CSDL nếu đã chọn loại sản phẩm hợp lệ
    if ($group_value !== null) {
        $sql = "INSERT INTO tra_banhngot (`group`, `name`, `introduce`, `price`, `sale`, `img`, `img1`) 
                VALUES ('$group_value', '$_POST[d_name]', '$_POST[about]', '$_POST[price]', '$_POST[sale]', '$imagePath', '$imagePath1')";
    
        if (mysqli_query($conn, $sql)) {
            $success = '<div class="alert alert-success">Thêm sản phẩm thành công!</div>';
        } else {
            $error = '<div class="alert alert-danger">Lỗi khi thêm sản phẩm: ' . mysqli_error($conn) . '</div>';
        }
    } else {
        $error = '<div class="alert alert-danger">Vui lòng chọn loại sản phẩm!</div>';
    }
}

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Add Menu</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <div id="main-wrapper">
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/user0-icn.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="/about/logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php"> <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_menu.php">All Menues</a></li>
                                <li><a href="add_menu.php">Add Menu</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="hide-menu">Orders</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_orders.php">All Orders</a></li>
                                <li><a href="all_pre_orders.php">All Pre-Orders</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="container-fluid">
                <?php echo $error;
                echo $success; ?>
                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Add Menu</h4>
                        </div>
                        <div class="card-body">
                            <form action='' method='post' enctype="multipart/form-data">
                                <div class="form-body">
                                    <hr>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Name</label>
                                                <input type="text" name="d_name" value="" class="form-control" placeholder="Tên Sản Phẩm">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Description</label>
                                                <input type="text" name="about" value="" class="form-control form-control-danger" placeholder="Mô tả">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Price </label>
                                                <input type="text" name="price" value="" class="form-control" placeholder="Giá ">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Sale </label>
                                                <input type="text" name="sale" value="" class="form-control" placeholder="Giảm giá ">
                                            </div>
                                        </div>
                                        <div class="form-group has-danger">
                                            <label class="control-label">Image</label><br>
                                            <input type="file" name="file" class="form-control form-control-danger" onchange="previewFile()">
                                            <p id="file-name"></p>
                                        </div>
                                        <script>
                                            function previewFile() {
                                                var input = document.querySelector('input[name="file"]');
                                                var preview = document.getElementById('preview');
                                                var fileNameText = document.getElementById('file-name');

                                                if (input.files.length > 0) {
                                                    var file = input.files[0];
                                                    var reader = new FileReader();
            
                                                    reader.onload = function(e) {
                                                    preview.src = e.target.result;
                                                    };
                                                    reader.readAsDataURL(file);

                                                    fileNameText.textContent = file.name;
                                                }
                                            }

                                            function previewFile1() {
                                                var input = document.querySelector('input[name="file1"]');
                                                var preview = document.getElementById('preview1');
                                                var fileNameText = document.getElementById('file-name1');

                                                if (input.files.length > 0) {
                                                    var file = input.files[0];
                                                    var reader = new FileReader();
            
                                                    reader.onload = function(e) {
                                                    preview1.src = e.target.result;
                                                    };
                                                    reader.readAsDataURL(file);

                                                    fileNameText.textContent = file.name;
                                                }
                                            }
                                        </script>
                                        <div class="form-group has-danger">
                                            <label class="control-label">Image1</label><br>
                                            <input type="file" name="file1" class="form-control form-control-danger" onchange="previewFile()">
                                            <p id="file-name"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Type</label>
                                            <select name="res_name" class="form-control custom-select">
                                                <option value="">--Loại sản phẩm--</option>
                                                <option value="Trà">Trà</option>
                                                <option value="Bánh Kem">Bánh Kem</option>
                                                <option value="Bánh Ngọt">Bánh Ngọt</option>
                                                <option value="Bánh Khô">Bánh Khô</option>
                                                <option value="Đồ Uống">Đồ Uống</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <div class="form-actions">
                                <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                <a href="all_menu.php" class="btn btn-inverse">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>

</body>

</html>
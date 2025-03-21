<!DOCTYPE html>
<html lang="en">
<?php
include(__DIR__ . '/../config/config.php');
error_reporting(0);

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>View Order</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script language="javascript" type="text/javascript">
        var popUpWin = 0;

        function popUpWindow(URLStr, left, top, width, height) {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 1000 + ',height=' + 1000 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
        }
    </script>
</head>

<body class="fix-header fix-sidebar">
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
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
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
                <div class="row">
                    <div class="col-12">
                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">View Order</h4>
                                </div>
                                <div class="table-responsive m-t-20">
                                    <?php


                                    if (isset($_GET['user_upd'])) {
                                        $order_id = intval($_GET['user_upd']); // Ép kiểu để tránh SQL Injection
                                        $sql = "SELECT * FROM donhang WHERE id = $order_id";
                                        $query = mysqli_query($conn, $sql);

                                        if ($rows = mysqli_fetch_array($query)) {
                                            // Lấy danh sách sản phẩm trong đơn hàng
                                            $id_sanpham_list = explode(';', $rows['id_sanpham']);
                                            $titles = [];

                                            foreach ($id_sanpham_list as $id_sanpham) {
                                                $id_sanpham = trim($id_sanpham);
                                                $product_query = mysqli_query($conn, "SELECT name FROM tra_banhngot WHERE id = '$id_sanpham'");
                                                if ($product_row = mysqli_fetch_assoc($product_query)) {
                                                    $titles[] = $product_row['name'];
                                                }
                                            }

                                            $title_str = implode(', ', $titles); // Danh sách tên sản phẩm

                                    ?>
                                            <table id="myTable" class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Username:</strong></td>
                                                        <td>
                                                            <center><?php echo $rows['ten']; ?></center>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Title:</strong></td>
                                                        <td>
                                                            <center><?php echo $title_str; ?></center>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Phone:</strong></td>
                                                        <td>
                                                            <center><?php echo $rows['sdt']; ?></center>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Price:</strong></td>
                                                        <td>
                                                            <center><?php echo number_format($rows['tong_cong']); ?> VND</center>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Address:</strong></td>
                                                        <td>
                                                            <center><?php echo $rows['dia_chi']; ?></center>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Date:</strong></td>
                                                        <td>
                                                            <center><?php echo $rows['ngay_tao']; ?></center>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Status:</strong></td>
                                                        <td>
                                                            <select id="status-<?php echo $rows['id']; ?>" class="form-control">
                                                                <option value="NULL" <?php if ($rows['trang_thai'] == "" || $rows['trang_thai'] == "NULL") echo 'selected'; ?>>Dispatch</option>
                                                                <option value="processing" <?php if ($rows['trang_thai'] == "processing") echo 'selected'; ?>>On The Way!</option>
                                                                <option value="closed" <?php if ($rows['trang_thai'] == "closed") echo 'selected'; ?>>Delivered</option>
                                                                <option value="rejected" <?php if ($rows['trang_thai'] == "rejected") echo 'selected'; ?>>Cancelled</option>
                                                            </select>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <center>
                                                                <button type="button" class="btn btn-primary update-order-btn"
                                                                    data-order-id="<?php echo htmlentities($rows['id']); ?>">
                                                                    Update Order Status
                                                                </button>
                                                            </center>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                    <?php
                                        } else {
                                            echo "<p>Không tìm thấy đơn hàng!</p>";
                                        }
                                    } else {
                                        echo "<p>Không có ID đơn hàng được cung cấp!</p>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.update-order-btn').click(function() {
                var orderId = $(this).data('order-id');
                var newStatus = $('#status-' + orderId).val();

                $.ajax({
                    url: 'order_update.php',
                    type: 'POST',
                    data: {
                        order_id: orderId,
                        status: newStatus
                    },
                    success: function(response) {
                        alert(response); // Hiển thị thông báo cập nhật thành công
                    },
                    error: function() {
                        alert('Lỗi khi cập nhật trạng thái đơn hàng!');
                    }
                });
            });
        });
    </script>

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
</body>

</html>
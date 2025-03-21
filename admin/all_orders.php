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
    <title>All Orders</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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
                <div class="row">
                    <div class="col-12">
                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">All Orders</h4>
                                </div>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>User</th>
                                                <th>Title</th>
                                                <th>Phone</th>
                                                <th>Price</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th>Reg-Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Lấy danh sách đơn hàng
                                            $sql = "SELECT * FROM donhang";
                                            $query = mysqli_query($conn, $sql);

                                            if (!mysqli_num_rows($query) > 0) {
                                                echo '<td colspan="8"><center>No Orders</center></td>';
                                            } else {
                                                while ($rows = mysqli_fetch_array($query)) {
                                                    // Tách id_sanpham (ví dụ: "1;20")
                                                    $id_sanpham_list = explode(';', $rows['id_sanpham']);
                                                    $titles = [];

                                                    foreach ($id_sanpham_list as $id_sanpham) {
                                                        $id_sanpham = trim($id_sanpham);
                                                        $product_query = mysqli_query($conn, "SELECT name FROM tra_banhngot WHERE id = '$id_sanpham'");
                                                        if ($product_row = mysqli_fetch_assoc($product_query)) {
                                                            $titles[] = $product_row['name'];
                                                        }
                                                    }

                                                    $title_str = implode(', ', $titles); // Ghép thành chuỗi hiển thị

                                                    echo '<tr>
                                                            <td>' . $rows['ten'] . '</td>
                                                            <td>' . $title_str . '</td>
                                                            <td>' . $rows['sdt'] . '</td>
                                                            <td>' . number_format($rows['tong_cong']) . ' VND</td>
                                                            <td>' . $rows['dia_chi'] . '</td>';

                                                    $status = $rows['trang_thai'];
                                                    if ($status == "" or $status == "NULL") {
                                                        echo '<td><button type="button" class="btn btn-info"><span class="fa fa-bars"></span> Dispatch</button></td>';
                                                    } elseif ($status == "processing") {
                                                        echo '<td><button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"></span> On The Way!</button></td>';
                                                    } elseif ($status == "closed") {
                                                        echo '<td><button type="button" class="btn btn-primary"><span class="fa fa-check-circle"></span> Delivered</button></td>';
                                                    } elseif ($status == "rejected") {
                                                        echo '<td><button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Cancelled</button></td>';
                                                    }

                                                    echo '<td>' . $rows['ngay_tao'] . '</td>
                                                            <td>
                                                                <a href="delete_orders.php?order_del=' . $rows['id'] . '" onclick="return confirm(\'Are you sure?\');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                                                                <a href="view_order.php?user_upd=' . $rows['id'] . '" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                                            </td>
                                                        </tr>';
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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

</body>

</html>
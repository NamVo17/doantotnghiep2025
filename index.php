<!DOCTYPE html>
<html lang="en">
<?php
include("about/connect.php");
$_SESSION['checkout_token'] = bin2hex(random_bytes(32)); // Tạo token ngẫu nhiên
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null';
echo "<script>const userId = " . $userId . ";</script>";
?>

<head>
    <meta charset="UTF-8" />
    <meta name="theme-color" content="#c9db32">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Sweet Tea House</title>
    <link rel="icon" type="image/png" href="/image/logo.png">
    <script src="/js/jquery.js" type="text/javascript"></script>
    <script src="/js/swiper.js" type="text/javascript"></script>
    <script src="/js/lazy.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/css/bootstrap-4-3-min-index.css">
    <link href="/css/main.scss.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/index.scss.css" rel="stylesheet" type="text/css" media="all">
    <link href="./css/swiper.scss.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/js/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .section_chinhsach .container {
            display: flex;
            justify-content: center;
        }
        .chinhsach-swiper {
            display: flex;
            justify-content: center;
            max-width: 100%;
        }

        .swiper-wrapper {
            display: flex;
            justify-content: center;
            width: fit-content;
        }

        .section_danhmuc .container {
            display: flex;
            justify-content: center;
        }

        .danhmuc-slider {
            display: flex;
            justify-content: center;
            max-width: 100%;
        }

        .swiper-wrapper {
            display: flex;
            justify-content: center;
            width: fit-content;
        }


</style>
</head>
<body>
    <script src="/js/chatbot.js"></script>
    <div class="opacity_menu"></div>
    <header class="header" style="min-height: 90px;">
        <div class="container">
            <div class="row row-header align-items-center">
                <div class="menu-bar d-lg-none d-flex">
                    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="bars" role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-bars fa-w-14">
                        <path fill="#ffffff"
                            d="M436 124H12c-6.627 0-12-5.373-12-12V80c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12z"
                            class=""></path>
                    </svg>
                </div>
                <div class="  col-lg-2">
                    <a class="logo" title="Logo">
                        <img width="270" height="256" src="image/logo.png" alt="Sweet Tea House">
                    </a>
                </div>
                <div class="col-lg-8 header-menu">
                    <div style="    position: relative;">
                        <div class="header-menu-des">
                            <nav class="header-nav">
                                <ul class="item_big">
                                    <li class="d-lg-none d-block account-mb">
                                        <ul>
                                            <li><a href="about/register.php" title="Đăng ký">Đăng ký</a></li>
                                            <li><a href="about/login.php" title="Đăng nhập">Đăng nhập</a></li>
                                        </ul>
                                    </li>
                                    <li class="d-block d-lg-none title-danhmuc"><span>Menu chính</span></li>
                                    <li class="nav-item active  "><a class="a-img" href="index.php" title="Trang chủ"> Trang chủ</a></li>
                                    <li class="nav-item  "><a class="a-img" href="about/gioithieu.php" title="Giới thiệu">Giới thiệu</a></li>
                                    <li class="nav-item   has-mega "><a class="a-img caret-down" href="index.php#section_product_tab" title="Sản phẩm">Sản phẩm</a>
                                        <i class="fa fa-caret-down"></i>
                                        <div class="mega-content d-lg-block d-none">
                                            <ul class="level0">
                                                <li class="level1 parent item fix-navs" data-title="Trà" 
                                                data-link="index.php#section_product_tab">
                                                <a class="hmega" href="index.php#section_product_tab" title="Trà">Trà</a>
                                                    <ul class="level1">
                                                        <?php 
                                                        $count = 0;
                                                        while ($count < 5 && $row = $result_tra->fetch_assoc()): 
                                                        ?>
                                                            <li class="level2">
                                                                <a href="index.php#section_product_tab" title="<?php echo $row['name']; ?>">
                                                                    <?php echo $row['name']; ?>
                                                                </a>
                                                            </li>
                                                        <?php 
                                                            $count++; 
                                                        endwhile; 
                                                        // Kiểm tra nếu còn sản phẩm chưa hiển thị thì thêm "……"
                                                        if ($row = $result_tra->fetch_assoc()): 
                                                        ?>
                                                            <li class="level2"><a href="#"> .      .     .     </a></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </li>
                                                <li class="level1 parent item fix-navs" data-title="Bánh Kem" 
                                                    data-link="index.php#section_product_tab">
                                                    <a class="hmega" href="index.php#section_product_tab" title="Bánh Kem">Bánh Kem</a>
                                                    <ul class="level1">
                                                        <?php 
                                                        $count = 0;
                                                        while ($count < 5 && $row = $result_banhkem->fetch_assoc()): 
                                                        ?>
                                                            <li class="level2">
                                                                <a href="index.php#section_product_tab" title="<?php echo $row['name']; ?>">
                                                                    <?php echo $row['name']; ?>
                                                                </a>
                                                            </li>
                                                        <?php 
                                                            $count++; 
                                                        endwhile; 
                                                        // Kiểm tra nếu còn sản phẩm chưa hiển thị thì thêm "……"
                                                        if ($row = $result_banhkem->fetch_assoc()): 
                                                        ?>
                                                            <li class="level2"><a href="#">……</a></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </li>
                                                <li class="level1 parent item fix-navs" data-title="Bánh Ngọt" 
                                                    data-link="index.php#section_product_tab">
                                                    <a class="hmega" href="index.php#section_product_tab" title="Bánh Ngọt">Bánh Ngọt</a>
                                                    <ul class="level1">
                                                        <?php 
                                                        $count = 0;
                                                        while ($count < 5 && $row = $result_banhngot->fetch_assoc()): 
                                                        ?>
                                                            <li class="level2">
                                                                <a href="index.php#section_product_tab" title="<?php echo $row['name']; ?>">
                                                                    <?php echo $row['name']; ?>
                                                                </a>
                                                            </li>
                                                        <?php 
                                                            $count++; 
                                                        endwhile; 
                                                        // Kiểm tra nếu còn sản phẩm chưa hiển thị thì thêm "……"
                                                        if ($row = $result_banhngot->fetch_assoc()): 
                                                        ?>
                                                            <li class="level2"><a href="#">……</a></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </li>
                                                <li class="level1 parent item fix-navs" data-title="Bánh Khô" 
                                                    data-link="index.php#section_product_tab">
                                                    <a class="hmega" href="index.php#section_product_tab" title="Bánh Khô">Bánh Khô</a>
                                                    <ul class="level1">
                                                        <?php 
                                                        $count = 0;
                                                        while ($count < 5 && $row = $result_banhkho->fetch_assoc()): 
                                                        ?>
                                                            <li class="level2">
                                                                <a href="index.php#section_product_tab" title="<?php echo $row['name']; ?>">
                                                                    <?php echo $row['name']; ?>
                                                                </a>
                                                            </li>
                                                        <?php 
                                                            $count++; 
                                                        endwhile; 
                                                        // Kiểm tra nếu còn sản phẩm chưa hiển thị thì thêm "……"
                                                        if ($row = $result_banhkho->fetch_assoc()): 
                                                        ?>
                                                            <li class="level2"><a href="#">……</a></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </li>
                                                <li class="level1 parent item fix-navs" data-title="Đồ Uống" 
                                                    data-link="index.php#section_product_tab">
                                                    <a class="hmega" href="index.php#section_product_tab" title="Đồ Uống">Đồ Uống</a>
                                                    <ul class="level1">
                                                        <?php 
                                                        $count = 0;
                                                        while ($count < 5 && $row = $result_douong->fetch_assoc()): 
                                                        ?>
                                                            <li class="level2">
                                                                <a href="index.php#section_product_tab" title="<?php echo $row['name']; ?>">
                                                                    <?php echo $row['name']; ?>
                                                                </a>
                                                            </li>
                                                        <?php 
                                                            $count++; 
                                                        endwhile; 
                                                        // Kiểm tra nếu còn sản phẩm chưa hiển thị thì thêm "……"
                                                        if ($row = $result_douong->fetch_assoc()): 
                                                        ?>
                                                            <li class="level2"><a href="#">……</a></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item  ">
                                        <a class="a-img" href="about/tintuc.php" title="Tin tức">Tin tức</a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a class="a-img" href="about/lienhe.php" title="Liên hệ">Liên hệ</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 header-control">
                    <ul class="ul-control">
                        <li class="header-account d-lg-flex d-none">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400" height="400" width="400"
                                    version="1.1">
                                    <g transform="matrix(1.3333333,0,0,-1.3333333,0,400)">
                                        <g transform="scale(0.1)">
                                            <path style="fill-opacity:1;fill-rule:nonzero;stroke:none"
                                                d="m 1506.87,2587.11 c -225.04,0 -408.14,-183.08 -408.14,-408.11 0,-225.06 183.1,-408.13 408.14,-408.13 225.02,0 408.13,183.07 408.13,408.13 0,225.03 -183.11,408.11 -408.13,408.11 z m 0,-1038.56 c -347.64,0 -630.432,282.79 -630.432,630.45 0,347.63 282.792,630.43 630.432,630.43 347.63,0 630.42,-282.8 630.42,-630.43 0,-347.66 -282.79,-630.45 -630.42,-630.45 v 0">
                                            </path>
                                            <path style="fill-opacity:1;fill-rule:nonzero;stroke:none"
                                                d="M 399.648,361.789 H 2614.07 c -25.06,261.531 -139.49,503.461 -327.47,689.831 -124.25,123.14 -300.78,193.96 -483.86,193.96 h -591.76 c -183.61,0 -359.601,-70.82 -483.863,-193.96 C 539.148,865.25 424.719,623.32 399.648,361.789 Z M 2730.69,139.461 H 283.035 c -61.558,0 -111.16,49.59 -111.16,111.16 0,363.438 141.68,704 398.32,959.019 165.657,164.55 399.414,258.82 640.785,258.82 h 591.76 c 241.94,0 475.14,-94.27 640.8,-258.82 256.63,-255.019 398.31,-595.581 398.31,-959.019 0,-61.57 -49.59,-111.16 -111.16,-111.16 v 0">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <?php
                            if (isset($_SESSION['user'])) {
                                $user = $_SESSION['user'];
                                echo '<ul>
                                <li><a href="#" title="Tài khoản">' . $user['lastName'] . ' ' . $user['firstName'] . '</a></li>
                                <li><a href="about/logout.php" title="Đăng xuất">Đăng xuất</a></li>
                                </ul>';
                            } else {
                                echo '<ul>
                                <li><a href="about/register.php" title="Đăng ký">Đăng ký</a></li>
                                <li><a href="about/login.php" title="Đăng nhập">Đăng nhập</a></li>
                                </ul>';
                            }
                            ?>
                        </li>
                        <li class="header-wishlist d-flex">
                            <a title="Sản phẩm yêu thích" href="about/sanphamyeuthich.php" class="button-wishlist">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400" height="400"
                                        width="400" version="1.1">
                                        <g transform="matrix(1.3333333,0,0,-1.3333333,0,400)">
                                            <g transform="scale(0.1)">
                                                <path style="fill-opacity:1;fill-rule:nonzero;stroke:none"
                                                    d="m 903,2424.4 c 157.9,0 306.4,-61.5 418.1,-173.1 l 134.8,-134.9 c 20.7,-20.6 48.1,-32 77.1,-32 29,0 56.4,11.4 77,32 l 133.7,133.7 c 111.7,111.6 259.9,173.1 417.5,173.1 156.91,0 305,-61.3 416.8,-172.5 111.2,-111.3 172.5,-259.5 172.5,-417.5 0.6,-157.3 -60.69,-305.5 -172.5,-417.4 L 1531.5,373.5 487.402,1417.6 c -111.601,111.7 -173.105,259.9 -173.105,417.5 0,158.1 61.199,306.1 172.5,416.8 111.308,111.2 259.101,172.5 416.203,172.5 z m 1829.7,-19.6 c 0,0 0,0 -0.1,0 -152.4,152.4 -355.1,236.3 -570.9,236.3 -215.7,0 -418.7,-84.1 -571.5,-236.9 l -56.9,-57 -58.2,58.2 c -153.1,153.1 -356.3,237.5 -572.1,237.5 -215.305,0 -417.902,-83.9 -570.305,-236.3 -153,-153 -236.8942,-356 -236.2966,-571.5 0,-215 84.4026,-417.8 237.4966,-571 L 1454.7,143.301 c 20.5,-20.403 48.41,-32.199 76.8,-32.199 28.7,0 56.7,11.5 76.7,31.597 L 2731.5,1261.8 c 152.7,152.7 236.8,355.7 236.8,571.4 0.7,216 -83,419 -235.6,571.6">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span class="count js-wishlist-count js-wishlist-count-mobile"><?= $wishlist_count ?></span>
                            </a>
                        </li>
                        <li class="header-cart block-cart d-flex">
                            <a href="about/giohang.php" title="Giỏ hàng">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 297.78668 398.66666" height="398.66666" width="297.78668" version="1.1">
                                        <g transform="matrix(1.3333333,0,0,-1.3333333,0,398.66667)">
                                            <g transform="scale(0.1)">
                                                <path style="fill-opacity:1;fill-rule:nonzero;stroke:none" d="M 2233.36,2432.71 H 0 V 0 h 2233.36 v 2432.71 z m -220,-220 V 220 H 220.004 V 2212.71 H 2021.36"></path>
                                                <path xmlns="http://www.w3.org/2000/svg" style="fill-opacity:1;fill-rule:nonzero;stroke:none" d="m 1116.68,2990 v 0 C 755.461,2990 462.637,2697.18 462.637,2335.96 V 2216.92 H 1770.71 v 119.04 c 0,361.22 -292.82,654.04 -654.03,654.04 z m 0,-220 c 204.58,0 376.55,-142.29 422.19,-333.08 H 694.492 C 740.117,2627.71 912.102,2770 1116.68,2770"></path>
                                                <path xmlns="http://www.w3.org/2000/svg" style="fill-opacity:1;fill-rule:nonzero;stroke:none" d="M 1554.82,1888.17 H 678.543 v 169.54 h 876.277 v -169.54"></path>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span class="count count_item_pr"><?= $total_quantity ?></span> <!-- Số lượng sản phẩm trong giỏ hàng -->
                            </a>
                            <div class="top-cart-content">
                                <div class="CartHeaderContainer">
                                    <form action="/cart" method="post" novalidate="" class="cart ajaxcart cartheader">
                                        <div class="ajaxcart__inner ajaxcart__inner--has-fixed-footer cart_body items">
                                            <?php
                                            $total_price = 0;
                                            // Kiểm tra nếu giỏ hàng có sản phẩm
                                            if ($count_items > 0) {

                                                while ($row = $result_giohang->fetch_assoc()) {
                                                    $total_price += $row['price'] * $row['so_luong'];
                                            ?>
                                                    <div class="ajaxcart__row">
                                                        <div class="ajaxcart__product cart_product" data-line="<?= $row['id']; ?>">
                                                            <a href="product.php?id=<?= $row['id']; ?>" class="ajaxcart__product-image cart_image" title="<?= $row['name']; ?>">
                                                                <img width="80" height="80" src="<?= $row['img']; ?>" alt="<?= $row['name']; ?>">
                                                            </a>
                                                            <div class="grid__item cart_info">
                                                                <div class="ajaxcart__product-name-wrapper cart_name">
                                                                    <a href="product.php?id=<?= $row['id']; ?>" class="ajaxcart__product-name h4" title="<?= $row['name']; ?>"><?= $row['name']; ?></a>
                                                                    <a class="cart__btn-remove remove-item-cart ajaxifyCart--remove" href="javascript:;" data-id="<?= $row['id']; ?>">Xóa</a>
                                                                </div>
                                                                <div class="grid">
                                                                    <div class="grid__item one-half cart_select cart_item_name">
                                                                        <label class="cart_quantity">Số lượng</label>
                                                                        <div class="ajaxcart__qty input-group-btn">
                                                                            <button type="button" class="ajaxcart__qty-adjust ajaxcart__qty--minus items-count" data-id="<?= $row['id']; ?>" data-qty="<?= $row['so_luong']; ?>" aria-label="-">-</button>
                                                                            <input type="text" name="updates[]" class="ajaxcart__qty-num number-sidebar" maxlength="3" value="<?= $row['so_luong']; ?>" min="0" data-id="<?= $row['id']; ?>" aria-label="quantity">
                                                                            <button type="button" class="ajaxcart__qty-adjust ajaxcart__qty--plus items-count" data-id="<?= $row['id']; ?>" data-qty="<?= $row['so_luong']; ?>" aria-label="+">+</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid__item one-half text-right cart_prices">
                                                                        <span class="cart-price"><?= number_format($row['price'] * $row['so_luong'], 0, ',', '.') ?>₫</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            } else {
                                            }
                                            ?>
                                        </div>
                                        <div class="ajaxcart__footer ajaxcart__footer--fixed cart-footer">
                                            <div class="ajaxcart__subtotal">
                                                <div class="cart__subtotal">
                                                    <div class="cart__col-6">Tổng tiền:</div>
                                                    <div class="text-right cart__totle">
                                                        <span class="total-price"><?= number_format($total_price, 0, ',', '.') ?>₫</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cart__btn-proceed-checkout-dt">
                                            <?php
                                                if (!isset($_SESSION['user_id'])) {
                                                echo '<button onclick="location.href=\'/index.php\'" type="button" class="button btn btn-default"> Thanh toán</button>';
                                                } else {
                                                $_SESSION['checkout_token'] = bin2hex(random_bytes(32)); // Tạo token bảo vệ
                                                echo '<button onclick="location.href=\'/about/checkout.php?token=' . $_SESSION['checkout_token'] . '\'" type="button" class="button btn btn-default">Thanh toán</button>';
                                                }
                                            ?>    
                                            </div>                                    
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                // Xử lý xóa sản phẩm khỏi giỏ hàng
                $(".remove-item-cart").on("click", function() {
                    var productId = $(this).data("id"); // Lấy id sản phẩm
                    var line = $(this).closest(".ajaxcart__row"); // Lấy dòng sản phẩm cần xóa

                    $.ajax({
                        url: "action/xoa_sanpham.php", // Gọi file PHP xử lý xóa sản phẩm
                        method: "POST",
                        data: {
                            id: productId
                        },
                        success: function(response) {
                            // Xóa sản phẩm khỏi giao diện sau khi xóa thành công
                            line.remove();
                            updateTotalPrice(); // Cập nhật lại tổng tiền
                            // Cập nhật lại số lượng sản phẩm trong giỏ hàng
                            var totalQuantity = 0;

                            // Lặp qua tất cả các sản phẩm trong giỏ hàng và cộng lại số lượng
                            $(".ajaxcart__row").each(function() {
                                var qty = parseInt($(this).find(".ajaxcart__qty-num").val());
                                totalQuantity += qty;
                            });

                            // Cập nhật lại số lượng sản phẩm trong giỏ hàng
                            $('.count_item_pr').text(totalQuantity); // Cập nhật lại tổng số lượng sản phẩm
                        }
                    });
                });
            });

            // Xử lý tăng số lượng
            $(".ajaxcart__qty--plus").on("click", function() {
                var productId = $(this).data("id"); // Lấy id sản phẩm
                var currentQty = parseInt($("input[data-id='" + productId + "']").val()); // Lấy số lượng hiện tại từ input
                var newQty = currentQty + 1; // Tăng số lượng lên 1

                // Cập nhật lại giá trị trong input
                $("input[data-id='" + productId + "']").val(newQty);

                // Cập nhật lại giá trị data-qty của nút "+"
                $(this).data("qty", newQty);
            });

            // Xử lý giảm số lượng
            $(".ajaxcart__qty--minus").on("click", function() {
                var productId = $(this).data("id"); // Lấy id sản phẩm
                var currentQty = parseInt($("input[data-id='" + productId + "']").val()); // Lấy số lượng hiện tại từ input

                // Kiểm tra nếu số lượng hiện tại > 1, nếu không thì không giảm nữa
                if (currentQty > 1) {
                    var newQty = currentQty - 1; // Giảm số lượng xuống 1

                    // Cập nhật lại giá trị trong input
                    $("input[data-id='" + productId + "']").val(newQty);

                    // Cập nhật lại giá trị data-qty của nút "-"
                    $(this).data("qty", newQty);
                }
            });

            function updateTotalPrice() {
                var totalPrice = 0;
                $(".ajaxcart__row").each(function() {
                    var price = parseFloat($(this).find(".cart-price").text().replace("₫", "").replace(",", "").trim());
                    totalPrice += price;
                });

                // Định dạng số với dấu phẩy mỗi 3 chữ số
                var formattedPrice = totalPrice.toLocaleString('vi-VN');

                // Cập nhật giá trị tổng vào trang
                $(".total-price").text(formattedPrice + "₫");
            }
        </script>
    </header>
    <div class="bodywrap">
        <section class="section_slider">
            <div class="home-slider swiper-container swiper-container-fade swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                <div class="swiper-wrapper" style="transition-duration: 0ms;">
                    <div class="swiper-slide swiper-slide-prev"
                        style="width: 110px; opacity: 1; transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                        <div class="clearfix thumb-image">
                            <picture>
                                <source media="(min-width: 1200px)"
                                    srcset="/image/banhngotslider.jpg">
                                <source media="(min-width: 992px)"
                                    srcset="/image/banhngotslider.jpg">
                                <source media="(min-width: 569px)"
                                    srcset="/image/banhngotslider.jpg">
                                <source media="(max-width: 567px)"
                                    srcset="/image/banhngotslider.jpg">
                                <img width="1881" height="967"
                                    src="/image/banhngotslider.jpg"
                                    alt="Slider" class="img-responsive">
                            </picture>
                        </div>
                        <div class="thumb-slider-text">
                            <div class="slider-text">
                                <h2 class="title">
                                    Nướng từ tâm, tươi từ bếp
                                </h2>
                                <div class="content">
                                    Giảm đến 20% khi đặt hàng qua web
                                </div>
                                <a class="button" href="#section_product_tab" title="Xem ngay">Xem ngay</a>
                            </div>
                        </div>

                    </div>
                    <div class="swiper-slide swiper-slide-active"
                        style="width: 110px; opacity: 1; transform: translate3d(-110px, 0px, 0px); transition-duration: 0ms;">
                        <div class="clearfix thumb-image">
                            <picture>
                                <source media="(min-width: 1200px)"
                                    srcset="/image/rottra.jpg">
                                <source media="(min-width: 992px)"
                                    srcset="/image/rottra.jpg">
                                <source media="(min-width: 569px)"
                                    srcset="/image/rottra.jpg">
                                <source media="(max-width: 567px)"
                                    srcset="/image/rottra.jpg">
                                <img width="1881" height="967"
                                    src="/image/rottra.jpg"
                                    alt="Slider" class="img-responsive">
                            </picture>
                            <div class="thumb-slider-text">
                                <div class="slider-text">
                                    <h2 class="title">
                                        Ủ vừa đủ, thơm đúng điệu!
                                    </h2>
                                    <div class="content">
                                        Giảm đến 20% khi đặt hàng qua web
                                    </div>
                                    <a class="button" href="#section_product_tab" title="Xem ngay">Xem ngay</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </section>
        <script>
            var swiper = new Swiper('.home-slider', {
                autoplay: true,
                effect: 'fade',
                pagination: {
                    el: '.home-slider .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.home-slider .swiper-button-next',
                    prevEl: '.home-slider .swiper-button-prev',
                },
            });
        </script>
        <section class="section_chinhsach">
            <div class="container">
                <div class="chinhsach-swiper swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events"
                    style="cursor: grab;">
                    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">
                        <a class="swiper-slide swiper-slide-active"
                            style="width: 250px; margin-right: 10px;">
                            <img width="40" height="40"
                                src="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/chinhsach_1.png?1735117293436"
                                alt="Miễn phí vận chuyển">
                            <div class="text">
                                <span class="title">Miễn phí vận chuyển</span>
                                <span class="des">Áp dụng free ship cho tất cả đơn hàng từ 300 nghìn</span>
                            </div>
                        </a>

                        <a class="swiper-slide swiper-slide-next"
                            style="width: 250px; margin-right: 10px;">
                            <img width="40" height="40"
                                src="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/chinhsach_2.png?1735117293436"
                                alt="Đổi trả dễ dàng">
                            <div class="text">
                                <span class="title">Đổi trả dễ dàng</span>
                                <span class="des">Đổi ngay trong ngày nếu như bánh không đúng yêu cầu</span>
                            </div>
                        </a>

                        <a class="swiper-slide"
                            style="width: 250px; margin-right: 10px;">
                            <img width="40" height="40"
                                src="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/chinhsach_3.png?1735117293436"
                                alt="Hỗ trợ nhanh chóng">
                            <div class="text">
                                <span class="title">Hỗ trợ nhanh chóng</span>
                                <span class="des">Gọi Hotline: 19006750 để được hỗ trợ ngay</span>
                            </div>
                        </a>

                        <a class="swiper-slide"
                            style="width: 250px; margin-right: 10px;">
                            <img width="40" height="40"
                                src="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/chinhsach_4.png?1735117293436"
                                alt="Thanh toán đa dạng">
                            <div class="text">
                                <span class="title">Thanh toán đa dạng</span>
                                <span class="des">Thanh toán khi nhận hàng, Napas, Visa, Chuyển Khoản</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="section_danhmuc">
            <div class="container">
                <div class="danhmuc-slider swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events"
                    style="cursor: grab;">
                    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">
                        <div class="swiper-slide swiper-slide-active" style="width: 265px; margin-right: 20px;">
                            <div class="thumb">
                                <picture>
                                    <source media="(max-width: 567px)"
                                        srcset="/image/danhmuc_tra.jpg">
                                    <img width="320" height="400"
                                        src="/image/danhmuc_tra.jpg"
                                        alt="Trà">
                                </picture>
                            </div>
                            <h3>Trà<a href="#section_product_tab" title="Bánh kếp">Xem ngay</a></h3>
                        </div>
                        <div class="swiper-slide swiper-slide-next" style="width: 265px; margin-right: 20px;">
                            <div class="thumb">
                                <picture>
                                    <source media="(max-width: 567px)"
                                        srcset="/image/danhmuc_banhkem.jpg">
                                    <img width="320" height="400"
                                        src="/image/danhmuc_banhkem.jpg"
                                        alt="Bánh kem">
                                </picture>
                            </div>
                            <h3>Bánh kem<a href="#section_product_tab" title="Bánh  kem">Xem ngay</a></h3>
                        </div>
                        <div class="swiper-slide" style="width: 265px; margin-right: 20px;">
                            <div class="thumb">
                                <picture>
                                    <source media="(max-width: 567px)"
                                        srcset="/image/danhmuc_douong.jpg">
                                    <img width="320" height="400"
                                        src="/image/danhmuc_douong.jpg"
                                        alt="Nước cam">
                                </picture>
                            </div>
                            <h3>Nước cam<a href="#section_product_tab" title="Nước cam">Xem ngay</a></h3>
                        </div>
                        <div class="swiper-slide" style="width: 265px; margin-right: 20px;">
                            <div class="thumb">
                                <picture>
                                    <source media="(max-width: 567px)"
                                        srcset="/image/danhmuc_banhquy.jpg">
                                    <img width="420" height="500"
                                        src="/image/danhmuc_banhquy.jpg"
                                        alt="Bánh quy">
                                </picture>
                            </div>
                            <h3>Bánh quy<a href="#section_product_tab" title="Bánh quy">Xem ngay</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section_1_banner">
            <div class="container">
                <a class="thumb-image-banner" href="#section_product_tab" title="Banner">
                    <img width="1920" height="500" class="lazyload loaded"
                        src="/image/baner1.png" alt="Banner" data-was-processed="true">
                </a>
            </div>
        </section>
        <section class="section_flashsale">
            <div class="container">
                <div class="thumb-flasale">
                    <h3 class="title-index">
                        <a class="title-name" href="#section_product_tab" title="Bánh đang giảm giá">Bánh đang giảm giá</a>
                        <img width="202" height="20" class="lazyload loaded"
                            src="/image/bonglua.png"
                            alt="title" data-was-processed="true">
                    </h3>
                    <div>
                        <div class="note" style="text-align: center;padding: 1rem 0;font-size: 16px;"> Chương trình đã kết thúc, hẹn gặp lại trong thời gian sớm nhất !</div>
                    </div>
                    <div class="product-flash-swiper swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events"
                        style="cursor: grab;">
                        <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">
                            <?php
                            while ($row = $result_sale->fetch_assoc()) {
                                $discount_percent = $row['sale'];
                                $original_price = $row['price'];
                                $price_after_sale = $original_price - ($original_price * $discount_percent / 100);
                                $product_id = $row['id'];  // Thêm dòng này để xác định product_id

                                // Kiểm tra xem sản phẩm có trong bảng yêu thích không
                                $checkWishlistQuery = "SELECT COUNT(*) AS total FROM yeuthich WHERE product_id = ?";
                                $stmt = $conn->prepare($checkWishlistQuery);
                                $stmt->bind_param("i", $product_id);
                                $stmt->execute();
                                $result_check = $stmt->get_result();
                                $wishlist_status = 0; // Mặc định là chưa yêu thích
                                if ($result_check && $result_check->num_rows > 0) {
                                    $wishlist_row = $result_check->fetch_assoc();
                                    $wishlist_status = $wishlist_row['total'];
                                }
                            ?>

                                <div class="swiper-slide swiper-slide-active" style="width: 235px; margin-right: 10px;">
                                    <form method="post" class="variants product-action" data-cart-form=""
                                        data-id="product-actions-32239964" enctype="multipart/form-data">
                                        <div class="product-thumbnail">
                                            <a class="image_thumb scale_hover" href="/about/chitietsanpham.php?id=<?= $product_id ?>">
                                                <img width="234" height="234" class="lazyload image1 loaded"
                                                    src="<?= $row['img'] ?>" data-src="<?= $row['img'] ?>" alt="<?= $row['name'] ?>" data-was-processed="true">
                                            </a>
                                            <div class="smart">
                                                <span class="sale">-<?= $discount_percent ?>%</span>
                                            </div>

                                            <a href="javascript:void(0)" class="setWishlist btn-wishlist" data-wish="banh-sung-bo-mini-1" data-id="<?= $product_id ?>" tabindex="0" title="Thêm vào yêu thích">
                                                <?php if ($wishlist_status > 0) { ?>
                                                    <!-- Nếu sản phẩm đã yêu thích -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path d="M462.3 62.67C407.6 15.79 326.6 24.67 279.1 79.12L256 107.4L232.9 79.12C185.4 24.67 104.4 15.79 49.74 62.67C-16.22 124.8-13.14 228.2 49.74 286.2L222.8 454.6C237.6 468.3 256 480 256 480C256 480 274.4 468.3 289.2 454.6L462.3 286.2C525.1 228.2 528.2 124.8 462.3 62.67z"></path>
                                                    </svg>
                                                <?php } else { ?>
                                                    <!-- Nếu sản phẩm chưa yêu thích -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path d="M244 84L255.1 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84C243.1 84 244 84.01 244 84L244 84zM255.1 163.9L210.1 117.1C188.4 96.28 157.6 86.4 127.3 91.44C81.55 99.07 48 138.7 48 185.1V190.9C48 219.1 59.71 246.1 80.34 265.3L256 429.3L431.7 265.3C452.3 246.1 464 219.1 464 190.9V185.1C464 138.7 430.4 99.07 384.7 91.44C354.4 86.4 323.6 96.28 301.9 117.1L255.1 163.9z"></path>
                                                    </svg>
                                                <?php } ?>
                                            </a>
                                            <input class="hidden" type="hidden" name="variantId" value="95784590">
                                            <div class="action">
                                                <input type="hidden" name="variantId" value="95784590">
                                                <button class="btn-cart btn-views  " title="Thêm vào giỏ" onclick="viewPurchase(<?= $row['id'] ?>)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                        <path fill="#fff"
                                                            d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <a title="Xem nhanh" href="javascript:void(0);" onclick="viewProduct(<?= $row['id'] ?>)"
                                                    class="quick-view btn-views">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="#fff"
                                                            d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h3 class="product-name"><a class="line-clamp line-clamp-1"
                                                    href="/<?= strtolower(str_replace(' ', '-', $row['name'])) ?>" title="<?= $row['name'] ?>">
                                                    <?= $row['name'] ?></a></h3>
                                            <div class="price-box">
                                                <?= number_format($price_after_sale) ?>₫
                                                <span class="compare-price"><?= number_format($original_price) ?>₫</span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php
                            } // end while
                            ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev swiper-button-disabled"></div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll("form.variants.product-action").forEach(form => {
                    form.addEventListener("submit", function(event) {
                        event.preventDefault(); // Ngăn form gửi dữ liệu và load lại trang
                        console.log("Form submission prevented!");
                    });
                });
            });
        </script>
        <section class="section_1_banner">
            <div class="container">
                <a class="thumb-image-banner" href="#section_product_tab" title="Banner">
                    <img width="1920" height="200" class="lazyload loaded" src="/image/baner2.jpg" alt="Banner" data-was-processed="true">
                </a>
            </div>
        </section>
        <section class="section_2_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="thumb-banner">
                            <div class="thumb-image">
                                <img width="810" height="525" class="lazyload loaded"
                                    src="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/2banner_1.jpg?1735117293436"
                                    data-src="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/2banner_1.jpg?1735117293436"
                                    alt="Bánh nướng &amp; Sữa" data-was-processed="true">
                            </div>
                            <div class="thumb-content">
                                <h3 class="title">Bánh nướng & Sữa </h3>
                                <p>Vị béo</p>
                                <div class="url">
                                    <a href="#section_product_tab" title="Khám phá tất cả">Khám phá tất cả</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="thumb-banner">
                            <div class="thumb-image">
                                <img width="810" height="525" class="lazyload loaded"
                                    src="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/2banner_2.jpg?1735117293436"
                                    data-src="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/2banner_2.jpg?1735117293436"
                                    alt="Bánh &amp; Trà" data-was-processed="true">
                            </div>
                            <div class="thumb-content">
                                <h3 class="title">Bánh & Trà</h3>
                                <p>Hương vị tươi</p>
                                <div class="url">
                                    <a href="#section_product_tab" title="Khám phá tất cả">Khám phá tất cả</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="section_product_tab" class="section_product_tab ">
            <div class="container">
                <h3 class="title-index">
                    <a class="title-name" href="" title="Tất cả bánh">Tất cả sản phẩm
                    </a>
                    <img width="202" height="20" class="lazyload loaded" src="/image/bonglua.png" alt="title" data-was-processed="true">
                </h3>
                <!-- Sidebar và Main-content hiển thị ngang nhau -->
                <div class="container-flex">
                    <div class="sidebar">
                        <h3>Theo Danh Mục</h3>
                        <ul>
                            <li><input type="checkbox" class="filter-checkbox" value="1" />TRÀ </li>
                            <li><input type="checkbox" class="filter-checkbox" value="2" />BÁNH KEM </li>
                            <li><input type="checkbox" class="filter-checkbox" value="3" />BÁNH KHÔ </li>
                            <li><input type="checkbox" class="filter-checkbox" value="4" />BÁNH NGỌT</li>
                            <li><input type="checkbox" class="filter-checkbox" value="5" />ĐỒ UỐNG</li>
                        </ul>
                    </div>
                    <div class="main-content" id="sanpham">
                        <!-- Vùng chứa sản phẩm sẽ được load bằng AJAX file sanpham.php-->
                        <div id="products-container"></div>
                        <script>
                            // Load sản phẩm bằng AJAX
                            function loadProducts(page) {
                                $.ajax({
                                    url: '/action/sanpham.php',
                                    type: 'GET',
                                    data: {
                                        page: page
                                    },
                                    success: function(data) {
                                        $('#products-container').html(data);
                                    },
                                    error: function() {
                                        $('#products-container').html('Có lỗi xảy ra khi tải sản phẩm.');
                                    }
                                });
                            }
                            $(document).ready(function() {
                                loadProducts(1);
                                $('#products-container').on('click', '.page-link', function(e) {
                                    e.preventDefault();
                                    var page = $(this).data('page');
                                    loadProducts(page);
                                });
                            });
                        </script>
                        <script>
                            $(document).ready(function() {
                                $(document).on("click", ".heart-btn", function() {
                                    var button = $(this);
                                    var productId = button.data("id");
                                    var action = button.data("action"); // "add" hoặc "remove"
                                    var wishlistCount = $(".js-wishlist-count"); // Số lượng wishlist
                                    // Thêm thông báo
                                    var addNotify = $("#add-to-wishlist-notify");
                                    var removeNotify = $("#remove-from-wishlist-notify");


                                    // Đổi icon ngay lập tức trước khi gửi AJAX
                                    if (action === "add") {
                                        button.html('<i class="fas fa-heart text-red-500"></i>');
                                        button.data("action", "remove");
                                        wishlistCount.text(parseInt(wishlistCount.text()) + 1);
                                        // Hiển thị thông báo thêm
                                        addNotify.fadeIn();
                                        setTimeout(() => addNotify.fadeOut(), 3000);
                                    } else {
                                        button.html('<i class="fas fa-heart text-white"></i>');
                                        button.data("action", "add");
                                        wishlistCount.text(Math.max(0, parseInt(wishlistCount.text()) - 1));
                                        // Hiển thị thông báo xóa
                                        removeNotify.fadeIn();
                                        setTimeout(() => removeNotify.fadeOut(), 3000);
                                    }

                                    // Gửi yêu cầu AJAX
                                    $.ajax({
                                        url: "/about/connect.php",
                                        type: "POST",
                                        data: {
                                            product_id: productId,
                                            action: action
                                        },
                                        success: function(response) {
                                            if (response.trim() !== "success") {
                                                console.error("Lỗi cập nhật wishlist:", response);
                                            }
                                        },
                                        error: function() {
                                            console.error("Lỗi AJAX");
                                        }
                                    });
                                });
                                // Đóng thông báo khi nhấn nút "×"
                                $("[data-notify='dismiss']").click(function() {
                                    $(this).parent().fadeOut();
                                });
                            });
                        </script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const checkboxes = document.querySelectorAll('.filter-checkbox');
                                const productsContainer = document.getElementById('products-container');
                                // Hàm gọi AJAX lên sanpham.php
                                function loadProducts(page = 1) {
                                    // Thu thập các checkbox được tích
                                    let selected = [];
                                    checkboxes.forEach(cb => {
                                        if (cb.checked) {
                                            selected.push(cb.value);
                                        }
                                    });
                                    // Tạo chuỗi "1,2" cho tham số groups
                                    const groups = selected.join(',');

                                    // Gửi request lên load_products.php
                                    fetch(`/action/sanpham.php?page=${page}&groups=${groups}`)
                                        .then(response => response.text())
                                        .then(data => {
                                            // Gán dữ liệu vào productsContainer
                                            productsContainer.innerHTML = data;
                                            // Đăng ký sự kiện click cho link phân trang
                                            attachPaginationEvents();
                                        })
                                        .catch(error => console.error(error));
                                }

                                // Gắn sự kiện click cho link phân trang
                                function attachPaginationEvents() {
                                    const pageLinks = document.querySelectorAll('.page-link');
                                    pageLinks.forEach(link => {
                                        link.addEventListener('click', function(e) {
                                            e.preventDefault();
                                            const page = this.getAttribute('data-page');
                                            loadProducts(page); // gọi lại loadProducts nhưng truyền page mới
                                        });
                                    });
                                }

                                // Lắng nghe sự kiện change trên tất cả checkbox
                                checkboxes.forEach(cb => {
                                    cb.addEventListener('change', function() {
                                        // Bỏ chọn tất cả checkbox khác
                                        checkboxes.forEach(otherCb => {
                                            if (otherCb !== this) {
                                                otherCb.checked = false;
                                            }
                                        });

                                        loadProducts(1); // Load sản phẩm với danh mục mới
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </section>
        <section class="section_blog">
            <div class="container">
                <h3 class="title-index">
                    <a class="title-name" href="tin-tuc" title="Tin tức mới nhất">Tin tức mới nhất</a>
                    <img width="202" height="20" class="lazyload loaded" src="/image/bonglua.png" alt="title">
                </h3>
                <div class="block-blog">
                    <div class="blog-swiper swiper-container">
                        <div class="swiper-wrapper">
                            <?php while ($row = $result_tinmoi->fetch_assoc()) { ?>
                                <div class="swiper-slide">
                                    <div class="item-blog">
                                        <div class="block-thumb">
                                            <a class="thumb" href="/<?= strtolower(str_replace(' ', '-', $row['name'])) ?>"
                                                title="<?= $row['name'] ?>">
                                                <img class="lazyload"
                                                    src="/image/loading.png"
                                                    data-src="<?= $row['img'] ?>"
                                                    alt="<?= $row['name'] ?>">
                                            </a>
                                            <div class="time-post"><?= date("d/m/Y", strtotime($row['date'])) ?></div>
                                        </div>
                                        <div class="block-content">
                                            <h3>
                                                <a class="line-clamp line-clamp-1" href="/<?= strtolower(str_replace(' ', '-', $row['name'])) ?>"
                                                    title="<?= $row['name'] ?>"><?= $row['name'] ?></a>
                                            </h3>
                                            <p class="justify line-clamp line-clamp-3"><?= $row['title'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section_danhgia lazyload"
            data-src="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/background_danhgia.jpg?1735117293436">
            <div class="container">
                <div class="background"></div>
                <h3 class="title-index">
                    <span>Khách hàng nói gì</span>
                    <img width="202" height="20" class="lazyload loaded" src="/image/bonglua.png" data-src="/image/bonglua.png" alt="title" data-was-processed="true">
                </h3>
                <div
                    class="danhgia-slider swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">

                    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">
                        <div class="swiper-slide swiper-slide-active" style="width: 337px; margin-right: 10px;">
                            <div class="item">
                                <div class="avatar">
                                    <img width="80" height="80" alt="Hoàng Dung" class="lazyload"
                                        src="/image/danhgia.jpg"
                                        data-src="">
                                    <div class="testimonial">
                                        <h5>
                                            Đức Duy
                                        </h5>
                                        <span>Nhân viên văn phòng </span>
                                    </div>
                                </div>
                                <div class="content">
                                    <p>
                                        Tất cả các loại bánh của Sweet Tea House đều rất ngon, hương vị đặc biệt lại còn rất
                                        đa dạng. Nhân viên ở đây thì rất dễ thương, tư vấn rất nhiệt tình. Cảm ơn Sweet Tea House đã mang lại cho tôi trãi nghiệm tuyệt vời. Tôi sẽ luôn ủng hộ.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide swiper-slide-next" style="width: 337px; margin-right: 10px;">
                            <div class="item">
                                <div class="avatar">
                                    <img width="80" height="80" alt="Sở Bình" class="lazyload"
                                        src="/image/danhgia.jpg"
                                        data-src="">
                                    <div class="testimonial">
                                        <h5>
                                            Hoàng Phú
                                        </h5>
                                        <span>IT</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <p>
                                        Tất cả các loại bánh của Sweet Tea House đều rất ngon, hương vị đặc biệt lại còn rất
                                        đa dạng. Nhân viên ở đây thì rất dễ thương, tư vấn rất nhiệt tình. Cảm ơn Sweet Tea House đã mang lại cho tôi trãi nghiệm tuyệt vời. Tôi sẽ luôn ủng hộ.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide" style="width: 337px; margin-right: 10px;">
                            <div class="item">
                                <div class="avatar">
                                    <img width="80" height="80" alt="Ngọc Tuyến" class="lazyload"
                                        src="/image/danhgia.jpg"
                                        data-src="">
                                    <div class="testimonial">
                                        <h5>
                                            Văn Hưng
                                        </h5>
                                        <span>Đầu bếp</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <p>
                                        Tất cả các loại bánh của Sweet Tea House đều rất ngon, hương vị đặc biệt lại còn rất
                                        đa dạng. Nhân viên ở đây thì rất dễ thương, tư vấn rất nhiệt tình. Cảm ơn Sweet Tea House đã mang lại cho tôi trãi nghiệm tuyệt vời. Tôi sẽ luôn ủng hộ.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->
    <div id="productModal" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden z-50  ">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl w-full relative">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 text-2xl">&times;</button>
            <div class="flex">
                <div class="w-1/2">
                    <img id="modalImage" class="w-full rounded-lg" height="600" width="600" />
                    <div class="flex mt-4 space-x-2">
                        <img id="modalImage1" class="w-20 h-20 rounded-lg border-2 border-yellow-500 cursor-pointer" onclick="changeImage(this.src)" />
                        <img id="modalImage2" class="w-20 h-20 rounded-lg cursor-pointer" onclick="changeImage(this.src)" />
                    </div>
                </div>
                <div class="w-1/2 pl-6">
                    <h1 id="modalTitle" class="text-2xl font-bold"></h1>
                    <div class="flex mt-2 text-gray-600">
                        <p class="mr-4">Tình trạng:
                            <span class="text-green-500">Còn hàng</span>
                        </p>
                        <p>Mã sản phẩm: <span id="modalProductId" class="text-yellow-500"></span></p>

                    </div>
                    <p id="modalPrice" class="mt-4 text-3xl font-bold text-yellow-600"></p>
                    <p id="modalDescription" class="mt-2 text-gray-600"></p>
                    <div class="mt-4 flex items-center">
                        <span class="text-gray-600">Số lượng:</span>
                        <div class="flex items-center ml-4">
                            <button class="px-3 py-1 bg-yellow-200 text-gray-700 rounded-l-lg  " onclick="decreaseQuantity()">-</button>
                            <input id="quantity" class="w-12 text-center border-t border-b border-gray-200" type="text" value="1" />
                            <button class="px-3 py-1 bg-yellow-200 text-gray-700 rounded-r-lg  " onclick="increaseQuantity()">+</button>
                        </div>
                    </div>
                    <button id="addToCartButton" class="mt-6 px-6 py-3 bg-yellow-500 text-white font-bold rounded-lg hover:bg-yellow-600">THÊM VÀO GIỎ HÀNG</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    function changeImage(src) {
    document.getElementById("modalImage").src = src;
}
</script>
    <script>
        function increaseQuantity() {
            let quantityInput = document.getElementById('quantity');
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        }

        function decreaseQuantity() {
            let quantityInput = document.getElementById('quantity');
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        }
    </script>
    <script>
    function viewProduct(productId) {
        // Hiển thị modal
        document.getElementById("productModal").classList.remove("hidden");

        // Gửi AJAX request để lấy thông tin sản phẩm từ `get_product.php`
        fetch("/action/get_product.php?id=" + productId)
            .then(response => response.json()) // Parse dữ liệu JSON
            .then(data => {
                if (data.error) {
                    alert("Lỗi: " + data.error);
                } else {
                    // Gán dữ liệu vào modal
                    document.getElementById("modalProductId").innerText = data.id;
                    document.getElementById("modalTitle").innerText = data.name;
                    document.getElementById("modalPrice").innerText = data.price + "₫";
                    document.getElementById("modalDescription").innerText = data.introduce || "Không có mô tả";
                    document.getElementById("modalImage").src = data.img;
                    document.getElementById("modalImage1").src = data.img;
                    document.getElementById("modalImage2").src = data.img1;
                }
            })
            .catch(error => {
                console.error("Lỗi khi lấy dữ liệu sản phẩm:", error);
            });
    }

    document.getElementById("addToCartButton").addEventListener("click", function() {
        if (userId === null) {
            alert("Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.");
            return;
        }

        let productId = document.getElementById("modalProductId").innerText;
        let img = document.getElementById("modalImage").src.replace(window.location.origin, '');
        let name = document.getElementById("modalTitle").innerText;
        let price = document.getElementById("modalPrice").innerText.replace("₫", "").trim();
        let soLuong = document.getElementById("quantity").value;

        let data = {
            user_id: userId,
            product_id: productId,
            img: img,
            name: name,
            price: price,
            so_luong: soLuong
        };

        fetch("/action/update_card1.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert("Đã thêm vào giỏ hàng!");
                closeModal();
            } else {
                alert("Lỗi: " + result.error);
            }
        })
        .catch(error => {
            console.error("Lỗi khi thêm vào giỏ hàng:", error);
        });
    });

    function closeModal() {
        document.getElementById("productModal").classList.add("hidden");
    }
</script>
    <div id="PurchaseCard" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full border border-yellow-600">
            <div class="bg-yellow-600 text-white p-3 rounded-t-lg flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span class="font-semibold">Mua hàng thành công</span>
                </div>
                <button class="text-white font-bold text-lg" onclick="closePopup()">×</button>
            </div>
            <div class="p-4">
                <div class="flex items-center space-x-4 border-b pb-3">
                    <img id="product-image" alt="Hình sản phẩm" class="w-16 h-16 rounded" />
                    <div>
                        <p id="product-name" class="font-semibold"></p>
                        <p id="product-price" class="text-yellow-700 font-bold text-lg"></p>
                    </div>
                </div>
                <p class="text-gray-600 mt-2">
                    Giỏ hàng của bạn hiện có <span id="cart-count"><?= $total_quantity + 1 ?></span> sản phẩm
                </p>
                <div class="mt-4 flex justify-between">
                    <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg" onclick="closePopup()">Tiếp tục mua hàng</button>
                    <button class="bg-yellow-600 text-white px-4 py-2 rounded-lg">Thanh toán ngay</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function closePopup() {
            document.getElementById("PurchaseCard").classList.add("hidden");
            // Reload trang sau khi đóng popup
            location.reload(); // Đây là nơi trang sẽ reload
        }

        function viewPurchase(productId) {
            // Gửi AJAX request để lấy thông tin sản phẩm từ `get_product.php`
            fetch("../action/get_product.php?id=" + productId)
                .then(response => response.json()) // Parse dữ liệu JSON
                .then(data => {
                    if (data.error) {
                        alert("Lỗi: " + data.error);
                    } else {
                        // Cập nhật thông tin sản phẩm trong popup
                        document.getElementById("product-image").src = data.img;
                        document.getElementById("product-name").textContent = data.name;
                        let price = data.price.replace(/\./g, ""); // Loại bỏ dấu chấm trong chuỗi "40.000" -> "40000"
                        price = parseInt(price, 10); // Chuyển về số nguyên
                        document.getElementById("product-price").textContent = new Intl.NumberFormat("vi-VN").format(price) + "₫";
                        document.getElementById("PurchaseCard").classList.remove("hidden");
                        // Lấy user_id từ session hoặc từ một biến global
                        const userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;
                        // Kiểm tra nếu có user_id hợp lệ
                        if (userId) {
                            // Gửi thông tin sản phẩm lên update_card.php để thêm vào giỏ hàng
                            fetch('/action/update_card.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        user_id: userId,
                                        product_id: productId,
                                        img: data.img,
                                        name: data.name,
                                        price: parseInt(data.price.replace(/\./g, ""), 10)                                    })
                                })
                                .then(response => response.json())
                                .then(responseData => {
                                    if (responseData.success) {

                                    } else {
                                        alert("Lỗi khi thêm sản phẩm vào giỏ hàng");
                                    }
                                });
                        } else {
                            alert("Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.");
                        }
                    }
                });
        }
    </script>

    <script src="/js/placeholdertypewriter.js" type="text/javascript"></script>
    <script src="/js/main.js" type="text/javascript"></script>
    <script src="/js/index.js" type="text/javascript"></script>
    <link href="/css/ajaxcart.scss.css" rel="stylesheet" type="text/css" media="all">
    <?php include "about/footer.php" ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Kiểm tra nếu người dùng chưa đăng nhập
            let userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;
            let heartIconElements = document.querySelectorAll(".setWishlist svg path");

            if (!userId) {
                // Nếu chưa đăng nhập, thay đổi path của tất cả các icon thành "chưa thích"
                heartIconElements.forEach(function(heartIcon) {
                    heartIcon.setAttribute("d", "M244 84L255.1 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84C243.1 84 244 84.01 244 84L244 84zM255.1 163.9L210.1 117.1C188.4 96.28 157.6 86.4 127.3 91.44C81.55 99.07 48 138.7 48 185.1V190.9C48 219.1 59.71 246.1 80.34 265.3L256 429.3L431.7 265.3C452.3 246.1 464 219.1 464 190.9V185.1C464 138.7 430.4 99.07 384.7 91.44C354.4 86.4 323.6 96.28 301.9 117.1L255.1 163.9z"); // Sử dụng path "chưa thích"
                });
            }
            // Xử lý sự kiện khi người dùng nhấn nút yêu thích
            document.querySelectorAll(".setWishlist").forEach(function(btn) {
                btn.addEventListener("click", function() {
                    let heartIcon = this.querySelector("svg path"); // Tìm path của SVG
                    let wishlistCount = document.querySelector(".js-wishlist-count");
                    let productId = this.getAttribute("data-id"); // Lấy ID sản phẩm từ data-id
                    // Kiểm tra xem người dùng đã đăng nhập hay chưa
                    let userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;
                    if (!userId) {
                        // alert("Bạn cần đăng nhập để thêm sản phẩm vào yêu thích.");
                        return; // Nếu chưa đăng nhập, dừng lại
                    }
                    if (!heartIcon) return; // Đảm bảo path tồn tại
                    // Lưu path gốc nếu chưa có
                    if (!heartIcon.hasAttribute("data-original-d")) {
                        heartIcon.setAttribute("data-original-d", heartIcon.getAttribute("d"));
                    }

                    let originalPath = heartIcon.getAttribute("data-original-d"); // Path ban đầu
                    let filledPath = "M462.3 62.67C407.6 15.79 326.6 24.67 279.1 79.12L256 107.4L232.9 79.12C185.4 24.67 104.4 15.79 49.74 62.67C-16.22 124.8-13.14 228.2 49.74 286.2L222.8 454.6C237.6 468.3 256 480 256 480C256 480 274.4 468.3 289.2 454.6L462.3 286.2C525.1 228.2 528.2 124.8 462.3 62.67z"; // Path khi đã thích
                    let emptyPath = "M244 84L255.1 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84C243.1 84 244 84.01 244 84L244 84zM255.1 163.9L210.1 117.1C188.4 96.28 157.6 86.4 127.3 91.44C81.55 99.07 48 138.7 48 185.1V190.9C48 219.1 59.71 246.1 80.34 265.3L256 429.3L431.7 265.3C452.3 246.1 464 219.1 464 190.9V185.1C464 138.7 430.4 99.07 384.7 91.44C354.4 86.4 323.6 96.28 301.9 117.1L255.1 163.9z"; // Path khi chưa thích

                    // Kiểm tra trạng thái của sản phẩm (đã thích hay chưa)
                    if (this.classList.contains("active")) {
                        // Bỏ thích: Quay về path ban đầu
                        this.classList.remove("active");
                        heartIcon.setAttribute("d", emptyPath);
                        wishlistCount.textContent = Math.max(0, parseInt(wishlistCount.textContent) - 1);
                        this.title = "Thêm vào yêu thích";

                        // Gửi yêu cầu AJAX để xóa sản phẩm khỏi yêu thích
                        fetch("/about/connect.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: `product_id=${productId}&action=remove`
                        });

                        // Hiển thị thông báo bỏ yêu thích
                        document.getElementById("remove-from-wishlist-notify").style.display = "block";

                        // Ẩn thông báo sau 3 giây
                        setTimeout(() => {
                            document.getElementById("remove-from-wishlist-notify").style.display = "none";
                        }, 3000);
                    } else {
                        // Thêm vào yêu thích
                        this.classList.add("active");
                        heartIcon.setAttribute("d", filledPath);
                        wishlistCount.textContent = parseInt(wishlistCount.textContent) + 1;
                        this.title = "Bỏ yêu thích";

                        // Gửi yêu cầu AJAX để thêm sản phẩm vào yêu thích
                        fetch("/about/connect.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: `product_id=${productId}&action=add`
                        });

                        // Hiển thị thông báo thêm yêu thích
                        document.getElementById("add-to-wishlist-notify").style.display = "block";

                        // Ẩn thông báo sau 3 giây
                        setTimeout(() => {
                            document.getElementById("add-to-wishlist-notify").style.display = "none";
                        }, 3000);
                    }
                });
            });

            // Xử lý sự kiện đóng thông báo khi nhấn nút "×"
            document.querySelectorAll('[data-notify="dismiss"]').forEach(function(btn) {
                btn.addEventListener("click", function() {
                    let notifyContainer = this.closest('[data-notify="container"]');
                    if (notifyContainer) {
                        notifyContainer.style.display = "none"; // Ẩn thông báo
                    }
                });
            });
        });
    </script>
    
    <div id="add-to-wishlist-notify" data-notify="container" class="col-xs-11 col-sm-4 alert alert-success animated fadeInDown" role="alert" data-notify-position="top-right" style="display: none; margin: 0px auto; position: fixed; transition: 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
        <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
        <span data-notify="icon" class="glyphicon glyphicon-ok"></span>
        <span data-notify="title"><strong>Tuyệt vời</strong><br></span>
        <span data-notify="message">Bạn đã thêm sản phẩm vào danh sách yêu thích. Bấm vào <a href="cc.php"><b>đây</b></a> để đến trang yêu thích</span>
    </div>
    <div id="removedangnhap-from-wishlist-notify" data-notify="container" class="col-xs-11 col-sm-4 alert alert-warning animated bounceInDown" role="alert" data-notify-position="top-right" style="display: none; margin: 0px auto; position: fixed; transition: 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
        <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
        <span data-notify="icon" class="glyphicon glyphicon-info-sign"></span>
        <span data-notify="title"><strong>Thông báo</strong><br></span>
        <span data-notify="message">Bạn cần đăng nhập để thực hiện thao tác này</span>
    </div>
    <div id="remove-from-wishlist-notify" data-notify="container" class="col-xs-11 col-sm-4 alert alert-warning animated bounceInDown" role="alert" data-notify-position="top-right" style="display: none; margin: 0px auto; position: fixed; transition: 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
        <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
        <span data-notify="icon" class="glyphicon glyphicon-info-sign"></span>
        <span data-notify="title"><strong>Thông báo</strong><br></span>
        <span data-notify="message">Bạn đã bỏ sản phẩm ra danh sách yêu thích</span>
    </div>
    <link rel="preload" as="style" href="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/ajaxcart.scss.css?1735117293436" type="text/css">
    <link href="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/ajaxcart.scss.css?1735117293436" rel="stylesheet" type="text/css" media="all">
    </div>
</body>
</html>
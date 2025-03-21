<!DOCTYPE html>
<html lang="en">
<?php
include("connect.php");
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
    <link href="/css/swiper.scss.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/breadcrumb_style.scss.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/style_page.scss.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/style.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            /* Tạo khoảng cách giữa các phần tử */
            justify-content: center;
        }

        .breadcrumb li {
            display: inline-flex;
            /* Giữ thẻ <a> và icon trên cùng một hàng */
            align-items: center;
            gap: 5px;
            /* Khoảng cách giữa text và icon */
        }
    </style>
</head>

<body>
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
                <div class="col-lg-2">
                    <a class="logo" title="Logo">
                        <img width="270" height="256" src="/image/logo.png" alt="Sweet Tea House">
                    </a>
                </div>

                <div class="col-lg-8 header-menu">
                    <div style="    position: relative;">
                        <div class="header-menu-des">
                            <nav class="header-nav">
                                <ul class="item_big">
                                    <li class="d-lg-none d-block account-mb">
                                        <ul>
                                            <li><a href="register.php" title="Đăng ký">Đăng ký</a></li>
                                            <li><a href="login.php" title="Đăng nhập">Đăng nhập</a></li>
                                        </ul>
                                    </li>
                                    <li class="d-block d-lg-none title-danhmuc"><span>Menu chính</span></li>
                                    <li class="nav-item active  "><a class="a-img" href="../index.php" title="Trang chủ"> Trang chủ</a></li>
                                    <li class="nav-item  "><a class="a-img" href="gioithieu.php" title="Giới thiệu">Giới thiệu</a></li>
                                    <li class="nav-item   has-mega "><a class="a-img caret-down" href="../index.php#section_product_tab" title="Sản phẩm">Sản phẩm</a>
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
                                        <a class="a-img" href="tintuc.php" title="Tin tức">Tin tức</a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a class="a-img" href="lienhe.php" title="Liên hệ">Liên hệ</a>
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
                                <li><a href="logout.php" title="Đăng xuất">Đăng xuất</a></li>
                                </ul>';
                            } else {
                                echo '<ul>
                                <li><a href="register.php" title="Đăng ký">Đăng ký</a></li>
                                <li><a href="login.php" title="Đăng nhập">Đăng nhập</a></li>
                                </ul>';
                            }
                            ?>
                        </li>

                        <li class="header-wishlist d-flex">
                            <a title="Sản phẩm yêu thích" href="sanphamyeuthich.php" class="button-wishlist">
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
                            <a href="giohang.php" title="Giỏ hàng">
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
                                            } else {}
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
    </header>
    <div class="bodywrap">
        <section class="bread-crumb " style="background: linear-gradient(0deg, rgba(0,0,0,0.8), rgba(0,0,0,0.3)),  url(/image/bg.png) center no-repeat;">
            <div class="container">
                <div class="title-bread-crumb ">Sản phẩm yêu thích</div>
                <ul class="breadcrumb flex items-center gap-1">
                    <li class="home inline-flex items-center gap-1">
                        <a href="index.php" class="inline-block"><span>Trang chủ</span></a>
                        <span class="mr_lr inline-block">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right"
                                role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                class="w-3 h-3">
                                <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                            </svg>
                        </span>
                    </li>
                    <li class="inline-flex items-center">
                        <strong><span>Sản phẩm yêu thích</span></strong>
                    </li>
                </ul>
            </div>
        </section>
        <section class="page">
            <div class="container container--wishlist">
                <div class="content-page rte">
                    <h1 class="title-page d-none">
                        <span>Sản phẩm yêu thích</span>
                    </h1>
                    <div id="list-favorite">
                        <div class="list-favorite-right" data-type="wishlist">
                            <div class="list-favorite-main">
                                <div class="list-favorite-list row row-fix">
                                    <?php if (!empty($product_details)): ?>
                                        <?php foreach ($product_details as $product): ?>
                                            <div class="col-6 col-md-4 col-lg-3 col-lg-20 col-fix">
                                                <form action="/cart/add" method="post" class="variants product-action" enctype="multipart/form-data">
                                                    <div class="product-thumbnail">
                                                        <a class="image_thumb scale_hover" href="/banh-mi-nuong-caramen" title="<?php echo htmlspecialchars($product['name']); ?>">
                                                            <img width="234" height="234" class="lazyload image1 loaded" src="<?php echo htmlspecialchars($product['img']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                                        </a>
                                                        <div class="smart">
                                                            <span class="sale">- <?php echo htmlspecialchars($product['sale']); ?>%</span>
                                                        </div>
                                                        <a href="javascript:void(0)" class="setWishlist btn-wishlist active" data-wish="banh-mi-nuong-caramen" tabindex="0" title="Bỏ yêu thích" onclick="toggleWishlist('<?php echo $product['id']; ?>')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <path d="M462.3 62.67C407.6 15.79 326.6 24.67 279.1 79.12L256 107.4L232.9 79.12C185.4 24.67 104.4 15.79 49.74 62.67C-16.22 124.8-13.14 228.2 49.74 286.2L222.8 454.6C237.6 468.3 256 480 256 480C256 480 274.4 468.3 289.2 454.6L462.3 286.2C525.1 228.2 528.2 124.8 462.3 62.67z"></path>
                                                            </svg>
                                                        </a>
                                                        <div class="action">
                                                            <input type="hidden" name="variantId" value="95784568">
                                                            <button class="btn-cart btn-views add_to_cart is-added" title="Thêm vào giỏ">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                                    <path fill="#fff" d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z"></path>
                                                                </svg>
                                                            </button>

                                                            <a href="javascript:void(0);" onclick="viewProduct(<?php echo htmlspecialchars($product['id']); ?>)" class="quick-view btn-views"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                    <path fill="#fff" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product-info">
                                                        <h3 class="product-name"><a class="line-clamp line-clamp-1" href="/banh-mi-nuong-caramen" title="<?php echo htmlspecialchars($product['name']); ?>"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                                                        <div class="price-box">
                                                            <?php echo htmlspecialchars($product['price'] - $product['price'] * $product['sale'] / 100); ?>₫
                                                            <span class="compare-price"><?php echo htmlspecialchars($product['price']); ?>₫</span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="list-favorite-main-top-error col-lg-12 col-md-12 col-sm-12 col-12 no-padding">
                                            <span style="display: block;" class="alert alert-warning" role="alert">Bạn chưa có sản phẩm yêu thích nào!</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        function toggleWishlist(productId) {
            console.log("Product ID: " + productId); // Debugging output
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "connect.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Gửi product_id và action = 'remove' để xóa sản phẩm khỏi yêu thích
            xhr.send("product_id=" + productId + "&action=remove");

            xhr.onload = function() {
                if (xhr.status == 200) {
                    location.reload(); // Reload trang nếu cần thiết
                } else {
                    alert("Lỗi khi xóa sản phẩm yêu thích!");
                }
            };
        }
    </script>
    <!-- Modal -->
    <div id="productModal" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden z-50  ">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl w-full relative">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 text-2xl">&times;</button>
            <div class="flex">
                <div class="w-1/2">
                    <img id="modalImage" class="w-full rounded-lg" height="600" width="600" />
                    <!-- <div class="flex mt-4 space-x-2">
            <img id="modalImage" class="w-20 h-20 rounded-lg border-2 border-yellow-500 cursor-pointer" onclick="changeImage(this.src)" />
            <img id="modalImage" class="w-20 h-20 rounded-lg cursor-pointer" onclick="changeImage(this.src)" />
          </div> -->
                </div>
                <div class="w-1/2 pl-6">
                    <h1 id="modalTitle" class="text-2xl font-bold"></h1>
                    <div class="flex mt-2 text-gray-600">
                        <p class="mr-4">Tình trạng:<span class="text-green-500">Còn hàng</span></p>
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
                    <button class="mt-6 px-6 py-3 bg-yellow-500 text-white font-bold rounded-lg hover:bg-yellow-600">THÊM VÀO GIỎ HÀNG</button>
                </div>
            </div>
        </div>
    </div>
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
                    }
                })
                .catch(error => {
                    console.error("Lỗi khi lấy dữ liệu sản phẩm:", error);
                });
        }
        function closeModal() {
            document.getElementById("productModal").classList.add("hidden");
        }
    </script>
    <link rel="preload" as="style"
        href="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/ajaxcart.scss.css?1735117293436" type="text/css">
    <link href="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/ajaxcart.scss.css?1735117293436" rel="stylesheet"
        type="text/css" media="all">
    <?php include "footer.php" ?>
</body>
</html>
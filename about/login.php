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
    <link rel="stylesheet" href="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/bootstrap-4-3-min.css?1735117293436">
    <link href="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/paginate.scss.css?1735117293436" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/account_oder_style.scss.css?1735117293436" rel="stylesheet" type="text/css" media="all">
</head>

<body>
    <div class="opacity_menu"></div>
    <header class="header" style="min-height: 90px;">
        <div class="container">
            <div class="row row-header align-items-center">
                <div class="menu-bar d-lg-none d-flex">
                    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="bars" role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-bars fa-w-14">
                        <path fill="#ffffff" d="M436 124H12c-6.627 0-12-5.373-12-12V80c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12z" class=""></path>
                    </svg>
                </div>
                <div class="col-lg-2">
                    <a class="logo" title="Logo"><img width="270" height="256" src="/image/logo.png" alt="Sweet Tea House"></a>
                </div>
                <div class="col-lg-8 header-menu">
                    <div style="    position: relative;">
                        <div class="header-menu-des">
                            <nav class="header-nav">
                                <ul class="item_big">
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
                                                                        <span class="cart-price"><?= number_format($row['price'] * $row['so_luong'], 3, ',', '.') ?>₫</span>
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
                                                        <span class="total-price"><?= number_format($total_price, 3, ',', '.') ?>₫</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cart__btn-proceed-checkout-dt">
                                                <button onclick="location.href='checkout.php'" type="button" class="button btn btn-default cart__btn-proceed-checkout" id="btn-proceed-checkout" title="Thanh toán">Thanh toán</button>
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
        <section class="bread-crumb" style="background: linear-gradient(0deg, rgba(0,0,0,0.8), rgba(0,0,0,0.3)),  url(/image/bg.png) center no-repeat;">
            <div class="container">
                <div class="title-bread-crumb">
                    Đăng nhập tài khoản
                </div>
                <ul class="breadcrumb">
                    <li class="home">
                        <a href="../index.php"><span>Trang chủ</span></a>
                        <span class="mr_lr">&nbsp;<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-chevron-right fa-w-10">
                                <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" class=""></path>
                            </svg>&nbsp;</span>
                    </li>
                    <li><strong><span>Đăng nhập tài khoản</span></strong></li>

                </ul>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="wrap_background_aside page_login">
                    <div class="row">
                        <div style="margin: auto;" class="col-lg-4 col-md-6 col-sm-12 col-12 col-xl-4 offset-xl-4 offset-lg-4 offset-md-3 offset-xl-3 ">
                            <div class="row no-margin align-items-center" style="padding: 10px;background: #f3e7cd;border-radius: 5px;">
                                <div class="page-login pagecustome clearfix no-padding">
                                    <div class="wpx">
                                        <ul class="auth-block__menu-list">
                                            <li class="active">
                                                <a href="login.php" title="Đăng nhập">Đăng nhập</a>
                                            </li>
                                            <li>
                                                <a href="register.php" title="Đăng ký">Đăng ký</a>
                                            </li>
                                        </ul>
                                        <h1 class="title_heads a-center"><span>Đăng nhập</span></h1>
                                        <div id="login" class="section">
                                            <form method="post"  id="customer_login" accept-charset="UTF-8"><input name="FormType" type="hidden" value="customer_login"><input name="utf8" type="hidden" value="true">
                                                <span class="form-signup" style="color:red;">

                                                </span>
                                                <div class="form-signup clearfix">
                                                    <fieldset class="form-group">
                                                        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" class="form-control form-control-lg" value="" name="email" id="customer_email" placeholder="Email" required="">
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <input type="password" class="form-control form-control-lg" value="" name="password" id="customer_password" placeholder="Mật khẩu" required="">
                                                    </fieldset>
                                                    <span class="form-signup" style="color:red;">
                                                        <?php if(isset($_SESSION['error'])) { echo $_SESSION['error']; unset($_SESSION['error']); } ?>
                                                    </span>
                                                    <div class="pull-xs-left">
                                                        <input class="btn btn-style btn_50" type="submit" value="Đăng nhập">
                                                        <span class="d-block text-center fw-bold text-primary fst-italic quenmk">Quên mật khẩu</span>
                                                    </div>
                                                    
                                                </div>
                                            </form>
                                        </div>
                                        <div class="h_recover" style="display:none;">
                                            <div id="recover-password" class="form-signup page-login">
                                                <form method="post"  id="recover_customer_password" accept-charset="UTF-8"><input name="FormType" type="hidden" value="recover_customer_password"><input name="utf8" type="hidden" value="true">
                                                    <div class="form-signup" style="color: red;">

                                                    </div>
                                                    <div class="form-signup clearfix">
                                                        <fieldset class="form-group">
                                                            <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" class="form-control form-control-lg" value="" name="Email" id="recover-email" placeholder="Email" required="">
                                                        </fieldset>
                                                    </div>
                                                    <div class="action_bottom">
                                                        <input class="btn btn-style btn_50" style="margin-top: 0px;" type="submit" value="Lấy lại mật khẩu">

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="block social-login--facebooks">
                                            <p class="a-center"><em>Hoặc đăng nhập bằng</em>
                                            </p>
                                            <script>
                                                function loginFacebook() {
                                                    var a = {
                                                            client_id: "947410958642584",
                                                            redirect_uri: "https://store.mysapo.net/account/facebook_account_callback",
                                                            state: JSON.stringify({
                                                                redirect_url: window.location.href
                                                            }),
                                                            scope: "email",
                                                            response_type: "code"
                                                        },
                                                        b = "https://www.facebook.com/v3.2/dialog/oauth" + encodeURIParams(a, !0);
                                                    window.location.href = b
                                                }

                                                function loginGoogle() {
                                                    var a = {
                                                            client_id: "997675985899-pu3vhvc2rngfcuqgh5ddgt7mpibgrasr.apps.googleusercontent.com",
                                                            redirect_uri: "https://store.mysapo.net/account/google_account_callback",
                                                            scope: "email profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile",
                                                            access_type: "online",
                                                            state: JSON.stringify({
                                                                redirect_url: window.location.href
                                                            }),
                                                            response_type: "code"
                                                        },
                                                        b = "https://accounts.google.com/o/oauth2/v2/auth" + encodeURIParams(a, !0);
                                                    window.location.href = b
                                                }

                                                function encodeURIParams(a, b) {
                                                    var c = [];
                                                    for (var d in a)
                                                        if (a.hasOwnProperty(d)) {
                                                            var e = a[d];
                                                            null != e && c.push(encodeURIComponent(d) + "=" + encodeURIComponent(e))
                                                        } return 0 == c.length ? "" : (b ? "?" : "") + c.join("&")
                                                }
                                            </script>
                                            <div style="display: flex; gap: 20px; justify-content:center;">
                                                <a href="javascript:void(0)" class="social-login--facebook" onclick="loginFacebook()" style="font-size: 30px; color: #1877f2;"><i class="fa-brands fa-facebook"></i></a>
                                                <a href="javascript:void(0)" class="social-login--facebook" onclick="loginFacebook()" style="font-size: 30px; color:rgb(255, 2, 2);"><i class="fa-brands fa-google"></i></a>
                                                <!-- <a href="javascript:void(0)" class="social-login--facebook" onclick="loginFacebook()"><img width="129px" height="37px" alt="facebook-login-button" src="//bizweb.dktcdn.net/assets/admin/images/login/fb-btn.svg"></a> -->
                                                <!-- <a href="javascript:void(0)" class="social-login--google" onclick="loginGoogle()"><img width="129px" height="37px" alt="google-login-button" src="//bizweb.dktcdn.net/assets/admin/images/login/gp-btn.svg"></a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript">
            function showRecoverPasswordForm() {
                document.getElementById('recover-password').style.display = 'block';
                document.getElementById('login').style.display = 'none';
            }

            function hideRecoverPasswordForm() {
                document.getElementById('recover-password').style.display = 'none';
                document.getElementById('login').style.display = 'block';
            }
            $('.quenmk').on('click', function() {
                $('#login').toggleClass('hidden');
                $('.h_recover').slideToggle();
            });
        </script>
    </div>
    <link rel="preload" as="style" href="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/ajaxcart.scss.css?1735117293436" type="text/css">
    <link href="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/ajaxcart.scss.css?1735117293436" rel="stylesheet" type="text/css" media="all">
    <?php include "footer.php" ?>

</body>

</html>
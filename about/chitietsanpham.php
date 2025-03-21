<?php
include("connect.php");
// Lấy thông tin sản phẩm hiện tại
$product_id = $_GET['id'];
$sql = "SELECT name, `group`, price, sale, introduce, img, img1 FROM tra_banhngot WHERE id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$name = $row['name'];
	$group = $row['group'];
	$price = number_format($row['price'], 0, ',', '.') . '₫';
	$sale = $row['sale'];
	$introduce = $row['introduce'];
	$img = $row['img'];
	$img1 = $row['img1'];
	$discount_price = $row['price'] * (1 - $sale / 100);
} else {
	echo "Không tìm thấy sản phẩm!";
	exit;
}
$group_names = [
	1 => "Trà",
	2 => "Bánh Kem",
	3 => "Bánh Khô",
	4 => "Bánh Ngọt",
	5 => "Đồ Uống"
];
// Kiểm tra nếu $group có trong mảng thì lấy tên, nếu không thì để "Không xác định"
$group_display = isset($group_names[$group]) ? $group_names[$group] : "Không xác định";
// 🛠 Gọi recommend.py và truyền ID sản phẩm cần gợi ý
$recommended_products = shell_exec("python recommend.py $product_id");
// Kiểm tra JSON trả về
$recommended_ids = json_decode($recommended_products, true);
if (!is_array($recommended_ids)) {
	echo "<p>Lỗi khi lấy sản phẩm gợi ý.</p>";
	$recommended_ids = [];
	print_r($recommended_ids);
}


// 🛠 Lưu dữ liệu vào file CSV để xử lý bằng Python
$sql_products = "SELECT id, name, price, introduce FROM tra_banhngot";
$result_products = $conn->query($sql_products);

$products = [];
while ($row = $result_products->fetch_assoc()) {
	$products[] = $row;
}

$file = fopen("products.csv", "w");
fputcsv($file, ["id", "name", "price", "introduce"]); // Header
foreach ($products as $product) {
	fputcsv($file, [$product["id"], $product["name"], $product["price"], $product["introduce"]]);
}
fclose($file);


?>
<head>
	<meta charset="UTF-8" />
	<meta name="theme-color" content="#c9db32">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Sweet Tea House</title>
	<link rel="icon" type="image/png" href="../image/logo.png">
	<script src="/js/jquery.js" type="text/javascript"></script>
	<script src="/js/swiper.js" type="text/javascript"></script>
	<script src="/js/lazy.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/css/bootstrap-4-3-min-index.css">
	<link href="/css/main.scss.css" rel="stylesheet" type="text/css" media="all">
	<link href="/css/swiper.scss.css" rel="stylesheet" type="text/css" media="all">
	<link href="/css/breadcrumb_style.scss.css" rel="stylesheet" type="text/css" media="all">
	<link href="/css/style_page.scss.css" rel="stylesheet" type="text/css" media="all">
	<link href="/css/style.css" rel="stylesheet" type="text/css" media="all">
	<script src="/js/jquery.min.js"></script>
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

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

		.bg-custom {
			background-image: url('/image/bgmocchau.jpg');
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;

		}

		.underline-yellow {
			position: relative;
			color: rgb(231, 177, 26);
			/* Yellow color */
		}

		.underline-yellow::after {
			content: '';
			position: absolute;
			left: 0;
			bottom: -4px;
			/* Adjusted to move the underline down */
			width: 100%;
			height: 2px;
			background-color: rgb(231, 153, 37);
			/* Yellow color */
		}

		.hidden {
			display: none;
		}

		.cursor-pointer {
			cursor: pointer;
		}

		.fancy-font {
			font-family: 'Playball';
		}

		.fancy-font_text {
			font-family: 'Quicksand', sans-serif;
		}

		.line-spacing p {
			margin-bottom: 1rem;
			/* Adjust the value as needed */
			font-size: 12px;
		}

		.product-flash-swiper {
			height: 350px;
			/* Điều chỉnh chiều cao phù hợp */
			overflow: hidden;
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
												<li class="level1 parent item fix-navs" data-title="Trà "
													data-link="../index.php#section_product_tab">
													<a class="hmega" href="../index.php#section_product_tab" title="Trà">Trà</a>
													<ul class="level1">
														<?php while ($row = $result_tra->fetch_assoc()): ?>
															<li class="level2">
																<a href="../index.php#section_product_tab" title="<?php echo $row['name']; ?>">
																	<?php echo $row['name']; ?>
																</a>
															</li>
														<?php endwhile; ?>
													</ul>
												</li>
												<li class="level1 parent item fix-navs" data-title="Bánh kem"
													data-link="../index.php#section_product_tab">
													<a class="hmega" href="../index.php#section_product_tab" title="Bánh kem">Bánh kem</a>
													<ul class="level1">
														<?php while ($row = $result_banhkem->fetch_assoc()): ?>
															<li class="level2">
																<a href="../index.php#section_product_tab" title="<?php echo $row['name']; ?>">
																	<?php echo $row['name']; ?>
																</a>
															</li>
														<?php endwhile; ?>
													</ul>
												</li>
												<li class="level1 parent item fix-navs" data-title="Bánh ngọt"
													data-link="../index.php#section_product_tab">
													<a class="hmega" href="../index.php#section_product_tab" title="Bánh ngọt">Bánh ngọt</a>
													<ul class="level1">
														<?php while ($row = $result_banhngot->fetch_assoc()): ?>
															<li class="level2">
																<a href="../index.php#section_product_tab" title="<?php echo $row['name']; ?>">
																	<?php echo $row['name']; ?>
																</a>
															</li>
														<?php endwhile; ?>
													</ul>
												</li>
												<li class="level1 parent item fix-navs" data-title="Bánh khô"
													data-link="../index.php#section_product_tab">
													<a class="hmega" href="../index.php#section_product_tab" title="Bánh tráng miệng">Bánh khô</a>
													<ul class="level1">
														<?php while ($row = $result_banhkho->fetch_assoc()): ?>
															<li class="level2">
																<a href="../index.php#section_product_tab" title="<?php echo $row['name']; ?>">
																	<?php echo $row['name']; ?>
																</a>
															</li>
														<?php endwhile; ?>
													</ul>
												</li>
												<li class="level1 parent item fix-navs" data-title="Đồ uống"
													data-link="../index.php#section_product_tab">
													<a class="hmega" href="../index.php#section_product_tab" title="Đồ uống">Đồ uống</a>
													<ul class="level1">
														<?php while ($row = $result_douong->fetch_assoc()): ?>
															<li class="level2">
																<a href="../index.php#section_product_tab" title="<?php echo $row['name']; ?>">
																	<?php echo $row['name']; ?>
																</a>
															</li>
														<?php endwhile; ?>
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
												<button onclick="location.href='/checkout'" type="button" class="button btn btn-default cart__btn-proceed-checkout" id="btn-proceed-checkout" title="Thanh toán">Thanh toán</button>
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
				<div class="title-bread-crumb ">Giới thiệu</div>
				<ul class="breadcrumb flex items-center gap-1">
					<li class="home inline-flex items-center gap-1">
						<a href="../index.php" class="inline-block"><span>Trang chủ </span> </a>
						<span class="mr_lr inline-block">
							<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right"
								role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
								class="w-3 h-3">
								<path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
							</svg>
						</span>
					</li>
					<li>
						<a class="changeurl"><span><?php echo $group_display; ?></span></a>
						<span class="mr_lr">&nbsp;<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-chevron-right fa-w-10">
								<path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" class=""></path>
							</svg>&nbsp;</span>
					</li>
					<li class="inline-flex items-center">
						<strong><span> <?php echo $name; ?></span></strong>
					</li>
				</ul>
			</div>
		</section>
		<div class="container mx-auto max-w-6xl mb-10">
			<div class="flex flex-col lg:flex-row">
				<!-- Left Column -->
				<div class="flex-1">
					<div class="border p-4 rounded-lg">
						<img alt="<?php echo $name; ?>" class="w-full h-auto rounded-lg" height="400" id="mainImage" src="<?php echo $img; ?>" width="400" />
					</div>
					<div class="flex mt-4 space-x-2">
						<img alt="<?php echo $name; ?>" class="w-20 h-20 border rounded-lg cursor-pointer" height="100" onclick="changeMainImage('<?php echo $img; ?>')" src="<?php echo $img; ?>" width="100" />
						<img alt="<?php echo $name; ?>" class="w-20 h-20 border rounded-lg cursor-pointer" height="100" onclick="changeMainImage('<?php echo $img1; ?>')" src="<?php echo $img1; ?>" width="100" />
					</div>
				</div>
				<!-- Right Column -->
				<div class="flex-1 lg:ml-8 mt-6 lg:mt-0">
					<h1 class="text-2xl font-bold"><?php echo $name; ?></h1>
					<p class="text-gray-600 mt-2">
						Loại:
						<span class="text-blue-600 mr-3"><?php echo $group_display; ?></span>Tình trạng: <span class="text-green-600  ">Còn hàng</span>
					</p>
					<p class="text-3xl text-red-600 font-bold mt-4"> <?php echo number_format($discount_price, 0, ',', '.') . '₫'; ?></p>
					<div class="flex items-center mt-4">
						<label class="mr-2" for="quantity">
							Số lượng:
						</label>
						<div class="input_number_product form-control flex items-center">
							<button class="btn_num num_1 button button_qty bg-yellow-500 text-gray-800 px-2 py-1 rounded-l-lg" onclick="var result = document.getElementById('qtym'); var qtypro = result.value; if( !isNaN( qtypro ) && qtypro > 1 ) result.value--;return false;" type="button">
								-
							</button>
							<input class="form-control prd_quantity text-center w-12 border-t border-b" id="qtym" maxlength="3" name="quantity" onchange="if(this.value == 0)this.value=1;" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" type="text" value="1" />
							<button class="btn_num num_2 button button_qty bg-yellow-500 text-gray-800 px-2 py-1 rounded-r-lg" onclick="var result = document.getElementById('qtym'); var qtypro = result.value; if( !isNaN( qtypro )) result.value++;return false;" type="button">
								+
							</button>
						</div>
					</div>
					<div class="flex mt-4 space-x-4">
						<button id ="addToCartButton" class="flex-1 bg-yellow-500 text-white py-2 rounded-lg flex items-center justify-center">
							<i class="fas fa-shopping-cart mr-2"></i>
							THÊM VÀO GIỎ
						</button>
						<button class="flex-1 bg-gray-200 text-gray-700 py-2 rounded-lg flex items-center justify-center">
							<i class="fas fa-heart mr-2"></i>
							YÊU THÍCH
						</button>
					</div>
					<div class="mt-6 p-4 border rounded-lg bg-yellow-100">
						<h2 class="text-lg font-bold text-yellow-600">
							Nhận voucher ngay !!!
						</h2>
						<div class="mt-4">
							<div class="flex justify-between items-center border-b py-2">
								<span>
									Chi tiêu 258.000₫ để được nhận mã freeship
								</span>
								<button class="bg-yellow-500 text-white py-1 px-2 rounded-lg">
									Sao chép
								</button>
							</div>
							<div class="flex justify-between items-center border-b py-2">
								<span>
									Chi tiêu 658.000₫ để được nhận mã giảm 20.000₫
								</span>
								<button class="bg-yellow-500 text-white py-1 px-2 rounded-lg">
									Sao chép
								</button>
							</div>
							<div class="flex justify-between items-center py-2">
								<span>
									Chi tiêu 958.000₫ để được nhận mã giảm 50.000₫
								</span>
								<button class="bg-yellow-500 text-white py-1 px-2 rounded-lg">
									Sao chép
								</button>
							</div>
						</div>
					</div>
					<div class="mt-6 p-4 border rounded-lg bg-gray-100">
						<h2 class="text-lg font-bold text-yellow-600">
							Khuyến mãi đặc biệt !!!
						</h2>
						<ul class="mt-4 space-y-2">
							<li class="flex items-center">
								<i class="fas fa-check text-green-500 mr-2">
								</i>
								Áp dụng Phiếu quà tặng/ Mã giảm giá theo ngành hàng.
							</li>
							<li class="flex items-center">
								<i class="fas fa-check text-green-500 mr-2">
								</i>
								Giảm giá 10% khi mua từ 5 sản phẩm trở lên.
							</li>
							<li class="flex items-center">
								<i class="fas fa-check text-green-500 mr-2">
								</i>
								Tặng 100.000₫ mua hàng tại website thành viên Dola Fashion Accessories, áp dụng khi mua Online tại Hồ Chí Minh và 1 số khu vực khác.
							</li>
						</ul>
					</div>
					<div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
						<div class="p-4 border rounded-lg bg-white flex items-center">
							<i class="fas fa-truck text-yellow-600 text-2xl mr-4">
							</i>
							<div>
								<h3 class="font-bold">
									Miễn phí vận chuyển
								</h3>
								<p>
									Miễn phí ship cho các đơn hàng từ 300 nghìn
								</p>
							</div>
						</div>
						<div class="p-4 border rounded-lg bg-white flex items-center">
							<i class="fas fa-sync-alt text-yellow-600 text-2xl mr-4">
							</i>
							<div>
								<h3 class="font-bold">
									Đổi trả dễ dàng
								</h3>
								<p>
									Đổi trả trong vòng 7 ngày nếu có lỗi từ nhà cung cấp
								</p>
							</div>
						</div>
						<div class="p-4 border rounded-lg bg-white flex items-center">
							<i class="fas fa-headset text-yellow-600 text-2xl mr-4">
							</i>
							<div>
								<h3 class="font-bold">
									Hỗ trợ nhanh chóng
								</h3>
								<p>
									Gọi Hotline: 1900 9898 để được hỗ trợ ngay
								</p>
							</div>
						</div>
						<div class="p-4 border rounded-lg bg-white flex items-center">
							<i class="fas fa-credit-card text-yellow-600 text-2xl mr-4">
							</i>
							<div>
								<h3 class="font-bold">
									Thanh toán đa dạng
								</h3>
								<p>
									Thanh toán bằng thẻ ngân hàng, Napas, Visa, Chuyển Khoản
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container mx-auto px-4 py-8">
				<div class="flex justify-center items-center pb-2">
					<h1 id="description-tab" class="text-2xl font-bold mr-4 cursor-pointer text-black italic fancy-font" onclick="toggleSection('description')">Mô tả sản phẩm</h1>
					<h2 id="guide-tab" class="text-2xl font-bold cursor-pointer  underline-yellow italic fancy-font" onclick="toggleSection('guide')">Hướng dẫn mua hàng</h2>
				</div>
				<div id="product-description" class="hidden mt-4 fancy-font_text">
					<p><?php echo $introduce; ?></p>
				</div>
				<div id="purchase-guide" class="mt-4 fancy-font_text line-spacing p">
					<p><strong>Bước 1:</strong> Truy cập website, đăng nhập và lựa chọn sản phẩm cần mua</p>
					<p><strong>Bước 2:</strong> Click vào sản phẩm muốn mua, màn hình hiện thị ra pop up với các lựa chọn sau</p>
					<p>Nếu bạn muốn tiếp tục mua hàng: Bấm vào phần tiếp tục mua hàng để lựa chọn thêm sản phẩm vào giỏ hàng</p>
					<p>Nếu bạn muốn xem giỏ hàng để cập nhật sản phẩm: Bấm vào xem giỏ hàng</p>
					<p>Nếu bạn muốn đặt hàng và thanh toán đơn sản phẩm này vui lòng bấm vào: Đặt hàng và thanh toán</p>
					<p><strong>Bước 3:</strong> Lựa chọn thông tin tài khoản thanh toán</p>
					<p>Nếu bạn đã có tài khoản vui lòng nhập thông tin tên đăng nhập là email và mật khẩu vào mục đã có tài khoản trên hệ thống</p>
					<p>Nếu bạn chưa có tài khoản và muốn đăng ký tài khoản vui lòng điền các thông tin cá nhân để tiếp tục đăng ký tài khoản. Khi có tài khoản bạn sẽ dễ dàng theo dõi được đơn hàng của mình</p>
					<p>Nếu bạn muốn mua hàng mà không cần tài khoản vui lòng nhấp chuột vào mục đặt hàng không cần tài khoản</p>
					<p><strong>Bước 4:</strong> Điền các thông tin của bạn để nhận đơn hàng, lựa chọn hình thức thanh toán và vận chuyển cho đơn hàng của mình</p>
					<p><strong>Bước 5:</strong> Xem lại thông tin đặt hàng, điền chú thích và gửi đơn hàng</p>
					<p>Sau khi nhận được đơn hàng bạn gọi chúng tôi sẽ liên hệ bằng cách gọi điện lại để xác nhận lại đơn hàng và địa chỉ của bạn.</p>
					<p>Trân trọng cảm ơn.</p>
				</div>
			</div>
		</div>
		<script>
document.addEventListener("DOMContentLoaded", function () {
    const addToCartButton = document.getElementById("addToCartButton");

    if (!addToCartButton) {
        console.error("Không tìm thấy nút THÊM VÀO GIỎ!");
        return;
    }

    addToCartButton.addEventListener("click", function () {
        console.log("Nút THÊM VÀO GIỎ đã được click!");

        // Định nghĩa productId và các biến cần thiết
        let productId = <?php echo isset($_GET['id']) ? $_GET['id'] : 'null'; ?>;
        let img = document.getElementById("mainImage").src.replace(window.location.origin, '');
        let name = "<?php echo isset($name) ? addslashes($name) : ''; ?>";
		let rawPrice = "<?php echo isset($discount_price) ? $discount_price : '0'; ?>";
let price = parseFloat(rawPrice.replace(/\./g, "").replace(",", ".").replace("₫", "").trim());
price = price.toLocaleString("vi-VN"); // Format về chuẩn VNĐ (250.000)


        let soLuong = document.getElementById("qtym").value;

        // Lấy user_id từ session
        const userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;
        console.log("User ID:", userId);

        if (!userId || userId === 'null') {
            alert("Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.");
            return;
        }

        let data = { user_id: userId, product_id: productId, img: img, name: name, price: price, so_luong: soLuong };
        console.log("Dữ liệu gửi đi:", data);

        fetch("/action/update_card1.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            console.log("Phản hồi từ server:", result);
            if (result.success) {
                alert("Đã thêm vào giỏ hàng!");
            } else {
                alert("Lỗi: " + result.error);
            }
        })
        .catch(error => {
            console.error("Lỗi khi gửi dữ liệu:", error);
        });
    });
});

</script>

		<!-- Hiển thị sản phẩm liên quan -->
		<div class="container">
			<div class="thumb-flasale  ">
				<h3 class="title-index">
					<a class="title-name" href="/banh-moi-nhat" title="Sản phẩm liên quan">Sản phẩm liên quan</a>
					<img width="202" height="20" class="lazyload loaded" src="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/title.png?1735117293436" data-src="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/title.png?1735117293436" alt="title" data-was-processed="true">
				</h3>
				<div class="product-flash-swiper swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events"
				style="cursor: grab;">					
					<div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">
						<?php
						// Hiển thị sản phẩm gợi ý đúng vị trí
						if (!empty($recommended_ids)) {
							$ids = implode(",", array_map('intval', $recommended_ids));
							$sql_recommend = "SELECT id, name, price, sale, img FROM tra_banhngot WHERE id IN ($ids)";
							$result_recommend = $conn->query($sql_recommend);
							while ($row = $result_recommend->fetch_assoc()) {
								echo '<div class="swiper-slide swiper-slide-active" style="width: 193.5px; margin-right: 15px;">';
								echo '<div class=" item_product_main">';
								echo '<form action="/cart/add" method="post" class="variants product-action" data-cart-form="" data-id="product-actions-32239949" enctype="multipart/form-data">';
								echo '<div class="product-thumbnail">';
								echo '<a class="image_thumb scale_hover" href="/about/chitietsanpham.php?id=' . $row['id'] . '" title="' . $row['name'] . '">';
								echo '<img src="' . $row['img'] . '" alt="' . $row['name'] . '" width="234" height="234">';
								echo '</a>';
								echo '<div class="smart">';
								echo '<span class="sale">' . $row['sale'] . '</span>';
								echo '</div>';
								echo '</div>';
								echo '<div class="product-info">';
								echo '<h3 class="product-name"><a href="/product.php?id=' . $row['id'] . '">' . $row['name'] . '</a></h3>';
								echo '<div class="price-box">' . number_format($row['price'] - ($row['price'] * $row['sale'] / 100), 0, ',', '.') . '₫ 
										<span class="compare-price">' . number_format($row['price'], 0, ',', '.') . '₫</span>
							  		  </div>';
								echo '</div>';
								echo '</form>';
								echo '</div>';
								echo '</div>';
							}
						} else {
							echo "<p>Không có sản phẩm gợi ý.</p>";
						}
						?>
					</div>
				</div>
			</div>
			<div class="section-recenview-product productRelate">  
    <div class="section_prd_feature swiper-container swiper_related recent-page-viewed">
        <h3 class="title-index">
            <span class="title-name">Sản phẩm đã xem</span>
            <img width="202" height="20" class="lazyload loaded" 
                 src="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/title.png?1735117293436" 
                 data-src="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/title.png?1735117293436" 
                 alt="title">
        </h3>
        <div class="sliderecenreview">
            <div class="product-flash-swiper swiper-container">
                <div class="swiper-wrapper" id="recently-viewed-products">
                    <!-- Sản phẩm đã xem sẽ được render vào đây -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let productId = "<?php echo $product_id; ?>"; // Lấy ID từ PHP
    let viewedProducts = JSON.parse(localStorage.getItem("viewed_products")) || [];

    // Xóa sản phẩm nếu đã tồn tại để tránh trùng lặp
    viewedProducts = viewedProducts.filter(id => id !== productId);

    // Thêm sản phẩm mới vào đầu danh sách
    viewedProducts.unshift(productId);

    // Chỉ giữ 8 sản phẩm gần nhất
    if (viewedProducts.length > 8) {
        viewedProducts = viewedProducts.slice(0, 8);
    }

    localStorage.setItem("viewed_products", JSON.stringify(viewedProducts));
});
// Sử dụng jQuery để lấy dữ liệu sản phẩm đã xem
$(document).ready(function () {
    let viewedProducts = JSON.parse(localStorage.getItem("viewed_products")) || [];
    if (viewedProducts.length > 0) {
        $.ajax({
            url: "../action/get_recent_products.php",
            method: "POST",
            data: { product_ids: JSON.stringify(viewedProducts) }, // Gửi JSON chuỗi
            dataType: "json",
            success: function (response) {
				console.log("Response từ server:", response); // Kiểm tra dữ liệu nhận về
                if (response.length > 0) {
                    let html = "";
                    response.forEach(product => {
                        html += `
                        <div class="swiper-slide swiper-slide-active" style="width: 193.5px; margin-right: 15px;">
                            <div class=" item_product_main">
						<form action="/cart/add" method="post" class="variants product-action">                    
                                <div class="product-thumbnail">
                                    <a class="image_thumb scale_hover" href="/about/chitietsanpham.php?id=${product.id}" title="${product.name}">
                                        <img src="${product.img}" alt="${product.name}" width="234" height="234">
                                    </a>
									<div class="smart">
                    					<span class="sale">${product.sale}%</span>
                					</div>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-name">
                                        <a href="/about/chitietsanpham.php?id=${product.id}" title="${product.name}">${product.name}</a>
                                    </h3>
                                    <div class="price-box">
										<span class="compare-price">${parseInt(product.price).toLocaleString()}₫</span>
    									<span class="discount-price">
        									${parseInt(product.price - (product.price * product.sale / 100)).toLocaleString()}₫
    									</span>
									</div>
                                </div>
                            </form>
							</div>
                        </div>`;
                    });
                    $("#recently-viewed-products").html(html);
                }
            }
        });
    }
});
</script>
		</div>
	</div>
	<link rel="preload" as="style" href="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/ajaxcart.scss.css?1735117293436" type="text/css">
	<link href="//bizweb.dktcdn.net/100/492/035/themes/919334/assets/ajaxcart.scss.css?1735117293436" rel="stylesheet" type="text/css" media="all">
	<script>
		function changeMainImage(src) {
			document.getElementById('mainImage').src = src;
		}
	</script>
	<script>
		function toggleSection(section) {
			var guide = document.getElementById('purchase-guide');
			var description = document.getElementById('product-description');
			var guideTab = document.getElementById('guide-tab');
			var descriptionTab = document.getElementById('description-tab');


			if (section === 'description') {
				description.classList.remove('hidden');
				guide.classList.add('hidden');
				descriptionTab.classList.add('underline-yellow');
				descriptionTab.classList.remove('text-black');
				guideTab.classList.remove('underline-yellow');
				guideTab.classList.add('text-black');
			} else {
				guide.classList.remove('hidden');
				description.classList.add('hidden');
				guideTab.classList.add('underline-yellow');
				guideTab.classList.remove('text-black');
				descriptionTab.classList.remove('underline-yellow');
				descriptionTab.classList.add('text-black');
			}
		}

		window.onload = function() {
			toggleSection('guide');
		}
	</script>
	<script src="/js/placeholdertypewriter.js" type="text/javascript"></script>
	<script src="/js/main.js" type="text/javascript"></script>
	<script src="/js/index.js" type="text/javascript"></script>
	<link href="/css/ajaxcart.scss.css" rel="stylesheet" type="text/css" media="all">
	<?php include "footer.php" ?>
</body>

</html>
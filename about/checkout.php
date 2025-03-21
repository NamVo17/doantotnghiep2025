<?php
include('connect.php');
if (!isset($_SESSION['user_id'])) { 
    header("Location: /login.php"); // Chưa đăng nhập -> về trang đăng nhập
    exit();
}

if (!isset($_GET['token']) || !isset($_SESSION['checkout_token']) || $_GET['token'] !== $_SESSION['checkout_token']) {
    header("Location: /giohang.php"); // Nếu mở trực tiếp mà không bấm nút -> về giỏ hàng
    exit();
}

// Xóa token ngay khi vào để tránh bị copy link
unset($_SESSION['checkout_token']);


if (isset($_SESSION['user_id'])) {
    // Lấy user_id từ session
    $user_id = $_SESSION['user_id'];

    // Truy vấn lấy thông tin người dùng
    $query = "SELECT firstName, lastName FROM account WHERE User_id = ?";
    $stmt = $conn->prepare($query);

    // Kiểm tra xem câu lệnh có chuẩn bị thành công không
    if ($stmt === false) {
        die('Query preparation failed: ' . $conn->error);
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName);
    $stmt->fetch();
    $stmt->close();

    // Nếu tìm thấy thông tin người dùng, hiển thị tên
    if ($firstName && $lastName) {
        $user_name = $firstName . ' ' . $lastName;
    }

    // Truy vấn giỏ hàng của user_id
    $cart_query = "SELECT id, name, price, img, so_luong
        FROM giohang
        WHERE user_id = ?";

    $cart_stmt = $conn->prepare($cart_query);

    // Kiểm tra nếu câu lệnh chuẩn bị thành công
    if ($cart_stmt === false) {
        die('Query preparation failed: ' . $conn->error);
    }
    $cart_stmt->bind_param("i", $user_id);
    $cart_stmt->execute();
    $cart_stmt->store_result();
    $cart_stmt->bind_result($product_id, $product_name, $product_price, $product_img, $quantity);

    $id_sanpham_array = [];
    // Tính tổng tiền của tất cả sản phẩm trong giỏ hàng
    $total_price = 0;
    while ($cart_stmt->fetch()) {
        $total_price += $quantity * $product_price;
        $id_sanpham_array[] = $product_id; // Lưu ID sản phẩm vào mảng
    }
    $id_sanpham_str = implode(";", $id_sanpham_array); // Chuyển thành chuỗi "1;2;3"

    // Tính phí vận chuyển và tổng cộng
    $shipping_fee = 40000; //  VND
    $total_amount = $total_price + $shipping_fee;

    // Reset the result pointer for displaying products
    $cart_stmt->data_seek(0);
}

?>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Sweet Tea House</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" />
    <style>
        #shipping-fee {
            display: block !important;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="flex flex-col lg:flex-row">
            <!-- Left Section -->
            <div class="w-full lg:w-1/3 bg-white p-6 rounded shadow-md">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold">Thông tin nhận hàng</h2>
                    <a class="text-blue-500 flex items-center" href="login.php">
                        <i class="fas fa-user-circle mr-2"></i>
                        <?php echo isset($user_name) ? $user_name : 'Đăng nhập'; ?> </a>
                </div>
                <form>
                    <div class="mb-4">
                        <input id="ten" class="w-full p-2 border rounded" placeholder="Họ và tên" type="text" />
                    </div>
                    <div class="mb-4 flex items-center">
                        <input id="sdt" class="w-full p-2 border rounded" placeholder="Số điện thoại (tùy chọn)" type="text" />
                        <div class="ml-2">
                            <img alt="Vietnam flag" class="w-6 h-6" height="20" src="/image/icon_checkout.png" width="20" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <input id="diachi" class="w-full p-2 border rounded" placeholder="Địa chỉ (tùy chọn)" type="text" />
                    </div>
                    <div class="mb-4">
                        <select class="w-full p-2 border rounded" id="tinhThanh" onchange="loadQuanHuyen()">
                            <option value="">Chọn tỉnh thành</option>
                            <option value="1">Hà Nội</option>
                            <option value="2">Tp.HCM</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <select class="w-full p-2 border rounded" id="quanHuyen" disabled onchange="loadPhuongXa()">
                            <option value="">Chọn quận huyện</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <select class="w-full p-2 border rounded" id="phuongXa" disabled="">
                            <option value="">Chọn phường xã</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <textarea class="w-full p-2 border rounded" placeholder="Ghi chú (tùy chọn)"></textarea>
                    </div>
                </form>
            </div>
            <!-- Middle Section -->
            <div class="w-full lg:w-1/3 bg-white p-6 rounded shadow-md mt-6 lg:mt-0 lg:mx-6">
                <div class="mt-6">
                    <h2 class="text-xl font-semibold">Vận chuyển</h2>
                    <div class="bg-blue-100 p-3 rounded mt-2">Vui lòng nhập thông tin giao hàng</div>
                </div>
                <div class="mt-6">
                    <h2 class="text-xl font-semibold ">Thanh toán</h2>
                    <div class="border rounded p-4 mt-2 payment-method">
                        <div class="flex items-center mb-4">
                            <input class="mr-2 payment-option" id="bank" name="payment" type="radio" value="bank" />
                            <label class="flex items-center" for="bank">
                                Chuyển khoản <i class="fas fa-money-check-alt ml-2"></i>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input class="mr-2 payment-option" id="cod" name="payment" type="radio" value="cod" />
                            <label class="flex items-center" for="cod">
                                Thu hộ (COD) <i class="fas fa-money-bill-wave ml-2"></i>
                            </label>
                        </div>
                        <span id="payment-error" class="error text-red-500 block mt-2 hidden">Vui lòng chọn phương thức thanh toán</span>
                    </div>
                </div>
            </div>
            <!-- Right Section -->
            <div class="w-full lg:w-1/3 bg-white p-6 rounded shadow-md mt-6 lg:mt-0 lg:ml-6">
                <h2 class="text-xl font-semibold mb-6">Đơn hàng</h2>

                <?php
                // Nếu có sản phẩm trong giỏ hàng
                if ($cart_stmt->num_rows > 0) {
                    while ($cart_stmt->fetch()) {
                        echo '<div class="flex items-center mb-4">';
                        echo '<img alt="Product image" class="w-16 h-16 rounded mr-4" height="60" src="' . $product_img . '" width="60" />';
                        echo '<div>';
                        echo '<p>' . $product_name . '</p>';
                        echo '<p class="text-gray-500">' . number_format($quantity * $product_price, 0, '.', ',') . '₫</p>';
                        echo '<p class="text-gray-500">Số lượng: ' . $quantity . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Giỏ hàng của bạn hiện tại chưa có sản phẩm nào.</p>';
                }
                ?>
                <div class="mb-4">
                    <input class="w-full p-3 border rounded" placeholder="Nhập mã giảm giá" type="text" />
                    <button class="bg-blue-500 text-white p-3 rounded mt-2 w-full">Áp dụng</button>
                </div>
                <!-- Hiển thị Tạm tính, Phí vận chuyển và Tổng cộng -->
                <div class="mb-4">
                    <div class="flex justify-between">
                        <p>Tạm tính</p>
                        <p><?php echo number_format($total_price, 0, '.', ',') . '₫'; ?></p>
                    </div>
                    <div class="flex justify-between ">
                        <p>Phí vận chuyển</p>
                        <p id="shipping-fee1"> <?php echo number_format($shipping_fee, 0, '.', ',') . '₫'; ?> </p>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="flex justify-between font-semibold">
                        <p>Tổng cộng</p>
                        <p class="total-amount"><?php echo number_format($total_amount, 0, '.', ',') . '₫'; ?></p>
                    </div>
                </div>

                <div class="mb-4">
                    <a class="text-blue-500" href="giohang.php">Quay về giỏ hàng</a>
                </div>
                <button id="btnDatHang" class="bg-blue-500 text-white p-3 rounded w-full">ĐẶT HÀNG</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
    let totalPrice = <?php echo $total_price; ?>; // Lấy giá trị tạm tính từ PHP
    let shippingFee = <?php echo $shipping_fee; ?>; // Lấy phí vận chuyển từ PHP
    let isShippingAdded = false; // Kiểm tra phí vận chuyển đã cộng hay chưa

    $("#shipping-fee1").hide(); // Ẩn phí vận chuyển mặc định
    updateTotal(totalPrice); // Tổng cộng ban đầu = Tạm tính

    $("#tinhThanh").change(function() {
        if ($(this).val() !== "" && !isShippingAdded) { 
            $("#shipping-fee1").show(); // Hiện phí vận chuyển
            updateTotal(totalPrice + shippingFee); // Cập nhật tổng cộng
            isShippingAdded = true; // Đánh dấu đã cộng phí vận chuyển
        }
    });

    function updateTotal(newTotal) {
        $(".total-amount").text(newTotal.toFixed(0).replace(/\./g, '.') + "₫");
    }  
});


    </script>
    <script>
        const data = {
            "1": {
                name: "Hà Nội",
                districts: [{
                        id: "1-1",
                        name: "Quận Ba Đình"
                    },
                    {
                        id: "1-2",
                        name: "Quận Hoàn Kiếm"
                    },
                    {
                        id: "1-3",
                        name: "Quận Tây Hồ"
                    },
                    // Thêm các quận khác của Hà Nội ở đây
                ]
            },
            "2": {
                name: "TP.HCM",
                districts: [{
                        id: "2-1",
                        name: "Quận 1"
                    },
                    {
                        id: "2-2",
                        name: "Quận 2"
                    },
                    {
                        id: "2-3",
                        name: "Quận 3"
                    },
                    // Thêm các quận khác của TP.HCM ở đây
                ]
            },
            // Thêm dữ liệu cho các tỉnh thành khác ở đây
        };

        function loadQuanHuyen() {
            const tinhThanhId = document.getElementById("tinhThanh").value;
            const quanHuyenSelect = document.getElementById("quanHuyen");
            const phuongXaSelect = document.getElementById("phuongXa");

            if (tinhThanhId) {
                // Enable quận huyện
                quanHuyenSelect.disabled = false;

                // Clear current options
                quanHuyenSelect.innerHTML = '<option value="">Chọn quận huyện</option>';

                // Add new options based on the selected province
                const districts = data[tinhThanhId].districts;
                districts.forEach(district => {
                    const option = document.createElement("option");
                    option.value = district.id;
                    option.textContent = district.name;
                    quanHuyenSelect.appendChild(option);
                });
            } else {
                quanHuyenSelect.disabled = true;
                phuongXaSelect.disabled = true;
                phuongXaSelect.innerHTML = '<option value="">Chọn phường xã</option>';
            }

            // Reset phường xã
            phuongXaSelect.innerHTML = '<option value="">Chọn phường xã</option>';
        }

        function loadPhuongXa() {
            const quanHuyenId = document.getElementById("quanHuyen").value;
            const phuongXaSelect = document.getElementById("phuongXa");

            if (quanHuyenId) {
                phuongXaSelect.disabled = false;
                // Load phường xã cho quận huyện đã chọn (giả định)
                phuongXaSelect.innerHTML = '<option value="">Chọn phường xã</option>';
                // Thêm các phường xã mẫu (thực tế bạn sẽ lấy từ database)
                const phuongXa = [{
                        id: "1-1-1",
                        name: "Phường Cửa Đông"
                    },
                    {
                        id: "1-1-2",
                        name: "Phường Cửa Nam"
                    }
                ];
                phuongXa.forEach(p => {
                    const option = document.createElement("option");
                    option.value = p.id;
                    option.textContent = p.name;
                    phuongXaSelect.appendChild(option);
                });
            } else {
                phuongXaSelect.disabled = true;
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            console.log("Số lượng sản phẩm trong giỏ:", $(".cart-item").length);
            $("#btnDatHang").click(function(e) {
                e.preventDefault();

                let ten = $("#ten").val().trim();
                let sdt = $("#sdt").val().trim();
                let diachi = $("#diachi").val().trim();
                let tinh = $("#tinhThanh option:selected").text();
                let quan = $("#quanHuyen option:selected").text();
                let xa = $("#phuongXa option:selected").text();
                let payment = $("input[name='payment']:checked").val();
                let user_id = <?php echo isset($user_id) ? $user_id : 'null'; ?>;

                let isValid = true;

                $(".error").remove(); // Xóa thông báo lỗi cũ

                // Kiểm tra Họ và Tên
                if (ten === "") {
                    $("#ten").after('<span class="error text-red-500">Vui lòng nhập họ và tên</span>');
                    isValid = false;
                }

                // Kiểm tra Số điện thoại (10 số)
                let sdtRegex = /^[0-9]{10}$/;
                if (!sdtRegex.test(sdt)) {
                    $("#sdt").after('<span class="error text-red-500">Số điện thoại không hợp lệ</span>');
                    isValid = false;
                }

                // Kiểm tra Địa chỉ
                if (diachi === "") {
                    $("#diachi").after('<span class="error text-red-500">Vui lòng nhập địa chỉ</span>');
                    isValid = false;
                }

                // Kiểm tra Tỉnh/Thành phố
                if (tinh === "") {
                    $("#tinhThanh").after('<span class="error text-red-500">Vui lòng chọn tỉnh/thành phố</span>');
                    isValid = false;
                }

                // Kiểm tra Quận/Huyện
                if (quan === "") {
                    $("#quanHuyen").after('<span class="error text-red-500">Vui lòng chọn quận/huyện</span>');
                    isValid = false;
                }

                // Kiểm tra Phường/Xã
                if (xa === "") {
                    $("#phuongXa").after('<span class="error text-red-500">Vui lòng chọn phường/xã</span>');
                    isValid = false;
                }

                // Kiểm tra phương thức thanh toán
                if (!payment) {
                    $(".payment-method").after('<span class="error text-red-500 block mt-2">Vui lòng chọn phương thức thanh toán</span>');
                    isValid = false;
                }

                // Nếu hợp lệ, xử lý đặt hàng
                if (isValid) {
                    $("#order-confirmation").css("display", "block");

                    // Hiển thị thông tin lên trang xác nhận
                    $("#confirm-name").text(ten);
                    $("#confirm-phone").text(sdt);
                    $("#confirm-address").text(`${diachi}, ${xa}, ${quan}, ${tinh}`);
                    $("#confirm-payment").text(payment);
                    $("#order-confirmation").fadeIn().css("display", "flex");

                    let paymentAmount = $("#payment-amount").text().replace(/[₫,]/g, ''); // Lấy giá trị và loại bỏ dấu ',' và '₫'
                    let shippingFee = $("#shipping-fee").text().replace(/[₫,]/g, '');
                    let totalAmount = $("#total-amount").text().replace(/[₫,]/g, '');

                    // Chuyển sang số để đảm bảo đúng kiểu dữ liệu
                    paymentAmount = parseFloat(paymentAmount) || 0;
                    shippingFee = parseFloat(shippingFee) || 0;
                    totalAmount = parseFloat(totalAmount) || 0;

                    $.ajax({
                        url: "/action/donhang.php",
                        type: "POST",
                        data: {
                            user_id: user_id,
                            ten: ten,
                            sdt: sdt,
                            dia_chi: `${diachi}, ${xa}, ${quan}, ${tinh}`,
                            tong_tien: paymentAmount,
                            phi_van_chuyen: shippingFee,
                            tong_cong: totalAmount,
                            pttt: payment,
                            id_sanpham: "<?php echo $id_sanpham_str; ?>"
                        },

                        success: function(response) {

                            console.log("Đơn hàng đã được lưu:", response);
                            if (response.trim() === "success") {
                                // Sau khi lưu đơn hàng, xóa giỏ hàng
                                $.ajax({
                                    url: "/action/xoa_giohang.php",
                                    type: "POST",
                                    data: {
                                        user_id: user_id
                                    },
                                    success: function() {
                                        console.log("Giỏ hàng đã được xóa.");
                                    }
                                });
                            }
                        },
                        error: function() {
                            console.log("Lỗi khi lưu đơn hàng.");
                        }
                    });


                }
            });
        });

        // Chức năng tiếp tục mua hàng
        function continueShopping() {
            window.location.href = "../index.php"; // Chuyển về trang danh sách sản phẩm
        }
    </script>
    <div id="order-confirmation" class="modal fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden ">
        <div class="modal-content bg-white p-8 rounded-lg shadow-lg w-full max-w-[600px] relative">
            <div class="text-center mb-6">
                <div class="flex items-center justify-center mb-4">
                    <i class="fas fa-check-circle text-green-500 text-4xl mr-2"></i>
                    <h2 class="text-3xl font-bold">Cảm ơn bạn đã đặt hàng</h2>
                </div>
                <p class="text-gray-600">Đơn hàng của bạn đã được xác nhận!</p>
            </div>
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Thông tin mua hàng</h3>
                <div class="space-y-2">
                    <p><strong>Họ tên:</strong> <span id="confirm-name"></span></p>
                    <p><strong>Số điện thoại:</strong> <span id="confirm-phone"></span></p>
                    <p><strong>Địa chỉ:</strong> <span id="confirm-address"></span></p>
                    <p><strong>Phương thức thanh toán:</strong> <span id="confirm-payment"></span></p>
                    <p><strong>Tiền thanh toán:</strong> <span id="payment-amount"></span></p>
                    <p><strong>Phí vận chuyển:</strong> <span id="shipping-fee"></span></p>
                    <p><strong>Tổng thanh toán:</strong> <span id="total-amount"></span></p>
                </div>
            </div>
            <button onclick="continueShopping()" class="bg-blue-500 text-white px-6 py-3 rounded-lg w-full hover:bg-blue-600 transition duration-300">Tiếp tục mua hàng</button>
        </div>
    </div>
    <script>
        document.getElementById("payment-amount").textContent = "<?php echo number_format($total_price, 0, '.', ','); ?>₫";
        document.getElementById("shipping-fee").textContent = "<?php echo number_format($shipping_fee, 0, '.', ','); ?>₫";
        document.getElementById("total-amount").textContent = "<?php echo number_format($total_amount, 0, '.', ','); ?>₫";
    </script>
</body>

</html>
// Frontend: Giao diện chatbot (HTML + CSS + JavaScript)
const chatbotUI = `
    <div id="chatbot-button" onclick="toggleChatbot()">💬</div>
    <div id="chat-container">
        <div id="chat-header">Chat với chúng tôi</div>
        <div id="chat-box"></div>
        <div id="chat-input">
            <input type="text" id="user-input" placeholder="Nhập tin nhắn...">
            <button onclick="sendMessage()">Gửi</button>
        </div>
    </div>`;
function toggleChatbot() {
        const chatContainer = document.getElementById("chat-container");
        if (chatContainer.style.display === "none" || chatContainer.style.display === "") {
            chatContainer.style.display = "flex";
    
            // Kiểm tra nếu chưa có tin nhắn chào mừng thì mới gửi
            if (!document.getElementById("chat-box").dataset.welcome) {
                document.getElementById("chat-box").innerHTML += `<p>Sweet Tea House xin chào! Không biết chúng tôi có thể giúp gì cho bạn không?</p>`;
                document.getElementById("chat-box").dataset.welcome = "true"; // Đánh dấu đã gửi tin nhắn chào
            }
        } else {
            chatContainer.style.display = "none";
        }
    }
    
    let step = 0; // Trạng thái bước hỏi
let chatState = ""; // Trạng thái chatbot để biết đang hỏi về thông tin gì
let orderDetails = {}; // Lưu thông tin đặt hàng

function sendMessage() {
    const userInput = document.getElementById("user-input").value.trim();
    if (!userInput) return;

    const chatBox = document.getElementById("chat-box");

    // Hiển thị tin nhắn người dùng
    chatBox.innerHTML += `
        <div class="user-container">
            <div class="message user-message">${userInput}</div>
        </div>`;
    document.getElementById("user-input").value = "";

    // Hiển thị trạng thái "đang suy nghĩ..."
    const botTyping = document.createElement("div");
    botTyping.classList.add("bot-container");
    botTyping.innerHTML = `<div class="message bot-message">...</div>`;
    botTyping.id = "bot-typing";
    chatBox.appendChild(botTyping);
    chatBox.scrollTop = chatBox.scrollHeight;

    setTimeout(() => {
        let botReply = "";

        if (step === 1) {
            orderDetails.price = userInput;
            botReply = "Mô tả hương vị bánh mà bạn thích?🎂";
            step = 2;  
        }else if (step === 2) {
            orderDetails.flavor = userInput;
        
            // Gửi dữ liệu lên PHP để tìm bánh phù hợp
            fetch("/action/tim_banh.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ price: orderDetails.price, flavor: orderDetails.flavor })
            })
            .then(response => response.json())
            .then(data => {
                let reply = "";
                if (data.status === "success") {
                    reply = "Dưới đây là các loại bánh phù hợp với bạn: <br>";
                    data.data.forEach(banh => {
                        reply += `🎂 ${banh.name} - ${banh.price}đ <br>`;
                    });
                } else {
                    reply = "Xin lỗi, không tìm thấy bánh nào phù hợp với sở thích của bạn! 😢";
                }
        
                chatBox.innerHTML += `
                    <div class="bot-container">
                        <div class="message bot-message">${reply}</div>
                    </div>`;
                chatBox.scrollTop = chatBox.scrollHeight;
            })
            .catch(error => console.error("Lỗi:", error));
        
            step = 0;
        } else if (chatState === "waiting_for_order_details" && step === 3) {
            orderDetails.banh = userInput;
            botReply = "Bạn vui lòng cho biết tên, số điện thoại và địa chỉ để hoàn tất đơn hàng.";
            chatState = "waiting_for_contact_info";
            step = 4;
        } else if (chatState === "waiting_for_contact_info" && step === 4) {
            orderDetails.contact = userInput;
            botReply = "Chúng tôi đã nhận được thông tin! Chúng tôi sẽ liên hệ với bạn để xác nhận đơn hàng. 📞";

            // Gửi đơn hàng lên server
            fetch("/action/dathang.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(orderDetails)
            }).then(response => response.json())
            .then(data => console.log("Đặt hàng thành công:", data))
            .catch(error => console.error("Lỗi gửi đơn hàng:", error));

            // Reset lại trạng thái
            step = 0;
            orderDetails = {};
        } else {
            if (["mua", "giới thiệu", "gợi ý"].some(keyword => userInput.includes(keyword))) {
                botReply = "Bạn muốn tìm bánh trong tầm giá nào?🏷️";
                step = 1;
                botTyping.remove();
                // Hiển thị bảng giá
                const questionMessage  = `
                    <div class="bot-container">
                        <div class="message bot-message ">Bạn muốn tìm bánh trong tầm giá nào?</div>
                    </div>
                    <div class="bot-container">
                        <div class="message bot-message ">
                            <button class="price-btn" onclick="selectPrice('100k - 200k')">100k - 200k</button>
                            <button class="price-btn" onclick="selectPrice('200k - 300k')">200k - 300k</button>
                            <button class="price-btn" onclick="selectPrice('300k trở lên')">300k trở lên</button>
                        </div>
                    </div>`;
                chatBox.innerHTML += questionMessage; // Hiển thị câu hỏi trước
                chatBox.scrollTop = chatBox.scrollHeight;
                return;

            } else if (["hương vị", "mô tả"].some(keyword => userInput.includes(keyword))) {
                botReply = "Mô tả hương vị bánh mà bạn thích ";
                step = 2;
            } else if (["hỗ trợ", "giúp", "help"].some(keyword => userInput.includes(keyword))) {
                botReply = "Bạn cần chúng tôi hỗ trợ gì? 😊";
            } else if (["mở của", "giờ", "làm việc"].some(keyword => userInput.includes(keyword))) {
                botReply = "Thời gian làm việc 9h - 22h từ thứ 2 đến chủ nhật";
            } else if (["giao hàng", "ship", ].some(keyword => userInput.includes(keyword))) {
                    botReply = "Chúng tôi có nhận giao hàng nhưng sẽ tính phí nhé !";
            } else if (["trả hàng", "hoàn tiền"].some(keyword => userInput.includes(keyword))) {
                botReply = "Bạn có thể trả hàng sau khi nhận mà không vừa ý <b>Chỉ trả được khi sản phẩm không bị hư tổn</b>. Bạn sẽ được hoàn tiền khi chúng tôi kiểm tra là bánh không có vấn đề!";
            } else if (["khuyến mãi", "ưu đãi"].some(keyword => userInput.includes(keyword))) {
                botReply = "Hiện tại đang có chương trình <b>Mua 2 bánh tặng 1 nước tùy ý</b>. Bạn có muốn đặt hàng ngay không? 🎉";
            } else if (["đặt", "bánh"].some(keyword => userInput.includes(keyword))) {
                botReply = "Tất nhiên rồi! Bạn chỉ cần cho tôi biết loại bánh, sở thích, độ ngọt, giá tiền... và ghi chú (nếu có). Tôi sẽ làm ngay cho bạn!";
                chatState = "waiting_for_order_details";
                step = 3;
            } else {
                botReply = "Xin lỗi, tôi chưa hiểu yêu cầu của bạn. Bạn có thể hỏi về đặt bánh, chương trình khuyến mãi hoặc giờ mở cửa nhé!";
            }
        }

        // Xóa trạng thái "đang suy nghĩ..."
        botTyping.remove();

        // Hiển thị tin nhắn của bot
        chatBox.innerHTML += `
            <div class="bot-container">
                <div class="message bot-message">${botReply}</div>
            </div>`;
        chatBox.scrollTop = chatBox.scrollHeight;
    }, 2000);
}
// Hàm xử lý khi chọn mức giá
function selectPrice(price) {
    orderDetails.price = price;

    const chatBox = document.getElementById("chat-box");

    // Hiển thị tin nhắn của người dùng
    chatBox.innerHTML += `
        <div class="user-container">
            <div class="message user-message">${price}</div>
        </div>`;

    // Hiển thị tin nhắn tiếp theo của bot
    chatBox.innerHTML += `
        <div class="bot-container">
            <div class="message bot-message">Mô tả hương vị bánh mà bạn thích?🎂</div>
        </div>`;

    step = 2;
    chatBox.scrollTop = chatBox.scrollHeight;
}

    
document.body.innerHTML += chatbotUI;
document.getElementById("user-input").addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        sendMessage();
    }
});

const style = document.createElement('style');
style.innerHTML = `
    #chatbot-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: #d4a373;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            cursor: pointer;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            z-index: 9999; /* Đảm bảo chatbot luôn hiển thị trên cùng */
        }
        #chat-container {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 350px;
            background: white;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            display: none;
            flex-direction: column;
            z-index: 9999; /* Đảm bảo chatbot luôn hiển thị trên cùng */
        }
        #chat-header {
            background: #d4a373;
            color: white;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        #chat-box {
            height: 200px;
            overflow-y: auto;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            
        }
        #chat-input {
            display: flex;
            padding: 10px;
        }
        #user-input {
            flex: 1;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            margin-left: 5px;
            padding: 5px 10px;
            background: #d4a373;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        #chat-box {
            height: 350px;
            overflow-y: auto;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .message {
            max-width: 80%;
            padding: 8px 12px;
            border-radius: 12px;
            font-size: 14px;
            word-wrap: break-word;
        }

        .user-message {
            align-self: flex-end;
            background: #007bff;
            color: white;
            border-bottom-right-radius: 4px;
        }

        .bot-message {
            align-self: flex-start;
            background: #f1f1f1;
            color: black;
            border-bottom-left-radius: 4px;
        }

        .user-avatar, .bot-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .user-container, .bot-container {
            display: flex;
            align-items: flex-end;
        }

        .user-container {
            justify-content: flex-end;
        }

        .bot-container {
            justify-content: flex-start;
        }
        .price-btn {
            background: #d4a373;
            color: white;
            border: none;
            padding: 5px 10px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
        }
        .price-btn:hover {
            background: #b5835a;
        }


`;
document.head.appendChild(style);

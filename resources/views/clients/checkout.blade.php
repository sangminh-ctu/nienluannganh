 @include('clients.blocks.header')
 @include('clients.blocks.banner')  


<section class="container" >
        <h1 class="text-center checkout-header">Tổng Quan Về Chuyến Đi</h1>

        <form action="javascript:void(0);" method="post" class="checkout-container">
            <!-- Contact Information -->
            <div class="checkout-info">
                <h2 class="checkout-header">Thông Tin Liên Lạc</h2>
                <div class="checkout__infor">
                    <div class="form-group">
                        <label for="username">Họ và tên*</label>
                        <input type="text" id="username" placeholder="Nhập Họ và tên" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email" id="email" placeholder="sample@gmail.com" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="tel">Số điện thoại*</label>
                        <input type="tel" id="tel" placeholder="Nhập số điện thoại liên hệ" name="tel" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ*</label>
                        <input type="text" id="address" placeholder="Nhập địa chỉ liên hệ" name="dia_chi" required>
                    </div>
                </div>


                <!-- Passenger Details -->
                <h2 class="checkout-header">Hành Khách</h2>

                <div class="checkout__quantity">
                    <div class="form-group quantity-selector">
                        <label>Người lớn</label>
                        <div class="input__quanlity">
                            <button type="button" class="quantity-btn">-</button>
                            <input type="number" class="quantity-input" value="1" min="1" readonly>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                    </div>

                    <div class="form-group quantity-selector">
                        <label>Trẻ em</label>
                        <div class="input__quanlity">
                            <button type="button" class="quantity-btn">-</button>
                            <input type="number" class="quantity-input" value="1" min="1" readonly>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                    </div>
                </div>
                <!-- Privacy Agreement Section -->
                <div class="privacy-section">
                    <p>Bằng cách nhấp chuột vào nút "ĐỒNG Ý" dưới đây, Khách hàng đồng ý rằng các điều kiện điều khoản
                        này sẽ được áp dụng. Vui lòng đọc kỹ điều kiện điều khoản trước khi lựa chọn sử dụng dịch vụ.</p>
                    <div class="privacy-checkbox">
                        <input type="checkbox" id="agree" name="agree" required>
                        <label for="agree">Tôi đã đọc và đồng ý với <a href="#" target="_blank">Điều khoản thanh
                                toán</a></label>
                    </div>
                </div>
                <!-- Payment Method -->
                <h2 class="checkout-header">Phương Thức Thanh Toán</h2>

                <label class="payment-option">
                    <input type="radio" name="payment" required>
                    <img src="{{ asset('clients/assets/images/checkout/vanphong.jpg')}}" alt="Office Payment">
                    Thanh toán tại văn phòng
                </label>

                <label class="payment-option">
                    <input type="radio" name="payment" required>
                    <img src="{{ asset('clients/assets/images/checkout/paypal.png')}}" alt="PayPal">
                    Thanh toán bằng PayPal
                </label>

                <label class="payment-option">
                    <input type="radio" name="payment" required>
                    <img src="{{ asset('clients/assets/images/checkout/momo.png')}}" alt="MoMo">
                    Thanh toán bằng Momo
                </label>


            </div>

            <!-- Order Summary -->
            <div class="checkout-summary">
                <div class="summary-section">
                    <div>
                        <p>Mã tour : </p>
                        <h4>Tên Tour</h4>
                        <p>Ngày khởi hành : </p>

                        <p>Ngày kết thúc : </p>
                    </div>

                    <div class="order-summary">
                        <div class="summary-item">
                            <span>Người lớn:</span>
                            <span class="total-price">0 VNĐ</span>
                        </div>
                        <div class="summary-item">
                            <span>Trẻ em:</span>
                            <span class="total-price">0 VNĐ</span>
                        </div>
                        <div class="summary-item total-price">
                            <span>Tổng cộng:</span>
                            <span>0 VNĐ</span>
                        </div>
                    </div>

                    <button type="submit" class="checkout-btn">Xác Nhận và Thanh Toán</button>
                </div>
            </div>
        </form>
    </section>


@include('clients.blocks.footer')
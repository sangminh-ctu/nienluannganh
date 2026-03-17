 @include('clients.blocks.header')
 @include('clients.blocks.banner')


 <section class="container" style="margin-top:50px ">
     {{-- <h1 class="text-center booking-header">Tổng Quan Về Chuyến Đi</h1> --}}

     <form action="{{ route('create-booking') }}" method="POST" class="booking-container">
         <!-- Contact Information -->
         @csrf
        
         <div class="booking-info">
             <h2 class="booking-header">Thông Tin Liên Lạc</h2>
             <div class="booking__infor">
                 <div class="form-group">
                     <label for="username">Họ và tên*</label>
                     <input type="text" id="username" placeholder="Nhập Họ và tên" name="fullName" required>
                 </div>

                 <div class="form-group">
                     <label for="email">Email*</label>
                     <input type="email" id="email" placeholder="sample@gmail.com" name="email" required>
                 </div>

                 <div class="form-group">
                     <label for="tel">Số điện thoại*</label>
                     <input type="tel" id="tel" placeholder="Nhập số điện thoại liên hệ" name="tel"
                         required>
                 </div>

                 <div class="form-group">
                     <label for="address">Địa chỉ*</label>
                     <input type="text" id="address" placeholder="Nhập địa chỉ liên hệ" name="address" required>
                 </div>
             </div>


             <!-- Passenger Details -->
             <h2 class="booking-header">Hành Khách</h2>
              <div class="booking__quantity">
                <div class="form-group quantity-selector">
                    <label>Người lớn</label>
                    <div class="input__quanlity">
                        <button type="button" class="quantity-btn">-</button>
                        <input type="number" class="quantity-input" value="1" min="1" id="numAdults"
                            name="numAdults" data-price-adults="10000" readonly>
                        <button type="button" class="quantity-btn">+</button>
                    </div>
                </div>

                <div class="form-group quantity-selector">
                    <label>Trẻ em</label>
                    <div class="input__quanlity">
                        <button type="button" class="quantity-btn">-</button>
                        <input type="number" class="quantity-input" value="0" min="0" id="numChildren"
                            name="numChildren" data-price-children="50000" readonly>
                        <button type="button" class="quantity-btn">+</button>
                    </div>
                </div>
            </div>
             <!-- Privacy Agreement Section -->
             <div class="privacy-section">
                <p>Bằng cách nhấp chuột vào nút "ĐỒNG Ý" dưới đây, Khách hàng đồng ý rằng các điều kiện điều khoản
                    này sẽ được áp dụng. Vui lòng đọc kỹ điều kiện điều khoản trước khi lựa chọn sử dụng dịch vụ của
                    Travela.</p>
                <div class="privacy-checkbox">
                    <input type="checkbox" id="agree" name="agree" required>
                    <label for="agree">Tôi đã đọc và đồng ý với <a href="#" target="_blank">Điều khoản thanh
                            toán</a></label>
                </div>
            </div>
             <!-- Payment Method -->
             <h2 class="booking-header">Phương Thức Thanh Toán</h2>

             <label class="payment-option">
                 <input type="radio" name="payment" value="office-payment" required>
                 <img src="{{ asset('clients/assets/images/checkout/vanphong.jpg') }}" alt="Office Payment">
                 Thanh toán tại văn phòng
             </label>

             <label class="payment-option">
                 <input type="radio" name="payment" value="paypal-payment" required>
                 <img src="{{ asset('clients/assets/images/checkout/paypal.png') }}" alt="PayPal">
                 Thanh toán bằng PayPal
             </label>

             <label class="payment-option">
                 <input type="radio" name="payment" value="momo-payment" required>
                 <img src="{{ asset('clients/assets/images/checkout/momo.png') }}" alt="MoMo">
                 Thanh toán bằng Momo
             </label>


         </div>

         <!-- Order Summary -->
         <div class="booking-summary">
             <div class="summary-section">
                 <div>
                     <p>Mã tour :{{ $tour->tourId }} </p>
                     <input type="hidden" name="tourId" id="tourId" value="{{ $tour->tourId }}">
                     <h5 class="widget-title">{{ $tour->title }}</h5>
                     <p>Ngày khởi hành : {{ $tour->startDate }}</p>

                     <p>Ngày kết thúc : {{ $tour->endDate }} </p>
                 </div>

                 <div class="order-summary">
                     <div class="summary-item">
                         <span>Người lớn:</span>
                         <div>
                             <span class="quantity_adults">1</span>
                             <span>X</span>
                             <span class="total-price">0 VNĐ</span>
                         </div>
                     </div>
                     <div class="summary-item">
                         <span>Trẻ em:</span>
                         <div>
                             <span class="quantity_children">0</span>
                             <span>X</span>
                             <span class="total-price">0 VNĐ</span>
                         </div>
                     </div>
                     <div class="summary-item">
                         <span>Giảm giá:</span>
                         <div>
                             <span class="total-price">0 VNĐ</span>
                         </div>
                     </div>
                     <div class="summary-item total-price">
                         <span>Tổng cộng:</span>
                         <span>0 VNĐ</span>
                         <input type="hidden" class="totalPrice" name="totalPrice" id="" value="">
                     </div>

                     <div class="order-coupon">
                         <input type="text" placeholder="Mã giãm giá" style="width: 65%">
                         <button style="width: 30%" class="booking-btn btn-coupon">Áp dụng</button>
                     </div>
                 </div>

                 <button type="submit" class="booking-btn btn-submit-booking">Xác Nhận và Thanh Toán</button>
             </div>
         </div>
     </form>
 </section>


 @include('clients.blocks.footer')
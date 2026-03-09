@include('clients.blocks.header')
{{-- @include('clients.blocks.banner') --}}

{{-- Banner --}}
    <section class="page-banner-two rel z-1">
        <div class="container-fluid">
        <hr class="mt-0">
        <div class="container">
            <div class="banner-inner pt-15 pb-25">
                <h2 class="page-title mb-10 aos-init aos-animate" data-aos="fade-left" data-aos-duration="1500"
                    data-aos-offset="50">{{ $tourDetail->destination }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-20 aos-init aos-animate" data-aos="fade-right"
                        data-aos-delay="200" data-aos-duration="1500" data-aos-offset="50">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        </div>
    </section>
        <!-- Tour Gallery start -->
        <div class="tour-gallery">
            <div class="container-fluid">
                <div class="row gap-10 justify-content-center rel">
                    <div class="col-lg-4 col-md-6">
                        <div class="gallery-item">
                            <img src="{{ asset('clients/assets/images/gallery-tours/' . $tourDetail->images[0].'') }}" alt="Destination">
                        </div>
                        <div class="gallery-item">
                            <img src="{{ asset('clients/assets/images/gallery-tours/' . $tourDetail->images[1].'') }}" alt="Destination">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 ">
                        <div class="gallery-item gallery-between">
                            <img src="{{ asset('clients/assets/images/gallery-tours/' . $tourDetail->images[2].'') }}" alt="Destination">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="gallery-item">
                            <img src="{{ asset('clients/assets/images/gallery-tours/' . $tourDetail->images[3].'') }}" alt="Destination">
                        </div>
                        <div class="gallery-item">
                            <img src="{{ asset('clients/assets/images/gallery-tours/' . $tourDetail->images[4].'') }}" alt="Destination">
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- Tour Gallery End -->
        
        
        <!-- Tour Header Area start -->
        <section class="tour-header-area pt-70 rel z-1">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-6 col-lg-7">
                        <div class="tour-header-content mb-15" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                            <span class="location d-inline-block mb-10"><i class="fal fa-map-marker-alt"></i>{{ $tourDetail->destination }}</span>
                            <div class="section-title pb-5">
                                <h2>{{ $tourDetail->title }}</h2>
                            </div>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 text-lg-end" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                        <div class="tour-header-social mb-10">
                            <a href="#"><i class="far fa-share-alt"></i>Share tours</a>
                            <a href="#"><i class="fas fa-heart bgc-secondary"></i>Wish list</a>
                        </div>
                    </div>
                </div>
                <hr class="mt-50 mb-70">
            </div>
        </section>
        <!-- Tour Header Area end -->
        
        
        <!-- Tour Details Area start -->
        <section class="tour-details-page pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="tour-details-content">
                            <h3>Khám phá Tours</h3>
                            <p>{!! $tourDetail->description !!}</p>
                            <div class="row pb-55">
                                <div class="col-md-6">
                                    <div class="tour-include-exclude mt-30">
                                        <h5>Bao gồm</h5>
                                        <ul class="list-style-one check mt-25">
                                            <li><i class="far fa-check"></i>Dịch vụ đón và trả khách</li>
                                            <li><i class="far fa-check"></i> 1 bữa ăn mỗi ngày</li>
                                            <li><i class="far fa-check"></i> Bữa tối và sự kiện âm nhạc</li>
                                            <li><i class="far fa-check"></i> Tham quan những địa điểm có trong tour</li>
                                            <li><i class="far fa-check"></i> Nước uống trên xe</li>
                                            <li><i class="far fa-check"></i> Phương tiện di chuyển và xe Bus</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tour-include-exclude mt-30">
                                        <h5>Không bao gồm</h5>
                                        <ul class="list-style-one mt-25">
                                            <li><i class="far fa-times"></i>Tiền boa</li>
                                            <li><i class="far fa-times"></i> Đón và trả khách tại khách sạn</li>
                                            <li><i class="far fa-times"></i>Bữa ăn khác</li>
                                            <li><i class="far fa-times"></i>Gọi thêm thức ăn</li>
                                            <li><i class="far fa-times"></i>Dịch vụ bổ sung</li>
                                            <li><i class="far fa-times"></i> Bảo hiểm</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <h3>Lịch trình</h3>
                        <div class="accordion-two mt-25 mb-60" id="faq-accordion-two">
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwoOne">
                                       Day 1 - Arrive at campground
                                    </button>
                                </h5>
                                <div id="collapseTwoOne" class="accordion-collapse collapse" data-bs-parent="#faq-accordion-two">
                                    <div class="accordion-body">
                                        <p>To take a trivial example which undertakes laborious physical exercise except to obtain some advantage pleasure annoying consequences</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseTwoTwo">
                                        Day 2 - Wake up early and embark on a day hike
                                    </button>
                                </h5>
                                <div id="collapseTwoTwo" class="accordion-collapse collapse show" data-bs-parent="#faq-accordion-two">
                                    <div class="accordion-body">
                                        <p>The early start ensures you can fully immerse yourself in the tranquility of nature before the world fully awakens. As the morning light filters through the trees, you'll experience the crisp, fresh air and the peaceful sounds of the forest. The trail ahead offers both a physical challenge promise of breathtaking.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwoThree">
                                        Day 3 - Join a guided ranger-led nature walk
                                    </button>
                                </h5>
                                <div id="collapseTwoThree" class="accordion-collapse collapse" data-bs-parent="#faq-accordion-two">
                                    <div class="accordion-body">
                                        <p>To take a trivial example which undertakes laborious physical exercise except to obtain some advantage pleasure annoying consequences</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwoFour">
                                        Day 4 - Take a break from hiking
                                    </button>
                                </h5>
                                <div id="collapseTwoFour" class="accordion-collapse collapse" data-bs-parent="#faq-accordion-two">
                                    <div class="accordion-body">
                                        <p>To take a trivial example which undertakes laborious physical exercise except to obtain some advantage pleasure annoying consequences</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwoFive">
                                        Day 5 - Pack a lunch and embark on a longer hike
                                    </button>
                                </h5>
                                <div id="collapseTwoFive" class="accordion-collapse collapse" data-bs-parent="#faq-accordion-two">
                                    <div class="accordion-body">
                                        <p>To take a trivial example which undertakes laborious physical exercise except to obtain some advantage pleasure annoying consequences</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                      
                        <h3>Maps</h3>
                        <div class="tour-map mt-30 mb-50">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d96777.16150026117!2d-74.00840582560909!3d40.71171357405996!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1706508986625!5m2!1sen!2sbd" style="border:0; width: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <h3>Clients Reviews</h3>
                        <div class="clients-reviews bgc-black mt-30 mb-60">
                            <div class="left">
                                <b>4.8</b>
                                <span>(586 reviews)</span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="right">
                                <div class="ratting-item">
                                    <span class="title">Services</span>
                                    <span class="line"><span style="width: 80%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <div class="ratting-item">
                                    <span class="title">Guides</span>
                                    <span class="line"><span style="width: 70%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <div class="ratting-item">
                                    <span class="title">Price</span>
                                    <span class="line"><span style="width: 80%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <div class="ratting-item">
                                    <span class="title">Safety</span>
                                    <span class="line"><span style="width: 80%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <div class="ratting-item">
                                    <span class="title">Foods</span>
                                    <span class="line"><span style="width: 80%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <div class="ratting-item">
                                    <span class="title">Hotels</span>
                                    <span class="line"><span style="width: 80%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <h3>Clients Comments</h3>
                        <div class="comments mt-30 mb-60">
                            <div class="comment-body" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <div class="author-thumb">
                                    <img src="assets/images/blog/comment-author1.jpg" alt="Author">
                                </div>
                                <div class="content">
                                    <h6>Lonnie B. Horwitz</h6>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="time">Venice, Rome and Milan – 9 Days 8 Nights</span>
                                    <p>Tours and travels play a crucial role in enriching lives by offering unique experiences, cultural exchanges, and the joy of exploration.</p>
                                    <a class="read-more" href="#">Reply <i class="far fa-angle-right"></i></a>
                                </div>
                            </div>
                            <div class="comment-body comment-child" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <div class="author-thumb">
                                    <img src="assets/images/blog/comment-author2.jpg" alt="Author">
                                </div>
                                <div class="content">
                                    <h6>William G. Edwards</h6>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="time">Venice, Rome and Milan – 9 Days 8 Nights</span>
                                    <p>Tours and travels play a crucial role in enriching lives by offering unique experiences, cultural exchanges, and the joy of exploration.</p>
                                    <a class="read-more" href="#">Reply <i class="far fa-angle-right"></i></a>
                                </div>
                            </div>
                            <div class="comment-body" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <div class="author-thumb">
                                    <img src="assets/images/blog/comment-author3.jpg" alt="Author">
                                </div>
                                <div class="content">
                                    <h6>Jaime B. Wilson</h6>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="time">Venice, Rome and Milan – 9 Days 8 Nights</span>
                                    <p>Tours and travels play a crucial role in enriching lives by offering unique experiences, cultural exchanges, and the joy of exploration.</p>
                                    <a class="read-more" href="#">Reply <i class="far fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <h3>Add Reviews</h3>
                        <form id="comment-form" class="comment-form bgc-lighter z-1 rel mt-30" name="review-form" action="#" method="post" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                           <div class="comment-review-wrap">
                               <div class="comment-ratting-item">
                                    <span class="title">Services</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                               <div class="comment-ratting-item">
                                    <span class="title">Guides</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                               <div class="comment-ratting-item">
                                    <span class="title">Price</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                               <div class="comment-ratting-item">
                                    <span class="title">Safety</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                               <div class="comment-ratting-item">
                                    <span class="title">Foods</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                               <div class="comment-ratting-item">
                                    <span class="title">Hotels</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-30 mb-40">
                            <h5>Leave Feedback</h5>
                            <div class="row gap-20 mt-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="full-name">Name</label>
                                        <input type="text" id="full-name" name="full-name" class="form-control" value="" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control" value="" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email-address">Email</label>
                                        <input type="email" id="email-address" name="email" class="form-control" value="" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message">Comments</label>
                                        <textarea name="message" id="message" class="form-control" rows="5" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <button type="submit" class="theme-btn bgc-secondary style-two">
                                            <span data-hover="Submit reviews">Submit reviews</span>
                                            <i class="fal fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-10 rmt-75">
                        <div class="blog-sidebar tour-sidebar">
                           
                            <div class="widget widget-booking" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <h5 class="widget-title">Tour Booking</h5>
                                <form action="#">
                                    <div class="date mb-25">
                                        <b>Ngày bắt đầu</b>
                                        <input type="date" value="{{$tourDetail->startDate }}">
                                    </div>
                                    <hr>
                                    <div class="date mb-25">
                                        <b>Ngày kết thúc</b>
                                        <input type="date" value="{{$tourDetail->endDate }}">
                                    </div>
                                    <hr>
                                    <div class="time py-5">
                                        <b>Thời gian :</b>
                                        <p>{{$tourDetail->time }}</p>
                                    </div>
                                    <hr class="mb-25">
                                    <h6>Vé:</h6>
                                    <ul class="tickets clearfix">
                                        <li>
                                            Trẻ em(5-11 tuổi)  <span class="price">{{ number_format($tourDetail->priceChild, 0, ',', '.') }} VND</span>
                                            <select name="18-" id="18-">
                                                <option value="value1">01</option>
                                                <option value="value1">02</option>
                                                <option value="value1" selected>03</option>
                                            </select>
                                        </li>
                                        <li>
                                            Người lớn <span class="price">{{ number_format($tourDetail->priceAdult, 0, ',', '.') }} VND</span>
                                            <select name="18+" id="18+">
                                                <option value="value1">01</option>
                                                <option value="value1">02</option>
                                                <option value="value1">03</option>
                                            </select>
                                        </li>
                                    </ul>
                                    <hr class="mb-25">                               
                                    
                                    <h6>Tổng tiền: <span class="price">$74</span></h6>
                                    <button type="submit" class="theme-btn style-two w-100 mt-15 mb-5">
                                        <span data-hover="Book Now">Book Now</span>
                                        <i class="fal fa-arrow-right"></i>
                                    </button>
                                    <div class="text-center">
                                        <a href="{{ route('contact') }}">Bạn cần trợ giúp ?</a>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="widget widget-contact" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <h5 class="widget-title">Cần trợ giúp ?</h5>
                                <ul class="list-style-one">
                                    <li><i class="far fa-envelope"></i> <a href="emilto:sangb2306638@ctu.edu.vn">sangb2306638@gmail.com</a></li>
                                    <li><i class="far fa-phone-volume"></i> <a href="callto:+000(123)45688">+000 (123) 456 78</a></li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Tour Details Area end -->
        
        
        <!-- Newsletter Area start -->
        <section class="newsletter-three bgc-primary py-100 rel z-1" style="background-image: url(assets/images/newsletter/newsletter-bg-lines.png);">
            <div class="container container-1500">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="newsletter-content-part text-white rmb-55" data-aos="zoom-in-right" data-aos-duration="1500" data-aos-offset="50">
                            <div class="section-title counter-text-wrap mb-45">
                                <h2>Subscribe Our Newsletter to Get more offer & Tips</h2>
                                <p>One site <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> most popular experience you’ll remember</p>
                            </div>
                            <form class="newsletter-form mb-15" action="#">
                                <input id="news-email" type="email" placeholder="Email Address" required>
                                <button type="submit" class="theme-btn bgc-secondary style-two">
                                    <span data-hover="Subscribe">Subscribe</span>
                                    <i class="fal fa-arrow-right"></i>
                                </button>
                            </form>
                            <p>No credit card requirement. No commitments</p>
                        </div>
                        <div class="newsletter-bg-image" data-aos="zoom-in-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                            <img src="assets/images/newsletter/newsletter-bg-image.png" alt="Newsletter">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="newsletter-image-part bgs-cover" style="background-image: url({{ asset('clients/assets/images/newsletter/newsletter-two-right.jpg') }});" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Newsletter Area end -->
            

@include('clients.blocks.footer')
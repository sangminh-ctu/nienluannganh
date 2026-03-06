@include('clients.blocks.header')
@include('clients.blocks.banner_search')
                
        <!-- Popular Destinations Area start -->
        <section class="popular-destinations-area pt-100 pb-90 rel z-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center counter-text-wrap mb-40" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <h2>Khám  phá các điểm đến phổ biến</h2>
                            <p>Website<span class="count-text plus" data-speed="3000" data-stop="34500">0</span>trải nghiệm đáng nhớ</p>
                            <ul class="destinations-nav mt-30">
                                <li data-filter="*" class="active">Tất cả</li>
                                <li data-filter=".features">Miền Bắc</li>
                                <li data-filter=".recent">Miền Trung</li>
                                <li data-filter=".city">Miền Nam</li>
                             
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row gap-10 destinations-active justify-content-center">
                       
                        <div class="col-xl-3 col-md-6 item features">
                            <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="{{ asset('clients/assets/images/destinations/destination2.jpg') }}" alt="Destination">
                                </div>
                                <div class="content">
                                    <h6><a href="destination-details.html">Parga, Greece</a></h6>
                                    <span class="time">5352+ tours & 856+ Activity</span>
                                    <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 item city features">
                            <div class="destination-item style-two" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="{{ asset('clients/assets/images/destinations/destination4.jpg') }}" alt="Destination">
                                </div>
                                <div class="content">
                                    <h6><a href="destination-details.html">Reserve of Canada, Canada</a></h6>
                                    <span class="time">5352+ tours & 856+ Activity</span>
                                    <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 item recent">
                            <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="{{ asset('clients/assets/images/destinations/destination5.jpg') }}" alt="Destination">
                                </div>
                                <div class="content">
                                    <h6><a href="destination-details.html">Dubai united states</a></h6>
                                    <span class="time">5352+ tours & 856+ Activity</span>
                                    <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- Popular Destinations Area end -->
        
        
        
        <!-- Hot Deals Area start -->
        <section class="hot-deals-area pt-70 pb-50 rel z-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center counter-text-wrap mb-50" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <h2>Khám phá các ưu đãi hấp dẫn</h2>
                            <p>Website <span class="count-text plus" data-speed="3000" data-stop="34500">0</span>trải nghiệm đáng nhớ</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                <span class="badge">10% Off</span>
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{ asset('clients/assets/images/destinations/hot-deal1.jpg') }}" alt="Hot Deal">
                            </div>
                            <div class="content">
                                <span class="location"><i class="fal fa-map-marker-alt"></i> City of Venice, Italy</span>
                                <h5><a href="tour-details.html">Venice Grand Canal, Metropolitan Summer in Venice</a></h5>
                            </div>
                            <div class="destination-footer">
                                <span class="price"><span>$58.00</span>/person</span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <a href="destination-details.html" class="theme-btn style-three">
                                <span data-hover="Explore">Explore</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hot Deals Area end -->
        
        
        <!-- Newsletter Area start -->
        <section class="newsletter-three bgc-primary py-100 rel z-1" style="background-image: url({{ asset('clients/assets/images/newsletter/newsletter-bg-lines.png') }});">
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
                            <img src="{{ asset('clients/assets/images/newsletter/newsletter-bg-image.png') }}" alt="Newsletter">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="newsletter-image-part bgs-cover" style="background-image: url({{ asset('clients/assets/images/newsletter/newsletter-two-right.jpg') }});" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Newsletter Area end -->


@include('clients.blocks.new_latter')
@include('clients.blocks.footer')        
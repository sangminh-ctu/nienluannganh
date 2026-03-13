@include('clients.blocks.header')
{{-- @include('clients.blocks.banner') --}}


<!-- Tour Grid Area start -->
<section class="tour-grid-page py-100 rel z-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-10 rmb-75">
                <div class="shop-sidebar">
                    <div class="widget widget-filter" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h6 class="widget-title">Lọc theo giá</h6>
                        <div class="price-filter-wrap">
                            <div class="price-slider-range"></div>
                            <div class="price">
                                <span>Giá</span>
                                <input type="text" id="price" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="widget widget-activity" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h6 class="widget-title">Điểm đến</h6>
                        <ul class="radio-filter">
                            <li>
                                <input class="form-check-input" type="radio"  name="mien_bac" id="id_mien_bac"
                                    value="b">
                                <label for="id_mien_bac">Miền Bắc <span>{{ $domainsCount['mien_bac'] }}</span></label>

                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="mien_trung"
                                    id="id_mien_trung" value="t">
                                <label for="id_mien_trung">Miền Trung <span>{{ $domainsCount['mien_trung'] }}</span></label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio"  name="mien_nam" id="id_mien_nam"
                                    value="n">
                                <label for="id_mien_nam">Miền Nam<span>{{ $domainsCount['mien_nam'] }}</span></label>
                            </li>
                        </ul>
                    </div>

                    <div class="widget widget-reviews" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <h6 class="widget-title">Đánh giá</h6>
                        <ul class="radio-filter">
                            <li>
                                <input class="form-check-input" type="radio" name="5star" id="5star" value="5">
                                <label for="5star">
                                    <span class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="4star" id="4star" value="4">
                                <label for="4star">
                                    <span class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt white"></i>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="3star" id="3star" value="3">
                                <label for="3star">
                                    <span class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star white"></i>
                                        <i class="fas fa-star-half-alt white"></i>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="2star" id="2star" value="2">
                                <label for="2star">
                                    <span class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star white"></i>
                                        <i class="fas fa-star white"></i>
                                        <i class="fas fa-star-half-alt white"></i>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="1star" id="1star" value="1">
                                <label for="1star">
                                    <span class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star white"></i>
                                        <i class="fas fa-star white"></i>
                                        <i class="fas fa-star white"></i>
                                        <i class="fas fa-star-half-alt white"></i>
                                    </span>
                                </label>
                            </li>
                        </ul>
                    </div>


                    <div class="widget widget-duration" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h6 class="widget-title">Thời gian</h6>
                        <ul class="radio-filter">
                            <li>
                                <input class="form-check-input" type="radio"  name="3ngay2dem"
                                    id="3ngay2dem" value="3n2d">
                                <label for="3ngay2dem">3 ngày 2 đêm</label>
                            </li>
                             <li>
                                <input class="form-check-input" type="radio"  name="4ngay3dem"
                                    id="4ngay3dem" value="4n3d">
                                <label for="4ngay3dem">4ngay3dem</label>
                            </li>
                             <li>
                                <input class="form-check-input" type="radio"  name="5ngay4dem"
                                    id="5ngay4dem" value="5n4d">
                                <label for="5ngay4dem">5ngay4dem</label>
                            </li>
                              <li>
                                <input class="form-check-input" type="radio"  name="Khac"
                                    id="khac" value="khac">
                                <label for="5ngay4dem">Khác(>5 ngày)</label>
                            </li>

                        </ul>
                    </div>

                    <div class="widget widget-tour" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h6 class="widget-title">Tour Phổ Biến</h6>
                        <div class="destination-item tour-grid style-three bgc-lighter">
                            <div class="image">
                                <span class="badge">10% Off</span>
                                <img src="{{ asset('clients/assets/images/widgets/tour1.jpg') }}" alt="Tour">
                            </div>
                            <div class="content">
                                <div class="destination-header">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Bali,
                                        Indonesia</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <span>(4.8)</span>
                                    </div>
                                </div>
                                <h6><a href="tour-details.html">Relinking Beach, Bali, Indonesia</a></h6>
                            </div>
                        </div>
                        <div class="destination-item tour-grid style-three bgc-lighter">
                            <div class="image">
                                <img src="{{ asset('clients/assets/images/widgets/tour1.jpg') }}" alt="Tour">
                            </div>
                            <div class="content">
                                <div class="destination-header">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Bali,
                                        Indonesia</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <span>(4.8)</span>
                                    </div>
                                </div>
                                <h6><a href="tour-details.html">Relinking Beach, Bali, Indonesia</a></h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget widget-cta mt-30" data-aos="fade-up" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="content text-white">
                        <span class="h6">Explore The World</span>
                        <h3>Best Tourist Place</h3>
                        <a href="tour-list.html" class="theme-btn style-two bgc-secondary">
                            <span data-hover="Explore Now">Explore Now</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="image">
                        <img src="{{ asset('clients/assets/images/widgets/cta-widget.png') }}" alt="CTA">
                    </div>
                    <div class="cta-shape"><img src="{{ asset('clients/assets/images/widgets/cta-shape2.png') }}"
                            alt="Shape"></div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop-shorter rel z-3 mb-20">
                    <ul class="grid-list mb-15 me-2">
                        <li><a href="#"><i class="fal fa-border-all"></i></a></li>
                        <li><a href="#"><i class="far fa-list"></i></a></li>
                    </ul>
                    <div class="sort-text mb-15 me-4 me-xl-auto">
                        34 Tours được tìm thấy
                    </div>
                    <div class="sort-text mb-15 me-4">
                        Sắp xếp:
                    </div>
                    <select>
                        <option value="default" selected="">Sắp xếp theo</option>
                        <option value="new">Mới nhất</option>
                        <option value="old">Cũ nhất</option>
                        <option value="hight-to-low">Cao đến Thấp</option>
                        <option value="low-to-high">Thấp đến Cao</option>
                    </select>
                </div>

                <div class="tour-grid-wrap">
                    <div class="row gy-4">
                        @foreach ($tours as $tour)
                            <div class="col-xl-4 col-md-6">
                                <div class="destination-item tour-grid style-three bgc-lighter travela-tour-card"
                                    data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                    <div class="image">
                                        <span class="badge bgc-pink">Nổi bật</span>
                                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                        <img src="{{ asset('clients/assets/images/gallery-tours/' . $tour->images[0] . '') }}"
                                            alt="Tour List">
                                    </div>
                                    <div class="content">
                                        <div class="destination-header">
                                            <span class="location"><i class="fal fa-map-marker-alt"></i>
                                                {{ $tour->destination }}</span>
                                            <div class="ratting">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                        <h6><a
                                                href="{{ route('tour-detail', ['id' => $tour->tourId]) }}">{{ $tour->title }}</a>
                                        </h6>
                                        <ul class="blog-meta">
                                            <li><i class="far fa-clock"></i>{{ $tour->time }}</li>
                                            <li><i class="far fa-user"></i> {{ $tour->quantity }} chỗ</li>
                                        </ul>
                                        <div class="destination-footer">
                                            <span
                                                class="price"><span>{{ number_format($tour->priceAdult, 0, ',', '.') }}</span>VND
                                                / người</span>
                                            <a href="{{ route('tour-detail', ['id' => $tour->tourId]) }}"
                                                class="theme-btn style-two style-three">
                                                <i class="fal fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-lg-12">
                            <ul class="pagination justify-content-center pt-15 flex-wrap" data-aos="fade-up"
                                data-aos-duration="1500" data-aos-offset="50">
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="far fa-chevron-left"></i></span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">
                                        1
                                        <span class="sr-only">(current)</span>
                                    </span>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="far fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Tour Grid Area end -->












@include('clients.blocks.new_latter')
@include('clients.blocks.footer')

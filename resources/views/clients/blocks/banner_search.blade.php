        <!-- Page Banner Start -->
        <section class="page-banner-area pt-50 pb-35 rel z-1 bgs-cover" style="background-image: url({{ asset('clients/assets/images/banner/banner.jpg') }});">
            <div class="container">
                <div class="banner-inner text-white mb-50">
                    <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">Destination 02</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1500" data-aos-offset="50">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Destination</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <div class="container container-1400">
            <div class="search-filter-inner" data-aos="zoom-out-down" data-aos-duration="1500" data-aos-offset="50">
                <div class="filter-item clearfix">
                    <div class="icon"><i class="fal fa-map-marker-alt"></i></div>
                    <span class="title">Destinations</span>
                    <select name="city" id="city">
                        <option value="value1">City or Region</option>
                        <option value="value2">City</option>
                        <option value="value2">Region</option>
                    </select>
                </div>
                <div class="filter-item clearfix">
                    <div class="icon"><i class="fal fa-flag"></i></div>
                    <span class="title">All Activity</span>
                    <select name="activity" id="activity">
                        <option value="value1">Choose Activity</option>
                        <option value="value2">Daily</option>
                        <option value="value2">Monthly</option>
                    </select>
                </div>
                <div class="filter-item clearfix">
                    <div class="icon"><i class="fal fa-calendar-alt"></i></div>
                    <span class="title">Departure Date</span>
                    <select name="date" id="date">
                        <option value="value1">Date from</option>
                        <option value="value2">10</option>
                        <option value="value2">20</option>
                    </select>
                </div>
                <div class="filter-item clearfix">
                    <div class="icon"><i class="fal fa-users"></i></div>
                    <span class="title">Guests</span>
                    <select name="cuests" id="cuests">
                        <option value="value1">0</option>
                        <option value="value2">1</option>
                        <option value="value2">2</option>
                    </select>
                </div>
                <div class="search-button">
                    <button class="theme-btn">
                        <span data-hover="Search">Search</span>
                        <i class="far fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Page Banner End -->
        
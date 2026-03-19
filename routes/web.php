<?php

use Illuminate\Support\Facades\Route;

// Route admin 
use App\Http\Controllers\admin\AdminManagementController;
use App\Http\Controllers\admin\BookingManagementController;
use App\Http\Controllers\admin\ContactManagementController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginAdminController;
use App\Http\Controllers\admin\ToursManagementController;
use App\Http\Controllers\admin\UserManagementController;

// Route clients
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\clients\AboutController;
use App\Http\Controllers\clients\ToursController;
use App\Http\Controllers\clients\TravelGuidesController;
use App\Http\Controllers\clients\DestinationController;
use App\Http\Controllers\clients\ContactController;
use App\Http\Controllers\clients\Contact1Controller;
use App\Http\Controllers\clients\TourDetailController;
use App\Http\Controllers\clients\BlogController;
use App\Http\Controllers\clients\BlogDetailController;
use App\Http\Controllers\clients\BookingController ;
use App\Http\Controllers\clients\LoginController;
use App\Http\Controllers\clients\LoginGoogleController;
use App\Http\Controllers\clients\SearchController;
use App\Http\Controllers\clients\UserprofileController;
use App\Http\Controllers\clients\TourBookedController;
use App\Http\Middleware\CheckLoginClient;
use App\Http\Controllers\clients\MyTourController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/tours', [ToursController::class, 'index'])->name('tours');
Route::get('/travel-guides', [TravelGuidesController::class, 'index'])->name('travel-guides');
Route::get('/destination', [DestinationController::class, 'index'])->name('destination');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/contact1', [Contact1Controller::class, 'index'])->name('contact1');
Route::get('/tour-detail/{id?}', [TourDetailController::class, 'index'])->name('tour-detail');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog-detail', [BlogDetailController::class, 'index'])->name('blog-detail');
Route::get('/search', [SearchController::class, 'index'])->name('search');

//Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('user-login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/activate/{token}', [LoginController::class, 'activateAccount'])->name('activate.account');

// Đăng nhập với gg
Route::get('/auth/google', [LoginGoogleController::class, 'redirectToGoogle'])->name('login-google');
Route::get('/auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback']);

// Lọc tour
Route::get('/tours', [ToursController::class, 'index'])->name('tours');
Route::get('/filter-tours',[ToursController::class,'filterTours'])->name('filter-tours');

//user-profile
Route::get('/user-profile', [UserprofileController::class, 'index'])->name('user-profile');
Route::post('/user-profile', [UserprofileController::class, 'update'])->name('update-user-profile');
Route::post('/change-password-profile', [UserprofileController::class, 'changePassword'])->name('change-password');
Route::post('/change-avatar-profile', [UserprofileController::class, 'changeAvatar'])->name('change-avatar');

//  CHECK OUT
Route::post('/booking/{id?}', [BookingController::class, 'index'])->name('booking');
Route::post('/submit-booking', [BookingController::class, 'createBooking'])->name('create-booking');



//Tour booked
Route::get('/tour-booked', [TourBookedController::class, 'index'])->name('tour-booked')->middleware('checkLoginClient');
Route::post('/cancel-booking', [TourBookedController::class, 'cancelBooking'])->name('cancel-booking');

//get Tour detail and handle submit reviews
Route::get('/tour-detail/{id?}', [TourDetailController::class, 'index'])->name('tour-detail');
Route::post('/checkBooking', [BookingController::class, 'checkBooking'])->name('checkBooking')->middleware('checkLoginClient');
Route::post('/reviews', [TourDetailController::class, 'reviews'])->name('reviews')->middleware('checkLoginClient');

Route::middleware([CheckLoginClient::class])->group(function () {

    // --- Phần Đặt Tour ---
    Route::post('/submit-booking', [BookingController::class, 'createBooking'])->name('create-booking');

    // --- Phần Lịch Sử Tour  ---
    Route::get('/my-tours', [MyTourController::class, 'index'])->name('my-tours');
    
    // --- Phần Chi tiết & Hủy Tour ---
    Route::get('/tour-booked/{bookingId}/{checkoutId}', [TourBookedController::class, 'index'])->name('tour-booked');
    Route::post('/cancel-booking', [TourBookedController::class, 'cancelBooking'])->name('cancel-booking');

    // --- Phần Thông tin cá nhân ---
    Route::get('/user-profile', [UserprofileController::class, 'index'])->name('user-profile');
});




//ADMIN


Route::prefix('admin')->group(function () {

    // Routes không cần đăng nhập admin
    Route::get('/login', [LoginAdminController::class, 'index'])->name('admin.login');
    Route::post('/login-account', [LoginAdminController::class, 'loginAdmin'])->name('admin.login-account');
    Route::get('/logout', [LoginAdminController::class, 'logout'])->name('admin.logout');

    // Routes bắt buộc đăng nhập admin
    Route::middleware(['admin'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Profile admin
        Route::get('/profile', [AdminManagementController::class, 'index'])->name('admin.admin');
        Route::post('/update-admin', [AdminManagementController::class, 'updateAdmin'])->name('admin.update-admin');
        Route::post('/update-avatar', [AdminManagementController::class, 'updateAvatar'])->name('admin.update-avatar');

        // Quản lý người dùng
        Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users');
        Route::post('/active-user', [UserManagementController::class, 'activeUser'])->name('admin.active-user');
        Route::post('/status-user', [UserManagementController::class, 'changeStatus'])->name('admin.status-user');

        // Quản lý Tours
        Route::get('/tours', [ToursManagementController::class, 'index'])->name('admin.tours');
        Route::get('/page-add-tours', [ToursManagementController::class, 'pageAddTours'])->name('admin.page-add-tours');
        Route::post('/add-tours', [ToursManagementController::class, 'addTours'])->name('admin.add-tours');
        Route::post('/add-images-tours', [ToursManagementController::class, 'addImagesTours'])->name('admin.add-images-tours');
        Route::post('/add-timeline', [ToursManagementController::class, 'addTimeline'])->name('admin.add-timeline');
        Route::post('/delete-tour', [ToursManagementController::class, 'deleteTour'])->name('admin.delete-tour');
        Route::get('/tour-edit', [ToursManagementController::class, 'getTourEdit'])->name('admin.tour-edit');
        Route::post('/edit-tour', [ToursManagementController::class, 'updateTour'])->name('admin.edit-tour');
        Route::post('/add-temp-images', [ToursManagementController::class, 'uploadTempImagesTours'])->name('admin.add-temp-images');

        // Quản lý Booking
        Route::get('/booking', [BookingManagementController::class, 'index'])->name('admin.booking');
        Route::get('/booking-detail/{id?}', [BookingManagementController::class, 'showDetail'])->name('admin.booking-detail');
        Route::post('/confirm-booking', [BookingManagementController::class, 'confirmBooking'])->name('admin.confirm-booking');
        Route::post('/finish-booking', [BookingManagementController::class, 'finishBooking'])->name('admin.finish-booking');
        Route::post('/received-money', [BookingManagementController::class, 'receiviedMoney'])->name('admin.received');
        Route::post('/send-pdf', [BookingManagementController::class, 'sendPdf'])->name('admin.send.pdf');

        // Quản lý Liên hệ
        Route::get('/contact', [ContactManagementController::class, 'index'])->name('admin.contact');
        Route::post('/reply-contact', [ContactManagementController::class, 'replyContact'])->name('admin.reply-contact');
    });
});
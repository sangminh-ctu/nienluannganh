$(document).ready(function () {
    // Thiết lập ngôn ngữ tiếng Việt
    $.datetimepicker.setLocale("vi");

    $("#start_date").datetimepicker({
        timepicker: false, // Tắt chọn giờ
        format: "d/m/Y", // Định dạng hiển thị
        minDate: 0, // KHÔNG cho chọn ngày trước ngày hiện tại
        scrollInput: false, // Chặn việc cuộn chuột làm nhảy ngày
        onShow: function (ct) {
            //  khi bảng lịch hiện ra, các ngày cũ sẽ bị làm mờ (disable)
            this.setOptions({
                minDate: 0,
            });
        },
    });

    // Tương tự cho ngày kết thúc
    $("#end_date").datetimepicker({
        timepicker: false,
        format: "d/m/Y",
        minDate: 0,
        scrollInput: false,
    });

    // dropdown menu login
    $("#userDropdown").on("click", function () {
        $("#dropdownMenu").toggle();
    });


    
/****************************************
 *              LOGIN FORM             *
 * ***************************************/
// Kiểm tra đăng nhập
$("#login-form").on("submit", function (e) {
    e.preventDefault();

    // Lấy giá trị và xóa khoảng trắng thừa
    var userName = $("#username_login").val().trim();
    var password = $("#password_login").val().trim();
    var $btn = $("#signin"); // Nút đăng nhập

    // Reset thông báo lỗi
    $(".validate-msg").hide().text(""); // Giả sử bạn đặt class chung cho các dòng lỗi

    var isValid = true;

    // 1. Kiểm tra rỗng
    if (userName === "") {
        isValid = false;
        $("#validate_username").show().text("Vui lòng nhập tên đăng nhập.");
    }

    // 2. Kiểm tra định dạng (Chỉ cho phép chữ và số)
    var alphaNumPattern = /^[a-zA-Z0-9]+$/;
    if (userName !== "" && !alphaNumPattern.test(userName)) {
        isValid = false;
        $("#validate_username")
            .show()
            .text("Tên đăng nhập không được chứa ký tự đặc biệt.");
    }

    // 3. Kiểm tra mật khẩu
    if (password.length < 6) {
        isValid = false;
        $("#validate_password")
            .show()
            .text("Mật khẩu phải có ít nhất 6 ký tự.");
    }

    if (isValid) {
        // Vô hiệu hóa nút để tránh nhấn nhiều lần
        $btn.val("Đang xử lý...").prop("disabled", true);

        var formData = {
            username: userName,
            password: password,
            _token: $('input[name="_token"]').val(),
        };
        console.log(formData);
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            success: function (response) {
                if (response.success) {
                    toastr.success("Đăng nhập thành công!");
                    setTimeout(function () {
                        window.location.href = "/";
                    }, 1000);
                } else {
                    toastr.error(response.message);
                    $btn.val("Đăng nhập").prop("disabled", false);
                }
            },
            error: function (xhr) {
                // Xử lý lỗi validate từ Laravel (nếu có)
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    toastr.error("Dữ liệu không hợp lệ.");
                } else {
                    toastr.error("Lỗi hệ thống. Vui lòng thử lại sau.");
                }
                $btn.val("Đăng nhập").prop("disabled", false);
            },
        });
    }
});

// Kiểm tra đăng ký
$("#register-form").on("submit", function (e) {
    e.preventDefault();

    // 1. Khai báo biến cần thiết
    var $form = $(this);
    var $btn = $("#signup");
    var userName = $("#username_register").val().trim();
    var email = $("#email_register").val().trim();
    var password = $("#password_register").val().trim();
    var rePass = $("#re_pass").val().trim();

    // Reset thông báo lỗi
    $(".invalid-feedback").hide().text("");

    var isValid = true;

    // 2. Validate phía Client
    // Kiểm tra tên đăng nhập (Chỉ chữ và số để sạch database)
    var alphaNumPattern = /^[a-zA-Z0-9]+$/;
    if (userName === "" || !alphaNumPattern.test(userName)) {
        isValid = false;
        $("#validate_username_regis")
            .show()
            .text("Tên tài khoản chỉ được chứa chữ cái và số.");
    }

    // Kiểm tra Email
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        isValid = false;
        $("#validate_email_regis").show().text("Email không hợp lệ.");
    }

    // Kiểm tra mật khẩu (Bỏ sqlInjectionPattern ở đây để cho phép ký tự đặc biệt)
    if (password.length < 6) {
        isValid = false;
        $("#validate_password_regis")
            .show()
            .text("Mật khẩu phải có ít nhất 6 ký tự.");
    }

    // Kiểm tra khớp mật khẩu
    if (password !== rePass) {
        isValid = false;
        $("#validate_repass").show().text("Mật khẩu nhập lại không khớp.");
    }

    // 3. Xử lý gửi dữ liệu
    if (isValid) {
        // Hiện loader và ẩn nội dung CHỈ KHI dữ liệu đã chuẩn
        $(".loader").show();
        $form.addClass("hidden-content");

        var formData = {
            username_regis: userName, // Bỏ chữ 'ter' đi cho khớp với Controller của bạn
            email: email,
            password_regis: password, // Bỏ chữ 'ter' đi cho khớp
            _token: $('input[name="_token"]').val(),
        };

        $.ajax({
            type: "POST",
            url: $form.attr("action"),
            data: formData,
            success: function (response) {
                if (response.success) {
                    // Chỉ hiện 1 thông báo thành công duy nhất
                    // Nếu có response.message từ server thì hiện, không thì hiện câu mặc định
                    toastr.success(response.message || "Thao tác thành công!");

                    $form.trigger("reset");

                    // Nếu là form đăng nhập, sau 1s thì chuyển trang
                    if ($form.attr("id") === "login-form") {
                        setTimeout(function () {
                            window.location.href = "/";
                        }, 1200);
                    }
                } else {
                    //Thêm nội dung mặc định nếu response.message bị rỗng
                    toastr.error(
                        response.message ||
                            "Đã xảy ra lỗi, vui lòng kiểm tra lại!",
                    );
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Lấy lỗi đầu tiên từ Laravel trả về
                    var errors = xhr.responseJSON.errors;
                    var firstError = Object.values(errors)[0][0];
                    toastr.error(firstError);
                } else if (xhr.status === 419) {
                    // Lỗi hết hạn token hoặc thiếu @csrf
                    toastr.error(
                        "Phiên làm việc hết hạn, vui lòng tải lại trang.",
                    );
                } else {
                    toastr.error(
                        "Lỗi hệ thống (mã " +
                            xhr.status +
                            "). Vui lòng thử lại sau.",
                    );
                }
            },
            complete: function () {
                // Luôn chạy dù thành công hay thất bại để người dùng có thể thao tác tiếp
                $(".loader").hide();
                $form.removeClass("hidden-content");

                // Nếu có nút submit bị disable thì mở lại ở đây
                $form
                    .find("input[type='submit'], button[type='submit']")
                    .prop("disabled", false);
            },
        });
    } else {
        // Nếu không valid, đảm bảo Form không bị ẩn
        $(".loader").hide();
        $form.removeClass("hidden-content");
    }
});

/****************************************
 *              PAGE TOURS              *
 * ***************************************/

//kiểm tra thanh trượt
if ($(".price-slider-range").length) {
    $(".price-slider-range").on("slide", function (event, ui) {
        filterTours(ui.values[0], ui.values[1]);
    });
}
$('input[name="domain"]').on("change", filterTours);
$('input[name="filter_star"]').on("change", filterTours);
$('input[name="duration"]').on("change", filterTours);

$("#sorting_tours").on("change", function () {
    filterTours(null, null, $(this).val());
});

function filterTours(minPrice = null, maxPrice = null) {
    $(".loader").show();
    $("#tours-container").addClass("hidden-content");

    if (minPrice === null || maxPrice === null) {
        minPrice = $(".price-slider-range").slider("values", 0);
        maxPrice = $(".price-slider-range").slider("values", 1);
    }

    var domain = $('input[name="domain"]:checked').val();
    var star = $('input[name="filter_star"]:checked').val();
    var duration = $('input[name="duration"]:checked').val();
    var sorting = $("#sorting_tours").val();

    formDataFilter = {
        minPrice: minPrice,
        maxPrice: maxPrice,
        domain: domain,
        star: star,
        time: duration,
        sorting: sorting,
    };
    console.log(formDataFilter);

    $.ajax({
        url: filterToursUrl,
        method: "GET",
        data: formDataFilter,
        success: function (res) {
            $("#tours-container").html(res).removeClass("hidden-content");
            $("#tours-container .destination-item").addClass("aos-animate");
            $(".loader").hide();
        },
    });
}

// clear tour
$(".clear_filter ").on("click", function (e) {
    e.preventDefault();
    // $(".loader").show();
    // $("#tours-container").addClass("hidden-content");
    // Reset slider giá về giá trị mặc định ( 0 đến 20000000)
    $(".price-slider-range").slider("values", [0, 20000000]);

    // Bỏ chọn radio và checkbox
    $('input[name="domain"]').prop("checked", false);
    $('input[name="filter_star"]').prop("checked", false);
    $('input[name="duration"]').prop("checked", false);
    $("#sorting_tours").val("default");
    filterTours(0, 20000000);
    if (typeof toastr !== "undefined") {
        toastr.info("Đã xóa tất cả bộ lọc");
    }

    // var url = $(this).attr("href");

    // $.ajax({
    //     url: url,
    //     type: "GET",
    //     dataType: "json",
    //     success: function (response) {
    //         // Cập nhật toàn bộ nội dung (tours và phân trang)
    //         $("#tours-container")
    //             .html(response.tours)
    //             .removeClass("hidden-content");
    //         $("#tours-container .destination-item").addClass("aos-animate");
    //         $("#tours-container .pagination-tours").addClass("aos-animate");
    //         $(".loader").hide();
    //     },
    //     error: function (xhr, status, error) {
    //         console.log("Có lỗi xảy ra trong quá trình tải dữ liệu!");
    //     },
    // });
});

/****************************************
 *             PAGE USER-PROFILE        *
 * ***************************************/

$(".updateUser").on("submit", function (e) {
    e.preventDefault();
    var fullName = $("#inputFullName").val();
    var address = $("#inputLocation").val();
    var email = $("#inputEmailAddress").val();
    var phone = $("#inputPhone").val();

    var dataUpdate = {
        fullName: fullName,
        address: address,
        email: email,
        phone: phone,
        _token: $('input[name="_token"]').val(),
    };

    console.log(dataUpdate);

    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: dataUpdate,
        success: function (response) {
            console.log(response);

            if (response.success) {
                toastr.success(response.message || "Cập nhật thành công!");
            } else {
                toastr.error(response.message || "Có lỗi xảy ra!");
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            toastr.error("Có lỗi xảy ra. Vui lòng thử lại sau.");
        },
    });
});

//Hiện thanh đổi password
$("#update_password_profile").click(function () {
    $("#card_change_password").toggle();
});

// update password
$(".change_password_profile").on("submit", function (e) {
    e.preventDefault();
    var oldPass = $("#inputOldPass").val();
    var newPass = $("#inputNewPass").val();
    var isValid = true;
    // kiểm tra độ dài mk
    if (newPass.length < 6) {
        isValid = false;
        $("#validate_password_regis")
            .show()
            .text("Mật khẩu phải có ít nhất 6 ký tự.");
    }

    if (isValid) {
        var updatePass = {
            oldPass: oldPass,
            newPass: newPass,
            _token: $('input[name="_token"]').val(),
        };

        console.log(updatePass);
    }

    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: updatePass,
        success: function (response) {
            if (response.success) {
                $("#validate_password").hide().text("");
                toastr.success(response.message);
            } else {
                toastr.error(response.message);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            $("#validate_password").show().text(xhr.responseJSON.message);
            toastr.error(xhr.responseJSON.message);
        },
    });
});

//update avatar
$("#avatar").on("change", function (e) {
    // Thêm e vào đây
    const file = e.target.files[0];

    if (file) {
        // 1. Hiển thị ảnh xem trước ngay lập tức
        const reader = new FileReader();
        reader.onload = function (event) {
            $(".img-account-profile").attr("src", event.target.result);
        };
        reader.readAsDataURL(file);

        // 2. Lấy Token và URL an toàn hơn
        // Sang kiểm tra lại class của input token trong file Blade nhé
        var __token = $('input[name="_token"]').val();
        var url_avatar = $(".label_avatar").val(); // Hoặc lấy trực tiếp từ hidden input

        // 3. Tạo FormData
        const formData = new FormData();
        formData.append("avatar", file);

        $.ajax({
            url: url_avatar,
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": __token, // Laravel cần cái này để xác thực
            },
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    toastr.success(
                        response.message || "Cập nhật ảnh đại diện thành công!",
                    );
                    // Nếu có dùng avatar ở các chỗ khác trên trang (như Header), cập nhật luôn:
                    $(".header-avatar").attr(
                        "src",
                        $(".img-account-profile").attr("src"),
                    );
                } else {
                    toastr.error(response.message || "Không thể lưu ảnh.");
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    toastr.error(Object.values(errors)[0][0]);
                } else if (xhr.status === 419) {
                    toastr.error("Phiên làm việc hết hạn, bấm F5 nhé Sang!");
                } else {
                    toastr.error("Lỗi hệ thống khi upload ảnh.");
                }
            },
        });
    }
});

/****************************************
 *             PAGE BOOKING             *
 * ***************************************/
let discount = 0; // Giảm giá, có thể cập nhật khi áp dụng mã giảm giá
let totalPrice = 0; // Khai báo biến totalPrice để lưu tổng giá trị

function updateSummary() {
    // Lấy số lượng người lớn và trẻ em
    const numAdults = parseInt($("#numAdults").val());
    const numChildren = parseInt($("#numChildren").val());

    // Lấy giá từ thuộc tính data-price
    const adultPrice = parseInt($("#numAdults").data("price-adults"));
    const childPrice = parseInt($("#numChildren").data("price-children"));

    // Tính toán tổng giá cho người lớn và trẻ em
    const adultsTotal = numAdults * adultPrice;
    const childrenTotal = numChildren * childPrice;

    // Cập nhật hiển thị số lượng và giá tiền cho từng loại
    $(".quantity_adults").text(numAdults);
    $(".quantity_children").text(numChildren);
    $(".summary-item:nth-child(1) .total-price").text(
        adultPrice.toLocaleString() + " VNĐ",
    );
    $(".summary-item:nth-child(2) .total-price").text(
        childPrice.toLocaleString() + " VNĐ",
    );

    // Tính tổng giá trị
    totalPrice = adultsTotal + childrenTotal - discount;
    $(".summary-item.total-price span:last").text(
        totalPrice.toLocaleString() + " VNĐ",
    );

    $(".totalPrice").val(totalPrice);
}

// Sự kiện tăng/giảm số lượng người lớn và trẻ em
$(".quantity-selector").on("click", ".quantity-btn", function () {
    const input = $(this).siblings("input");
    const min = parseInt(input.attr("min"));
    let value = parseInt(input.val());
   const quantityAvailable = parseInt(
    $(".quantityAvailable").text().match(/\d+/)?.[0] || 0
); // Lấy số chỗ còn nhận từ nội dung của .quantityAvailable

    // Lấy tổng số lượng người lớn và trẻ em
    const totalAdults = parseInt($("#numAdults").val());
    const totalChildren = parseInt($("#numChildren").val());

    // Kiểm tra nút tăng hay giảm
    if ($(this).text() === "+") {
        // Kiểm tra nếu đang tăng số lượng người lớn
        if (input.attr("id") === "numAdults") {
            // Kiểm tra nếu tổng số người lớn và trẻ em không vượt quá số chỗ còn nhận
            if (totalAdults + totalChildren < quantityAvailable) {
                value++;
            } else {
                toastr.error(
                    "Không thể thêm số người lớn vượt quá số chỗ còn nhận!",
                ); // Thông báo nếu vượt quá
            }
        }
        // Kiểm tra nếu đang tăng số lượng trẻ em
        else if (input.attr("id") === "numChildren") {
            // Kiểm tra nếu tổng số người lớn và trẻ em không vượt quá số chỗ còn nhận
            if (totalAdults + totalChildren < quantityAvailable) {
                value++;
            } else {
                toastr.error(
                    "Không thể thêm số trẻ em vượt quá số chỗ còn nhận!",
                ); // Thông báo nếu vượt quá
            }
        }
    } else if (value > min) {
        value--;
    }

    // Cập nhật số lượng vào input
    input.val(value);

    // Cập nhật lại tổng giá
    updateSummary();
});

// Áp dụng mã giảm giá
$(".btn-coupon").on("click", function (e) {
    e.preventDefault();
    const couponCode = $(".order-coupon input").val();

    // Giả sử mã giảm giá là "DISCOUNT10" giảm 10%
    if (couponCode === "DISCOUNT10") {
        discount =
            0.1 *
            (parseInt($("#numAdults").val()) *
                $("#numAdults").data("price-adults") +
                parseInt($("#numChildren").val()) *
                    $("#numChildren").data("price-children"));
        toastr.success("Áp dụng mã giảm giá thành công!");
    } else {
        discount = 0;
        toastr.error("Mã giảm giá không hợp lệ!");
    }

    $(".summary-item:nth-child(3) .total-price").text(
        discount.toLocaleString() + " VNĐ",
    );
    updateSummary();
});

// Sự kiện khi thay đổi trạng thái checkbox
$("#agree").on("change", function () {
    toggleButtonState();
});

// Hàm thay đổi trạng thái của nút
function toggleButtonState() {
    if ($("#agree").is(":checked")) {
        $(".btn-submit-booking")
            .removeClass("inactive")
            .css("pointer-events", "auto");
    } else {
        $(".btn-submit-booking")
            .addClass("inactive")
            .css("pointer-events", "none");
    }
}

// Kiểm tra tính hợp lệ khi nhấn nút submit
$(".booking-container").on("submit", function (e) {
        e.preventDefault(); // CHẶN load lại trang để thấy console.log
        
        console.log("Nút đã nhận - Bắt đầu kiểm tra...");

        let isValid = true;
        // Xóa thông báo lỗi cũ (Sang nhớ thêm các thẻ span báo lỗi vào Blade nhé)
        $(".error-message").hide();

        // Lấy dữ liệu từ input
        const username = $("#username").val().trim();
        const email = $("#email").val().trim();
        const tel = $("#tel").val().trim();
        const address = $("#address").val().trim();
        const numAdults = parseInt($("#numAdults").val());
        const numChildren = parseInt($("#numChildren").val());

        // 1. Validate đơn giản
        if (username === "") {
            toastr.error("Họ tên không được để trống");
            isValid = false;
        }

        // 2. Kiểm tra thanh toán (Radio)
        // if (!$("input[name='payment']:checked").val()) {
        //     toastr.error("Vui lòng chọn phương thức thanh toán");
        //     isValid = false;
        // }

        const paymentMethod = $("input[name='payment']:checked").val();
        if (!paymentMethod) {
            toastr.error("Vui lòng chọn phương thức thanh toán.");
            isValid = false;
        }
        
        // 3. Nếu mọi thứ OK, in Log và xử lý tiếp
        if (isValid) {
            // Biến totalPrice phải lấy từ hàm updateSummary hoặc tính lại ở đây
            const formDataBooking = {
                'fullName': username,
                'email': email,
                'tel': tel,
                'address': address,
                'numAdults': numAdults,
                'numChildren': numChildren,
                'totalPrice': totalPrice, // Biến global
                'paymentMethod': paymentMethod,
                '_token': $('input[name="_token"]').val(),
            };

          
            console.log(formDataBooking);
            
               $.ajax({
                type: "POST",
                // url: $(this).attr("action"),
                url: "{{ route('create-booking') }}",
                data: formDataBooking,
                success: function (response) {
                    // if (response.success) {
                    //     window.location.href = "/";
                    // } else {
                    //     toastr.error(response.message);
                    // }
                },
                error: function (xhr, textStatus, errorThrown) {
                    toastr.error("Có lỗi xảy ra. Vui lòng thử lại sau.");
                },
            });
            
            
        }
    });



// Khởi tạo tổng giá khi trang vừa tải
updateSummary();
toggleButtonState();



});

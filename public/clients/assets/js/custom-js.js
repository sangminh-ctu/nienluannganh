
$(document).ready(function () {
    // Thiết lập ngôn ngữ tiếng Việt
    $.datetimepicker.setLocale("vi");

    $("#start_date").datetimepicker({
        timepicker: false, // Tắt chọn giờ
        format: "d/m/Y", // Định dạng hiển thị
        minDate: 0, // KHÔNG cho chọn ngày trước ngày hiện tại
        scrollInput: false, // Chặn việc cuộn chuột làm nhảy ngày
        onShow: function (ct) {
            // Đảm bảo khi bảng lịch hiện ra, các ngày cũ sẽ bị làm mờ (disable)
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
        filterTours(null, null,$(this).val());
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
        filterTours(0,20000000);
        if(typeof toastr !== 'undefined') {
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

$('.updateUser').on('submit',function(e){
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
                    toastr.error(response.message  || "Có lỗi xảy ra!");
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
$('.change_password_profile').on('submit',function(e){
   e.preventDefault();
        var oldPass = $("#inputOldPass").val();
        var newPass = $("#inputNewPass").val();
        var isValid = true;
    // kiểm tra độ dài mk
         if (newPass.length < 6 ) {
        isValid = false;
        $("#validate_password_regis")
            .show()
            .text("Mật khẩu phải có ít nhất 6 ký tự.");
    }


    if(isValid) {
        var updatePass = {
                oldPass: oldPass,
                newPass: newPass,
                _token: $('input[name="_token"]').val(),
            };

        console.log(updatePass);
    };
         

        

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
                    $("#validate_password")
                        .show()
                        .text(xhr.responseJSON.message);
                    toastr.error(xhr.responseJSON.message);
                },
            });

});


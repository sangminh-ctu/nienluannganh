// home page
// $("#start_date , #end_date").datetimepicker({
    
//     formatDate: 'd/m/Y',
    
//     timepicker: false
    

// })


$(document).ready(function() {
    // Thiết lập ngôn ngữ tiếng Việt
    $.datetimepicker.setLocale('vi');

    $("#start_date").datetimepicker({
        timepicker: false,    // Tắt chọn giờ
        format: 'd/m/Y',      // Định dạng hiển thị
        minDate: 0,           // KHÔNG cho chọn ngày trước ngày hiện tại
        scrollInput: false,   // Chặn việc cuộn chuột làm nhảy ngày
        onShow: function(ct) {
            // Đảm bảo khi bảng lịch hiện ra, các ngày cũ sẽ bị làm mờ (disable)
            this.setOptions({
                minDate: 0 
            });
        }
    });

    // Tương tự cho ngày kết thúc
    $("#end_date").datetimepicker({
        timepicker: false,
        format: 'd/m/Y',
        minDate: 0,
        scrollInput: false
    });

    // dropdown menu login
     $('#userDropdown').on('click', function() {
        $('#dropdownMenu').toggle();
    });

});



   

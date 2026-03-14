@include('clients.blocks.header')

<div class="user-profile">

    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-4">

                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Ảnh đại diện</div>
                    <div class="card-body text-center">

                        <img class="img-account-profile rounded-circle mb-2"
                            src="{{ asset('clients/assets/images/user-profile/' . $user->avatar) }}" alt='Ảnh đại diện {{ $user->avatar }}'>

                        <div class="small font-italic text-muted mb-4">JPG hoặc PNG không lớn hơn 5 MB</div>

                        <button class="btn btn-primary" type="button">Tải ảnh lên</button>
                    </div>
                    <div class="card-body text-center" style="background-color: grey; margin-top:   10px;">
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Mật khẩu hiện tại</label>
                            <input class="form-control" id="inputUsername" type="text" placeholder="Nhập mật khẩu cũ"
                                value="">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Mật khẩu mới</label>
                            <input class="form-control" id="inputUsername" type="text"
                                placeholder="Nhập mật khẩu mới" value="">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Xác nhận mật khẩu</label>
                            <input class="form-control" id="inputUsername" type="text"
                                placeholder="Nhập lại mật khẩu mới" value="">
                        </div>

                        <button class="btn btn-primary" type="button">Thay đổi</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">

                <div class="card mb-4">
                    <div class="card-header">Thông tin tài khoản</div>
                    <div class="card-body">
                        <form action="{{ route('update-user-profile') }}" method="POST" class="updateUser" name="updateUser">
                           <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFullName">Họ và tên</label>
                                    <input class="form-control" id="inputFullName" type="text"
                                        placeholder="Họ và Tên" value="{{ $user->fullName }}" required>
                                </div>
                            </div>
                            @csrf
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLocation">Địa chỉ</label>
                                    <input class="form-control" id="inputLocation" type="text"
                                        placeholder="Nhập địa chỉ của bạn" value="{{ $user->address }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                <input class="form-control" id="inputEmailAddress" type="email"
                                    placeholder="Địa chỉ mail" value="{{ $user->email}}" required>
                            </div>

                            <div class="row gx-3 mb-3">

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Số điện thoại</label>
                                    <input class="form-control" id="inputPhone" type="tel"
                                        placeholder="Nhập số điện thoại" required pattern="[0-9]{10,11}" value="{{ $user->phoneNumber }}">
                                </div>


                            </div>

                            <button class="btn btn-primary" type="submit" id="update_profile">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




@include('clients.blocks.footer')

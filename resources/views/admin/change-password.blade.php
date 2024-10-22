@extends('admin.layout.master')
@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="container-fluid">

        <div class="row clearfix pt-5">
            <div class="col-12 pb-2">
                <div class="row align-items-center text-center">
                    <img class="logo logo-light m-auto" src="https://greenurjaandenergyefficiencyawards.indianchamber.org/wp-content/themes/icc_green_urja/icc_green_urja/assets/images/logo.svg" alt="logo-dark"
                        style="width:200px;">
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row clearfix pt-2">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h2 class="card-title font-weight-bold fs-4">Change Password</h2>

                            </div>
                        </div>
                        <form action="{{ route('admin.changePassworddata') }}" method="post">
    @csrf
    @method('PUT')

    <div class="row">

        <div class="col-sm-12">
            <label>Current Password *</label>
            <div class="input-group">
                <input class="form-control" type="password" name="current-password" id="current-password" value="{{ old('current-password') }}">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-eye-slash" id="toggleCurrentPassword" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>
            @error('current-password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-sm-12">
            <label>New Password *</label>
            <div class="input-group">
                <input class="form-control" type="password" name="new-password" id="new-password" value="{{ old('new-password') }}">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-eye-slash" id="toggleNewPassword" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>
            @error('new-password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-sm-12">
            <label>Confirm Password *</label>
            <div class="input-group">
                <input class="form-control" type="password" name="password_confirmation" id="confirm-password" value="{{ old('password_confirmation') }}">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-eye-slash" id="toggleConfirmPassword" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <button class="mt-3 btn btn-primary p-2 form-btn" id="videoBtn">SAVE <i class="fa fa-spin fa-spinner" id="videoSpin" style="display:none;"></i></button>
            <button class="mt-3 btn btn-danger p-2 form-btn"><a class="text-white" href="">Cancel</a></button>
        </div>
    </div>
</form>


                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>

        </div>
    </div>
@endsection
@section('externaljs')
    <script src="{{ asset('assets/js/pages/profile.js') }}"></script>
    <script>
    document.getElementById('toggleCurrentPassword').addEventListener('click', function() {
        var passwordField = document.getElementById('current-password');
        var icon = this;
        togglePasswordVisibility(passwordField, icon);
    });

    document.getElementById('toggleNewPassword').addEventListener('click', function() {
        var passwordField = document.getElementById('new-password');
        var icon = this;
        togglePasswordVisibility(passwordField, icon);
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        var passwordField = document.getElementById('confirm-password');
        var icon = this;
        togglePasswordVisibility(passwordField, icon);
    });

    function togglePasswordVisibility(passwordField, icon) {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            passwordField.type = "password";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
</script>
@endsection

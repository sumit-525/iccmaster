<!doctype html>
<html lang="en">

<head>
<title>:: ICCADMIN :: Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Iconic Bootstrap 4.5.0 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="{{asset('dist/favicon.ico')}}" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/toastr/toastr.min.css')}}">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">

</head>

<body data-theme="light" class="font-nunito">
	<!-- WRAPPER -->
	<div id="wrapper" class="theme-cyan">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle auth-main">
				<div class="auth-box">
                    <div class="top">
                        <img src="https://greenurjaandenergyefficiencyawards.indianchamber.org/wp-content/themes/icc_green_urja/icc_green_urja/assets/images/logo.svg" alt="Admin Login" style="width:200px">
                    </div>
					<div class="card">
                        <div class="header">
                            <p class="lead">Reset Password</p>

                        </div>
                        <div class="body">

                            <form action="{{ route('reset.password.post') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" class="form-control" id="signin-email" name="email" placeholder="Enter email" value="{{old('email')}}">

                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" id="signin-password" name="password" placeholder="Enter password" required autofocus>
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm" class="control-label sr-only">Confirm Password</label>
                                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Enter confirm password" required autofocus>
                                    @if ($errors->has('password_confirmation'))
                                      <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                  @endif
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">  Reset Password</button>

                            </form>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
 <!-- Javascript -->
 <script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
 <script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script>
 <script src="{{asset('assets/vendor/toastr/toastr.js')}}"></script>
     <!--- Validation CDN --->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
        $('input').keypress(function(e) {
            if (this.value.length === 0 && e.which === 32) e.preventDefault();
        });
        $('textarea').keypress(function(e) {
            if (this.value.length === 0 && e.which === 32) e.preventDefault();
        });
        $('input[name="mobile"]').on('input', function() {
            $(this).val($(this).val().replace(/\D/g, '')); // Remove non-digits
            if ($(this).val().length > 10) {
                $(this).val($(this).val().substr(0, 10)); // Limit to 10 digits
            }
        });
        $('form').validate({

            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5,
                    password: true

                },

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {

                error.addClass('text-danger');
                error.insertAfter(element);

            },
            highlight: function(element) {
                $(element).addClass('is-invalid mb-1');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid mb-1');
            }
        });
    </script>

    <!-- toastr init -->
    <script>
        @if(Session::has('message'))
        var messageType = '{{ Session::get("status") }}';
        var message = '{{ Session::get("message") }}';

        toastr[messageType](message, '', {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 300,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        });
        @endif


        @if(Session::has('success'))
        toastr.success('{{ Session::get("success") }}', '', {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 300,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        });
        @endif


        @if(Session::has('error'))
        toastr.error('{{ Session::get("error") }}', '', {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 300,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        });
        @endif
    </script>

</body>
</html>

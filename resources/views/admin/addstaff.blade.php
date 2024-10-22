@extends('admin.layout.master')
@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Manage Staff</h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action">
                            <a href="{{ route('admin.staff') }}" type="button" class="btn btn-secondary">Back
                               </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Add / Edit Form -->
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header pb-2">
                        @if (!empty($editstaff))
                            <h2><b>Edit Staff</b></h2>
                            <ul class="header-dropdown">
                                <li class="p-2"><a href="{{ route('admin.addstaffshow') }}"
                                        class="btn btn-primary text-white">Add New</a></li>
                            </ul>
                        @else
                            <h2><b>Add Staff</b></h2>
                        @endif
                    </div>
                    <div class="body demo-card">
                        <form id="addForm" action="{{ route('admin.addstaff') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ !empty($editstaff) ? $editstaff->id : '' }}">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Name <small class="text-danger">*</small></label>
                                        <input type="text" name="name" placeholder="Name *" class="form-control" value="{{ old('name', $editstaff->name ?? '') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Email ID <small class="text-danger">*</small></label>
                                        <input type="email" name="email" placeholder="Email ID *" class="form-control" value="{{ old('email', $editstaff->email ?? '') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Password <small class="text-danger">*</small></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Password *" name="password" id="password" value="{{ old('password', $editstaff->original_password ?? '') }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Mobile Number <small class="text-danger">*</small></label>
                                        <input type="number" name="mobile" placeholder="Mobile Number *" class="form-control" value="{{ old('mobile', $editstaff->mobile ?? '') }}">
                                        @error('mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Select Role</label>
                                        <div class="c_multiselect">
                                            <select name="role_id" class="form-control">
                                                <option value="" disabled selected>Select Role</option>
                                               @forelse ($roles as $each)
                                                <option  value="{{ $each->name}}" @selected(!empty($editstaff) && $editstaff->roles->pluck('name')?->contains($each->name))>{{ucwords($each->name)}}</option>
                                               @empty
                                               @endforelse
                                            </select>
                                        </div>
                                        @error('role_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Address <small class="text-danger">*</small></label>
                                        <textarea name="address" id="permanent_address" cols="30" rows="2" placeholder="Address *" class="form-control no-resize pt-3">{{ old('address', $editstaff->address ?? '') }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">Subscription Start Date <small class="text-danger">*</small></label>
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="subscriptionstartdate" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ old('subscriptionstartdate', $editstaff->subscriptionstartdate ?? '') }}">
                                        @error('subscriptionstartdate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">Subscription End Date <small class="text-danger">*</small></label>
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="subscriptionenddate" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ old('subscriptionenddate', $editstaff->subscriptionenddate ?? '') }}">
                                        @error('subscriptionenddate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">Export Limit <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control" name="exportlimit" placeholder="Export Limit" value="{{ old('exportlimit', $editstaff->exportlimit ?? '') }}">
                                        @error('exportlimit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="form-group">
                                        <label class="form-label">Download Limit <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control" name="downloadlimit" placeholder="Download Limit" value="{{ old('downloadlimit', $editstaff->downloadlimit ?? '') }}">
                                        @error('downloadlimit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="mt-3 btn btn-primary form-btn" id="videoBtn" type="submit">SAVE
                                        <i class="fa fa-spin fa-spinner" id="videoSpin" style="display:none;"></i>
                                    </button>
                                    <a class="text-white mt-3 btn btn-danger form-btn" href="{{ route('admin.staff') }}">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@section('externaljs')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        var passwordInput = document.getElementById('password');
        var icon = this.querySelector('i');

        // Toggle the type attribute
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>

   <script type="text/javascript">
    $(document).ready(function() {
        // Initialize dropify
        $('.dropify').dropify();

        // Form-validation
        $('#addForm').validate({
            ignore: 'hidden',
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                },
                mobile: {
                    required: true,
                    digits: true
                },
                role_id: {
                    required: true
                },
                address: {
                    required: true
                },
                subscriptionstartdate: {
                    required: true,
                    // date: true
                },
                subscriptionenddate: {
                    required: true,
                    // date: true
                },
                downloadlimit: {
                    required: true,
                    // date: true
                },
                exportlimit: {
                    required: true,
                    // date: true
                }
            },
            messages: {
                name: {
                    required: "Please enter your name"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please enter your password"
                },
                mobile: {
                    required: "Please enter your mobile number",
                    digits: "Please enter a valid mobile number"
                },
                role_id: {
                    required: "Please select a role"
                },
                address: {
                    required: "Please enter your address"
                },
                subscriptionstartdate: {
                    required: "Please select the subscription start date",
                    date: "Please enter a valid date"
                },
                subscriptionenddate: {
                    required: "Please select the subscription end date",
                    date: "Please enter a valid date"
                },

                downloadlimit: {
                    required: "Please enter viewer download limit",
                },
                exportlimit: {
                    required: "Please enter viewer export limit",
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('text-danger');
                if (element.attr("name") == "subscriptionstartdate" || element.attr("name") == "subscriptionenddate" || element.attr("name") == "role_id") {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element) {
                $(element).addClass('is-invalid mb-1');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid mb-1');
            }
        });

        // Custom validation for Summernote description if needed
    });
</script>


@endsection
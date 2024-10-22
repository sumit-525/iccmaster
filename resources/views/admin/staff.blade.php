@extends('admin.layout.master')
@section('content')
    <style>
       .pr{
        padding-right: 0em !important;
       }
    </style>




    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Staff List</h2>
                </div>
                @can('employee-add')
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="d-flex flex-row-reverse">
                            <div class="page_action">
                                <a href="{{ route('admin.addstaffshow') }}" type="button" class="btn btn-secondary">Add
                                    new</a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
        <!--Add / Edit Form -->
        {{-- <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header pb-2">
                        @if (!empty($editstaff))
                            <h2><b>Edit Staff</b></h2>
                            <ul class="header-dropdown">stat
                                <li class="p-2"><a href="{{ route('admin.staff') }}"
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
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Name <small class="text-danger">*</small></label>
                                        <input type="text" name="name" placeholder="Name *" class="form-control" value="{{ old('name', $editstaff->name ?? '') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Email ID <small class="text-danger">*</small></label>
                                        <input type="email" name="email" placeholder="Email ID *" class="form-control" value="{{ old('email', $editstaff->email ?? '') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Password <small class="text-danger">*</small></label>
                                        <input type="password" class="form-control" placeholder="Password *" name="password" id="password"  value="{{ old('password', $editstaff->original_password ?? '') }}">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Mobile Number <small class="text-danger">*</small></label>
                                        <input type="number" name="mobile" placeholder="Mobile Number *" class="form-control" value="{{ old('mobile', $editstaff->mobile ?? '') }}">
                                        @error('mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>Select Role</label>
                                        <div class="c_multiselect">
                                            <select id="single-selection" name="role_id" class="multiselect multiselect-custom">
                                                <option value="" disabled selected>Select Role</option>
                                                <option value="2" {{ old('role_id', $editstaff->role_id ?? '') == 2 ? 'selected' : '' }}>Editor</option>
                                                <option value="3" {{ old('role_id', $editstaff->role_id ?? '') == 3 ? 'selected' : '' }}>Viewer</option>
                                            </select>
                                        </div>
                                        @error('role_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Address <small class="text-danger">*</small></label>
                                        <textarea name="address" id="permanent_address" cols="30" rows="2" placeholder="Address *" class="form-control no-resize pt-3">{{ old('address', $editstaff->address ?? '') }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Subscription Start Date <small class="text-danger">*</small></label>
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="subscriptionstartdate" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ old('subscriptionstartdate', $editstaff->subscriptionstartdate ?? '') }}">
                                        @error('subscriptionstartdate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Subscription End Date <small class="text-danger">*</small></label>
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="subscriptionenddate" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ old('subscriptionenddate', $editstaff->subscriptionenddate ?? '') }}">
                                        @error('subscriptionenddate')
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
        </div> --}}
        <!---Staff List -->
        {{-- <div class="row clearfix pt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2 class="font-weight-bold">Staff List</h2>
                    </div>
                    <div class="body table-responsive">

                        <table class="table table-bordered data-table dt-responsive nowrap w-100" id="yajradb">
                            <thead id="sortable">
                                <tr>
                                    <th>SR. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row clearfix">
            @forelse ($staffs as $staff)
                @php
                    $encryptedId = encrypt($staff->id);
                @endphp
                <div class="col-lg-6 col-md-12">
                    <div class="card w_profile">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="profile-image float-md-right"> <img
                                            src="{{ !empty($staff->icon) ? asset('storage/' . $staff->icon) : asset('assets/images/user.jpg') }}"
                                            alt="" class="img-fluid">

                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-12">
                                    <h4 class="m-t-0 mb-0"><strong> {{ $staff->name }}</strong> <a>
                                            <!-- Toggle Switch -->
                                            @can('employee-edit')
                                            <label class="toggle-switch float-right">
                                                <input type="checkbox" {{ $staff->status == 1 ? 'checked' : '' }}
                                                    onchange="changeStatus('id', '{{ $staff->id }}', 'status', '{{ $staff->status == 1 ? 0 : 1 }}', '{{ $tablename }}')">
                                                <span class="toggle-switch-slider"></span>
                                            </label>
                                            @endcan
                                        </a></h4>
                                    <span class="job_post">{{ ucfirst($staff?->roles[0]?->name) }}</span>
                                    <p>{{ $staff->address }}</p>

                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 pr">
                                            <p>{{ $staff->subscriptionstartdate }}</p>
                                            <small>Start Date</small>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <p>{{ $staff->subscriptionenddate }}
                                            <p>
                                                <small>End Date</small>
                                        </div>
                                        <div class="col-md-2 col-sm-6 px-0">
                                            <p>{{ $staff->downloadlimit }}</p>
                                            <small>Download</small>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <p>{{ $staff->exportlimit }}</p>
                                            <small>Export</small>
                                        </div>
                                    </div>
                                    <div class="m-t-15">

                                        <a href="javascript:void(0)"
                                            onclick="deleteData('id', {{ $staff->id }}, '{{ $tablename }}')"
                                            class="btn btn-icon btn-danger text-white">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <a href="{{ route('admin.editstaff', ['id' => $encryptedId]) }}"
                                            class="btn btn-icon btn-secondary text-white">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>

    <!---Delet Model--->
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center pt-4">
                    <h3>Delete Data</h3>
                    <p>Are you sure want to delete?</p>
                    <div class="mb-3">
                        <form action="{{ route('admin.DeleteData') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="Id" id="delId" />
                            <input type="hidden" name="column" id="delColumn" />
                            <input type="hidden" name="table" id="delTable" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                            <button type="submit" class="btn btn-danger">Yes, delete it!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('externaljs')
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
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('text-danger');
                    if (element.attr("name") == "subscriptionstartdate" || element.attr("name") ==
                        "subscriptionenddate" || element.attr("name") == "role_id") {
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
    <script type="text/javascript">
        $(function() {
            var table = $('#yajradb').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.staff') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'original_password',
                        name: 'original_password'
                    },
                    {
                        data: 'role_name',
                        name: 'role_name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection

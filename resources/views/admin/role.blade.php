@extends('admin.layout.master')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Role List</h2>

                </div>

            </div>
        </div>

        <!-- Add Role -->
        <div class="row clearfix pb-4">
            <div class="col-lg-12">
                <div class="card">

                    <div class="header pb-2">
                        @if (!empty($editrole))
                        <h2><b>Edit Role</b></h2>
                        <ul class="header-dropdown">
                            <li class="p-2"><a href="{{ route('admin.role') }}" class="btn btn-primary text-white">Add New</a></li>
                        </ul>
                        @else
                        <h2><b>Add Role</b></h2>
                        @endif
                    </div>
                    <div class="card-body">
                        <form id="AddForm" action="{{ route('admin.addrole') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-2">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" name="id"
                                            value="{{ !empty($editrole) ? $editrole->id : '' }}">
                                        <label class="form-label">Role Name <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" placeholder="Role Name" name="role_name"
                                            value="{{ !empty($editrole->role_name) ? $editrole->role_name : old('role_name') }}">
                                        @error('role_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-md-12">
                                        <button class="mt-3 btn btn-primary form-btn" id="videoBtn" type="submit">SAVE <i
                                                class="fa fa-spin fa-spinner" id="videoSpin"
                                                style="display:none;"></i></button>
                                        <a class="text-white mt-3 btn btn-danger form-btn"
                                            href="{{ route('admin.role') }}">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!---Category List -->
        <div class="row clearfix pt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2 class="font-weight-bold">Role List</h2>
                    </div>
                    <div class="body table-responsive">

                        <table class="table table-bordered data-table dt-responsive nowrap w-100" id="yajradb">
                            <thead id="sortable">
                                <tr>
                                    <th>SR. No.</th>
                                    <th>Role Name</th>
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
                        <form action="{{ route('admin.deleterole') }}" method="post" enctype="multipart/form-data">
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
    <script>
        $(document).ready(function() {
            $('#AddForm').validate({
                ignore: ":hidden:not('.validate-hidden')",
                rules: {
                    role_name: {
                        required: true,
                        remote: {
                            url: "{{ route('admin.checkRoleName') }}",
                            type: "post",
                            data: {
                                role_name: function() {
                                    return $("input[name='role_name']").val();
                                },
                                id: function() {
                                    return $("input[name='id']")
                                .val(); // Assuming you have an input field for the role ID in your form
                                },
                                _token: "{{ csrf_token() }}"
                            },
                            dataFilter: function(response) {
                                var data = JSON.parse(response);
                                if (data.isDuplicate) {
                                    return JSON.stringify("Role name already exists");
                                } else {
                                    return true;
                                }
                            }
                        }
                    },
                },
                messages: {
                    role_name: {
                        required: "Please enter the role",
                        remote: "Role name already exists"
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('text-danger');
                    if (element.attr("name") == "nametype") {
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

        });
    </script>

    <script type="text/javascript">
        $(function() {

            var table = $('#yajradb').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.role') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
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

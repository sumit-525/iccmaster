@extends('admin.layout.master')
@section('content')
<style>
    .file_manager .file .hover {

    top: 13px;
}
</style>

    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Category List</h2>
                </div>
                @can('documentcategory-add')
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="d-flex flex-row-reverse">
                            <div class="page_action">
                                <a href="{{ route('admin.addcategoryshow') }}" type="button" class="btn btn-secondary">Add new</a>
                            </div>
                            <div class="p-2 d-flex">

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
                    @if (!empty($editcategory))
                    <h2><b>Edit Category</b></h2>
                    <ul class="header-dropdown">
                        <li class="p-2"><a href="{{ route('admin.category') }}" class="btn btn-primary text-white">Add New</a></li>
                    </ul>
                    @else
                    <h2><b>Add Category</b></h2>
                    @endif
                </div>
                <div class="body demo-card">
                <form id="addForm" action="{{ route('admin.addcategory') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ !empty($editcategory) ? $editcategory->id : '' }}">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label">Category Name <small class="text-danger">*</small></label>
                                <input type="text" name="name" placeholder="Category Name *" class="form-control" value="{{ old('name', $editcategory->name ?? '') }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="mt-3 btn btn-primary form-btn" id="videoBtn" type="submit">SAVE
                                <i class="fa fa-spin fa-spinner" id="videoSpin" style="display:none;"></i></button>
                            <a class="text-white mt-3 btn btn-danger form-btn" href="">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div> --}}

        <!---Category List -->
        {{-- <div class="row clearfix pt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2 class="font-weight-bold">Category List</h2>
                </div>
                <div class="body table-responsive">

                    <table class="table table-bordered data-table dt-responsive nowrap" id="yajradb">
                        <thead id="sortable">
                            <tr>
                                <th>SR. No.</th>
                                <th>Category Name</th>
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


        <div class="row clearfix file_manager">

            @foreach ($categories as $category)
                @php $encryptedId = encrypt($category->id);
                @endphp
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="file">
                            <a href="javascript:void(0);" class="d-flex justify-content-center align-items-center">
                                <div class="hover ">
                                    <a href="{{ route('admin.document', ['category_id' => $encryptedId]) }} "
                                        class="btn btn-icon btn-info text-white btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @can('documentcategory-delete')
                                    <a href="javascript:void(0)"
                                        onclick="deleteData('id', '{{ $category->id }}', '{{ $tablename }}')"
                                        class="btn btn-icon btn-danger text-white btn-sm ">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endcan
                                    @can('documentcategory-edit')
                                    <a href="{{ route('admin.editcategory', ['id' => $encryptedId]) }}"
                                        class="btn btn-icon btn-secondary text-white btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endcan

                                </div>
                                <a href="{{ route('admin.document', ['category_id' => $encryptedId]) }} " class="folder">
                                    <h6 data-toggle="tooltip" data-placement="top" title="{{ $category->name }}"><i
                                            class="fa fa-folder m-r-10"></i>{!! Str::limit(strip_tags($category->name), 16) !!}</h6>
                                </a>

                            </a>
                        </div>
                    </div>
                </div>
            @endforeach


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
                        <form action="{{ route('admin.deletecategory') }}" method="post" enctype="multipart/form-data">
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
                            url: "{{ route('admin.checkCategoryName') }}",
                            type: "post",
                            data: {
                                role_name: function() {
                                    return $("input[name='name']").val();
                                },
                                id: function() {
                                    return $("input[name='id']")
                                .val(); // Assuming you have an input field for the category ID in your form
                                },
                                _token: "{{ csrf_token() }}"
                            },
                            dataFilter: function(response) {
                                var data = JSON.parse(response);
                                if (data.isDuplicate) {
                                    return JSON.stringify("Category name already exists");
                                } else {
                                    return true;
                                }
                            }
                        }
                    },
                },
                messages: {
                    name: {
                        required: "Please enter the category name",
                        remote: "Category name already exists"
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
                ajax: "{{ route('admin.category') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
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

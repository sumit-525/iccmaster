@extends('admin.layout.master')
@section('content')
<style>
    .dropify-wrapper {
        height: 120px !important;
    }

    .profile .dropify-wrapper {
        height: 200px !important;
    }
</style>




<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Category List</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="d-flex flex-row-reverse">
                    <div class="page_action">
                        <a href="{{ route('admin.category')}}" type="button" class="btn btn-secondary">Back</a>
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
                    @if (!empty($editcategory))
                    <h2><b>Edit Category</b></h2>
                    <ul class="header-dropdown">
                        <li class="p-2"><a href="{{ route('admin.addcategoryshow') }}" class="btn btn-primary text-white">Add New</a></li>
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
    </div>

</div>


@endsection
@section('externaljs')

<script>
    $(document).ready(function() {
        $('#yajradb1')
            .dataTable({
                responsive: true,
                columnDefs: [{
                    orderable: false,
                    targets: [0]
                }]
            });
    });
</script>
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
                                return $("input[name='id']").val(); // Assuming you have an input field for the category ID in your form
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

@endsection

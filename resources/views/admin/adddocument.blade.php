@extends('admin.layout.master')
@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Manage Document</h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action">
                            <a href="{{ route('admin.document')}}" type="button" class="btn btn-secondary">Back</a>
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
                        @if (!empty($edit))
                            <h2><b>Edit Document</b></h2>
                            <ul class="header-dropdown">
                                <li class="p-2"><a href="{{ route('admin.staff') }}"
                                        class="btn btn-primary text-white">Add New</a></li>
                            </ul>
                        @else
                            <h2><b>Add Document</b></h2>
                        @endif
                    </div>
                    <div class="body demo-card">
                        <form id="addForm" action="{{ route('admin.adddocument') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ !empty($editdocument) ? $editdocument->id : '' }}">

                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Title <small class="text-danger">*</small></label>
                                        <input type="text" name="title" placeholder="Title *" class="form-control" value="{{ old('title', $editdocument->title ?? '') }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Select Category <small class="text-danger">*</small></label>

                                            <select name="category_id" class="form-control">
                                                <option disabled {{ empty($editdocument) ? 'selected' : '' }}>Category Type</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ !empty($editdocument) && $editdocument->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Start Date </label>
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="startdate" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ old('startdate', $editdocument->startdate ?? '') }}">
                                        @error('startdate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">End Date</label>
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="enddate" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ old('enddate', $editdocument->enddate ?? '') }}">
                                        @error('enddate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Upload Document <small class="text-danger">*</small></label>
                                        <input type="file" name="document" placeholder="Upload Document *" class="form-control">
                                        @error('document')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description </label>
                                        <textarea class="summernote" name="description">{{ old('description', $editdocument->description ?? '') }}</textarea>
                                        @error('description')
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
                                    <a class="text-white mt-3 btn btn-danger form-btn" href="{{ route('admin.document') }}">Cancel</a>
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

    <script type="text/javascript">
        $(document).ready(function() {

            // Form validation
            $('#addForm').validate({
                ignore: '',
                rules: {
                    title: {
                        required: true
                    },
                    category_id: {
                        required: true
                    },
                    // startdate: {
                    //     required: true,
                    //     date: true
                    // },
                    // enddate: {
                    //     required: true,
                    //     date: true
                    // },
                    // document: {
                    //     required: true
                    // },
                    // description: {
                    //     required: true
                    // }
                },
                messages: {
                    title: {
                        required: "Please enter the document title"
                    },
                    // category_id: {
                    //     required: "Please select a category"
                    // },
                    // startdate: {
                    //     required: "Please select the start date",
                    //     date: "Please enter a valid date"
                    // },
                    enddate: {
                        required: "Please select the end date",
                        date: "Please enter a valid date"
                    },
                    // document: {
                    //     required: "Please upload the document"
                    // },
                    // description: {
                    //     required: "Please enter the description"
                    // }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('text-danger');
                    if (element.attr("name") == "category_id") {
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

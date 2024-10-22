@extends('admin.layout.master')
@section('content')


    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>News Details List</h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action">
                            <a href="{{ route('admin.newsdetails')}}" type="button" class="btn btn-secondary">Back</a>
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
                            <h2><b>Edit News</b></h2>
                            <ul class="header-dropdown">
                                <li class="p-2"><a href="{{ route('admin.addnewsshow') }}"
                                        class="btn btn-primary text-white">Add New</a></li>
                            </ul>
                        @else
                            <h2><b>Add News Details</b></h2>
                        @endif
                    </div>
                    <div class="body demo-card">
                        <form id="addForm" action="{{ route('admin.addnewsdetails') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ !empty($editnewsdetails) ? $editnewsdetails->id : '' }}">

                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Title <small class="text-danger">*</small></label>
                                        <input type="text" name="title" placeholder="Title *" class="form-control" value="{{ old('title', $editnewsdetails->title ?? '') }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Link </label>
                                        <input type="url" name="link" placeholder="Link *" class="form-control" value="{{ old('link', $editnewsdetails->link ?? '') }}">
                                        @error('link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>Select Category <small class="text-danger">*</small></label>

                                            <select name="newscategory_id"  class="form-control">
                                                <option disabled {{ empty($editnewsdetails) ? 'selected' : '' }}>Category Type</option>
                                                @foreach ($newscategories as $category)
                                                    <option value="{{ $category->id }}" {{ !empty($editnewsdetails) && $editnewsdetails->newscategory_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                        @error('newscategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Start Date </label>
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="startdate" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ old('startdate', $editnewsdetails->startdate ?? '') }}">
                                        @error('startdate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">End Date</label>
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="enddate" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ old('enddate', $editnewsdetails->enddate ?? '') }}">
                                        @error('enddate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Upload Image <small class="text-danger">*</small></label>
                                        <input type="file" name="image" placeholder="Upload Image *" class="form-control">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description </label>
                                        <textarea class="summernote" name="description">{{ old('description', $editnewsdetails->description ?? '') }}</textarea>
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
                                    <a class="text-white mt-3 btn btn-danger form-btn" href="{{ route('admin.newsdetails') }}">Cancel</a>
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
                    newscategory_id: {
                        required: true
                    },

                    // image: {
                    //     required: true
                    // },

                },
                messages: {
                    title: {
                        required: "Please enter the news title"
                    },
                    enddate: {
                        required: "Please select the end date",
                        date: "Please enter a valid date"
                    },
                    // image: {
                    //     required: "Please upload the image"
                    // },
                    // description: {
                    //     required: "Please enter the description"
                    // }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('text-danger');
                    if (element.attr("name") == "newscategory_id") {
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

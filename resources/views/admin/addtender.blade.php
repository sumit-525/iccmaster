@extends('admin.layout.master')
@section('content')


    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Tender List</h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action">
                            <a href="{{ route('admin.tender')}}" type="button" class="btn btn-secondary">Back</a>
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
                        @if (!empty($edittenderdetails))
                            <h2><b>Edit Tender</b></h2>
                            <ul class="header-dropdown">
                                <li class="p-2"><a href="{{ route('admin.addtendershow') }}"
                                        class="btn btn-primary text-white">Add New</a></li>
                            </ul>
                        @else
                            <h2><b>Add Tender Details</b></h2>
                        @endif
                    </div>
                    <div class="body demo-card">
                        <form id="addForm" action="{{ route('admin.addtenderdetails') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ !empty($edittenderdetails) ? $edittenderdetails->id : '' }}">

                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Title <small class="text-danger">*</small></label>
                                        <input type="text" name="title" placeholder="Title *" class="form-control" value="{{ old('title', $edittenderdetails->title ?? '') }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Link </label>
                                        <input type="url" name="link" placeholder="Link *" class="form-control" value="{{ old('link', $edittenderdetails->link ?? '') }}">
                                        @error('link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>Select Category <small class="text-danger">*</small></label>

                                            <select name="tendercategory_id"  class="form-control">
                                                <option disabled {{ empty($edittenderdetails) ? 'selected' : '' }}>Category Type</option>
                                                @foreach ($tendercategories as $category)
                                                    <option value="{{ $category->id }}" {{ !empty($edittenderdetails) && $edittenderdetails->tendercategory_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                        @error('tendercategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Start Date </label>
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="startdate" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ old('startdate', $edittenderdetails->startdate ?? '') }}">
                                        @error('startdate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">End Date</label>
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="enddate" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ old('enddate', $edittenderdetails->enddate ?? '') }}">
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
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Country <small class="text-danger">*</small></label>
                                        <input type="text" name="country" placeholder="Country *" class="form-control"  value="{{ old('country', $edittenderdetails->country ?? '') }}">
                                        @error('country')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">State <small class="text-danger">*</small></label>
                                        <input type="text"  class="form-control" name="state" placeholder="State *" value="{{ old('state', $edittenderdetails->state ?? '') }}">
                                        @error('enddate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">City <small class="text-danger">*</small></label>
                                        <input type="text" name="city" placeholder="City *" class="form-control"  value="{{ old('city', $edittenderdetails->city ?? '') }}">
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description </label>
                                        <textarea class="summernote" name="description">{{ old('description', $edittenderdetails->description ?? '') }}</textarea>
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
                                    <a class="text-white mt-3 btn btn-danger form-btn" href="{{ route('admin.tender') }}">Cancel</a>
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
                    tendercategory_id: {
                        required: true
                    },

                    // image: {
                    //     required: true
                    // },
                    country: {
                        required: true
                    },
                    state: {
                        required: true
                    },

                    city: {
                        required: true
                    },

                },
                messages: {
                    title: {
                        required: "Please enter the tender title"
                    },
                    country: {
                        required: "Please enter the country",

                    },
                    state: {
                        required: "Please enter the state "
                    },
                    city: {
                        required: "Please enter the city"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('text-danger');
                    if (element.attr("name") == "tendercategory_id") {
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

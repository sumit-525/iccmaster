@extends('admin.layout.master')
@section('content')


    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Import Excel</h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action">
                            <a href="{{ route('admin.portwiseexportdata')}}" type="button" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!--Add / Edit Form -->
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="header pb-2">
                        @if (!empty($edit))
                            <h2><b>Edit News</b></h2>
                            <ul class="header-dropdown">
                                <li class="p-2"><a href="{{ route('admin.addnewsshow') }}"
                                        class="btn btn-primary text-white">Import Excel</a></li>
                            </ul>
                        @else
                            <h2><b>Import Excel</b></h2>
                        @endif
                    </div> --}}
                    <div class="body demo-card">
                        <form id="addForm" action="{{ route('admin.addportwiseexportdata') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ !empty($editnewsdetails) ? $editnewsdetails->id : '' }}">

                            <div class="row clearfix">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Upload Excel <small class="text-danger">*</small></label>
                                        <input type="file" name="excel" placeholder="Title *" class="form-control">
                                        @error('excel')
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
                    excel: {
                        required: true
                    },

                },
                messages: {
                    excel: {
                        required: "Please upload the excel"
                    },

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

@extends('admin.layout.master')
@section('content')
    {{-- <style>
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-overlay img {
            max-width: 90%;
            max-height: 80%;
            border-radius: 8px;
        }

        .modal-overlay .close-modal {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            color: white;
            cursor: pointer;
        }
    </style> --}}

 <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Document List</h2>
                </div>
                @can('document-add')
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="d-flex flex-row-reverse">
                            <div class="page_action">
                                <a href="{{ route('admin.adddocumentshow') }}" type="button" class="btn btn-secondary">Add
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
                                        <div class="c_multiselect">
                                            <select id="single-selection" name="category_id" class="multiselect multiselect-custom">
                                                <option disabled {{ empty($editdocument) ? 'selected' : '' }}>Category Type</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ !empty($editdocument) && $editdocument->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
        </div> --}}

        <!---Document List -->
        {{-- <div class="row clearfix pt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2 class="font-weight-bold">Document List</h2>
                    </div>
                    <div class="body table-responsive">

                        <table class="table table-bordered data-table dt-responsive nowrap w-100" id="yajradb">
                            <thead id="sortable">
                                <tr>
                                    <th>SR. No.</th>
                                    <th>Title</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>View</th>
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
    </div>
        <!---card doc list-->
        <div class="container-fluid file_manager">
            <div class="block-header">
                <div class="row">
                    @foreach ($documents as $document)
                        @php
                            $encryptedId = encrypt($document->id);
                            $fileExtension = pathinfo($document->document, PATHINFO_EXTENSION);
                        @endphp
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="card">
                                <div class="file">
                                    <a href="javascript:void(0);">
                                        <div class="hover">
                                            <a href="{{ asset('storage/' . $document->document) }}"
                                                class="btn btn-icon btn-success text-white btn-sm" download>
                                                <i class="fa fa-download fs-xsm"></i>
                                            </a>
                                            @can('document-delete')
                                            <a href="javascript:void(0)"
                                                onclick="deleteData('id', {{ $document->id }}, '{{ $tablename }}')"
                                                class="btn btn-icon btn-danger text-white btn-sm">
                                                <i class="fa fa-trash fs-xsm"></i>
                                            </a>
                                            @endcan
                                            @can('document-edit')
                                            <a href="{{ route('admin.editdocument', ['id' => $encryptedId]) }}"
                                                class="btn btn-icon btn-secondary text-white btn-sm">
                                                <i class="fa fa-edit fs-xsm"></i>
                                            </a>
                                            @endcan

                                        </div>
                                        <div class="icon">
                                            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                                <div class="image-popup d-block" data-toggle="modal"
                                                    data-target="#imageModal"
                                                    data-image="{{ asset('storage/' . $document->document) }}">
                                                    <i class="fa fa-image text-warning d-block"></i>
                                                </div>
                                            @elseif($fileExtension === 'pdf')
                                                <div class="pdf-popup d-block" data-toggle="modal" data-target="#pdfModal"
                                                    data-pdf="{{ asset('storage/' . $document->document) }}">
                                                    <i class="fa fa-file-pdf-o text-success  d-block"></i>
                                                </div>
                                            @elseif(in_array($fileExtension, ['doc', 'docx']))
                                                {{-- <a href="{{ asset('storage/' . $document->document) }}" download> --}}
                                                <i class="fa fa-file-word-o text-info"></i>
                                                {{-- </a> --}}
                                            @elseif(in_array($fileExtension, ['xls', 'xlsx']))
                                                {{-- <a href="{{ asset('storage/' . $document->document) }}" download> --}}
                                                <i class="fa fa-file-excel-o text-danger"></i>
                                                {{-- </a> --}}
                                            @else
                                                <i class="fa fa-file text-muted"></i>
                                                <!-- Default icon for unknown types -->
                                            @endif
                                        </div>

                                        <div class="file-name">
                                            <span data-toggle="tooltip" data-placement="top" title="{{ $document->title }}">
                                                {!! Str::limit(strip_tags($document->title), 30) !!}
                                                @can('document-edit')
                                                <span class="date text-muted float-right">
                                                    <a style="vertical-align: middle;">
                                                        <!-- Toggle Switch -->
                                                        <label class="toggle-switch">
                                                            <input type="checkbox"
                                                                {{ $document->status == 1 ? 'checked' : '' }}
                                                                onchange="changeStatus('id', '{{ $document->id }}', 'status', '{{ $document->status == 1 ? 0 : 1 }}', '{{ $tablename }}')">
                                                            <span class="toggle-switch-slider"></span>
                                                        </label>
                                                    </a>
                                                </span>
                                               @endcan
                                            </span>
                                        </div>

                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

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
                        <form action="{{ route('admin.DeleteData') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="Id" id="delId" />
                            <input type="hidden" name="column" id="delColumn" />
                            <input type="hidden" name="table" id="delTable" />
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                            <button type="submit" class="btn btn-danger">Yes, delete it!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap 4 Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- PDF Modal -->
    <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfViewer" src="" width="100%" height="500px"></iframe>
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
                    document: {
                        required: true
                    },
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
                    document: {
                        required: "Please upload the document"
                    },
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
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <!-- JSZip for Excel export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
    <!-- pdfmake for PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <!-- DataTables Buttons HTML5 export -->
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('#yajradb').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.document') }}",
                dom: 'Bfrtip', // Include the buttons plugin with the 'dom' option
                buttons: [{
                        extend: 'excelHtml5',
                        text: 'Export Excel',
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: ':visible' // Export only visible columns
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'Export CSV',
                        className: 'btn btn-info',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Export PDF',
                        className: 'btn btn-danger',
                        exportOptions: {
                            columns: ':visible'
                        },
                        orientation: 'landscape', // Set orientation to landscape for PDF
                        pageSize: 'A4' // Set page size for PDF
                    }
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'download',
                        name: 'download'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.image-popup').on('click', function() {
                var imageUrl = $(this).data('image');
                $('#modalImage').attr('src', imageUrl);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.pdf-popup').on('click', function() {
                var pdfUrl = $(this).data('pdf');
                $('#pdfViewer').attr('src', pdfUrl);
            });

            // Optional: Clear the iframe src when modal is closed
            $('#pdfModal').on('hidden.bs.modal', function() {
                $('#pdfViewer').attr('src', '');
            });
        });
    </script>
@endsection

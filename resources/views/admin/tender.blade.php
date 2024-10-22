@extends('admin.layout.master')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Tender List</h2>
            </div>
            @can('tender-add')
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="d-flex flex-row-reverse">
                    <div class="page_action">
                        <a href="{{ route('admin.addtendershow') }}" type="button" class="btn btn-secondary">Add new</a>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>

    <!---News List -->
    <div class="row clearfix pt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2 class="font-weight-bold">Tender List</h2>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered data-table dt-responsive nowrap w-100" id="yajradb1">
                        <thead id="sortable">
                            <tr>
                                <th>SR. No.</th>
                                <th>Title</th>
                                <th>Category Name</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Link</th>
                                <th>File</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alltenders as $tender)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tender->title }}</td>
                                <td>{{ $tender->tendercategory->name }}</td>
                                <td>{{ $tender->country }}</td>
                                <td>{{ $tender->state }}</td>
                                <td>{{ $tender->city }}</td>
                                <td>{{ $tender->link }}</td>
                                <!-- Image/File Column -->
                                <td>
                                    @php
                                        $fileExtension = pathinfo($tender->document, PATHINFO_EXTENSION);
                                    @endphp

                                    @if(!empty($tender->document))
                                        <a href="{{ asset('storage/'.$tender->document) }}" target="_blank" download>
                                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset('storage/'.$tender->document) }}" width="50" height="50" alt="Tender Image">
                                            @elseif($fileExtension === 'pdf')
                                                <i class="fa fa-file-pdf-o text-danger fa-2x"></i>
                                            @elseif(in_array($fileExtension, ['doc', 'docx']))
                                                <i class="fa fa-file-word-o text-info fa-2x"></i>
                                            @elseif(in_array($fileExtension, ['xls', 'xlsx']))
                                                <i class="fa fa-file-excel-o text-success fa-2x"></i>
                                            @else
                                                <i class="fa fa-file text-muted fa-2x"></i>
                                            @endif
                                        </a>
                                    @else
                                        <!-- No file -->
                                    @endif
                                </td>

                                <!-- Description with Modal -->
                                <td>
                                    @if(!empty($tender->description))
                                    <button type="button" class="btn btn-outline-info  btn-sm" data-toggle="modal" data-target="#descriptionModal{{ $tender->id }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- Modal Structure -->
                                    <div class="modal fade" id="descriptionModal{{ $tender->id }}" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel{{ $tender->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="descriptionModalLabel{{ $tender->id }}">Tender Description</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $tender->description !!}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>

                                <!-- Status Column -->
                                <td>
                                    @can('tender-edit')
                                    @if($tender->status == 1)
                                    <div class='dropdown d-inline-block user-dropdown'>
                                        <button type='button' class='btn text-dark waves-effect' data-toggle='dropdown'>
                                            <div class='badge bg-success-subtle text-success font-size-12'>Active</div>
                                            <i class='fa fa-angle-down'></i>
                                        </button>
                                        <div class='dropdown-menu'>
                                            <a class='dropdown-item' onclick="changeStatus('id', '{{ $tender->id }}', 'status', '0', '{{ $tablename }}')">Inactive</a>
                                        </div>
                                    </div>
                                    @else
                                    <div class='dropdown d-inline-block user-dropdown'>
                                        <button type='button' class='btn text-dark waves-effect' data-toggle='dropdown'>
                                            <div class='badge bg-danger-subtle text-danger font-size-12'>Inactive</div>
                                            <i class='fa fa-angle-down'></i>
                                        </button>
                                        <div class='dropdown-menu'>
                                            <a class='dropdown-item' onclick="changeStatus('id', '{{ $tender->id }}', 'status', '1', '{{ $tablename }}')">Active</a>
                                        </div>
                                    </div>
                                    @endif
                                    @else
                                    <button type='button' class='btn text-dark waves-effect'>
                                        <div class='badge bg-{{ $tender->status == 1 ? 'success' : 'danger' }}-subtle text-{{ $tender->status == 1 ? 'success' : 'danger' }} font-size-12'>
                                            {{ $tender->status == 1 ? 'Active' : 'Inactive' }}
                                        </div>
                                    </button>
                                    @endcan
                                </td>

                                <!-- Action Column -->
                                <td>
                                    @can('tender-edit')
                                    <a href="{{ route('admin.edittenderdetails', ['id' => encrypt($tender->id)]) }}" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('tender-delete')
                                    <a href="javascript:void(0)" onclick="deleteData('id', '{{ $tender->id }}', '{{ $tablename }}')" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash-o"></i></a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
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
    $(function() {
        var table = $('#yajradb').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.tender') }}",

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'tendercategory_name',
                    name: 'tendercategory_name'
                },

                {
                    data: 'country',
                    name: 'country'
                },
                {
                    data: 'state',
                    name: 'state'
                },
                {
                    data: 'city',
                    name: 'city'
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
                }
            ]
        });
    });
</script>
@endsection

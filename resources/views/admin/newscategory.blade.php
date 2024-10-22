@extends('admin.layout.master')
@section('content')

    <!---Category List -->


    <div class="container-fluid file_manager">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>News Category List</h2>
                </div>
                @can('newscategory-add')
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="d-flex flex-row-reverse">
                            <div class="page_action">
                                <a href="{{ route('admin.addnews') }}" type="button" class="btn btn-secondary">Add new</a>
                            </div>
                            <div class="p-2 d-flex">

                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
        <div class="row clearfix pt-3">
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
        </div>
        {{-- <div class="row clearfix ">

            @foreach ($newscategories as $newscategory)
                @php $encryptedId = encrypt($newscategory->id);
                @endphp
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <a class="btn btn-icon btn-info text-white btn-sm fs-xsm px-1 py-0">
                                        <i class="fa fa-eye fs-xsm"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="deleteData('{{ $newscategory->id }}', '{{ $tablename }}')" class="btn btn-icon btn-danger text-white btn-sm fs-xsm px-1 py-0">
                                        <i class="fa fa-trash fs-xsm"></i>
                                    </a>

                                    <a href="{{ route('admin.editnewscategory', ['id' => $encryptedId]) }}"
                                        class="btn btn-icon btn-secondary text-white btn-sm fs-xsm px-1 py-0">
                                        <i class="fa fa-edit fs-xsm"></i>
                                    </a>
                                    <a style="vertical-align: middle;">
                                        <label class="toggle-switch">
                                            <input type="checkbox" checked="">
                                            <span class="toggle-switch-slider"></span>
                                        </label>
                                    </a>
                                </div>
                                <a href="javascript:void(0);" class="folder">
                                    <h6 data-toggle="tooltip" data-placement="top" title="{{ $newscategory->name }}"><i
                                            class="fa fa-folder m-r-10"></i>{!! Str::limit(strip_tags($newscategory->name), 16) !!}</h6>
                                </a>

                            </a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div> --}}


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
    <script type="text/javascript">
        $(function() {

            var table = $('#yajradb').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.newscategory') }}",
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

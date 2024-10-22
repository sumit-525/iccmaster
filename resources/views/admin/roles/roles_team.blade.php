@extends('admin.layout.master')
@section('content')
    <div class="page-
    <div class="tab-pane fade show active" id="pills-all-candidates" role="tabpanel" aria-labelledby="pills-all-candidates-tab"
        tabindex="0">
        <div class="outer-box">
            <div class="page-heading d-flex justify-content-start align-items-center mt-4">
                <h4 class="d-flex align-items-center mb-0 fw-semibold">{{__('Teams')}}</h4>
            </div>
            <div class="page-content">
                <section class="section">
                    <div class="card-body table-responsive">
                        <table class="table rounded-8px overflow-hidden table-responsive" id="yohrm-table">
                            <thead class="text-nowrap table-header-bg text-color">
                                <tr>
                                    <th><span class="text-dark">{{__('Name')}}</span></th>
                                    <th><span class="text-dark">{{__("Employee Id")}}</span></th>
                                    <th><span class="text-dark">{{__('Department')}} </span></th>
                                    <th><span class="text-dark">{{__('Designation')}}</span></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            "use strict";
            let table = $('#yohrm-table').DataTable({
                buttons: [
                    'print',
                    'postExcel',
                    'postCsv',
                    'postPdf',
                ],
                responsive: false,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                searching: false,
                autoWidth: false,
                ajax: {
                    url: "{{ route('teams.datatable') }}",
                    type: 'GET',
                    data: {
                        'role_id': '{{ request('id') }}'
                    },
                    error: function(xhr, error, thrown) {
                        if (xhr.status == 401 || xhr.status == 419) {
                            window.location.href = "{{ route('login') }}";
                        }
                    },
                },
                columns: [{
                        data: 'name',
                        name: 'name',
                        'orderable': false
                    },

                    {
                        data: 'emp_id',
                        name: 'emp_id',
                        'orderable': false
                    },

                    {
                        data: 'department',
                        name: 'department',
                        'orderable': false
                    },

                    {
                        data: 'desigination',
                        name: 'desigination'
                    },


                ],
                "order": [
                    [0, "desc"]
                ]
            });

        })
    </script>
@endpush

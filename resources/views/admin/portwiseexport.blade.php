@extends('admin.layout.master')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>News Details List</h2>
                </div>
                @can('portwise-add')
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="d-flex flex-row-reverse">
                            <div class="page_action">
                                <a href="{{ asset('assets/excel/exim.xlsx') }}" download="" type="button"
                                    class="btn btn-danger">Sample File</a>
                                <a href="{{ route('admin.addportwiseexportdatashow') }}" type="button"
                                    class="btn btn-secondary">Add new</a>
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
                        <h2 class="font-weight-bold">Port Wise Export Data</h2>
                    </div>
                    <div class="body table-responsive">
                        {{ $dataTable->table() }}
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                            <button type="submit" class="btn btn-danger">Yes, delete it!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('externaljs')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
   <script>
    $(document).ready(function() {
        // Restore checkbox state from localStorage after DataTable reload
        function restoreCheckboxes() {
            $('.select-checkbox').each(function() {
                var checkboxId = $(this).val();
                if (localStorage.getItem(checkboxId) === 'true') {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });
        }

        // Save checkbox state to localStorage
        function saveCheckboxState() {
            $('.select-checkbox').each(function() {
                var checkboxId = $(this).val();
                localStorage.setItem(checkboxId, $(this).is(':checked'));
            });
        }

        // Clear localStorage on page unload
        $(window).on('beforeunload', function() {
            localStorage.clear();
        });

        $(document).on('input', 'input[type="text"]', function() {
            var globalDatatable = window.LaravelDataTables["portwise-table"];
            if (globalDatatable) {
                globalDatatable.settings()[0].ajax.data = function(d) {
                    $(".filter-row input[type='text']").each(function() {
                        var name = $(this).attr('class');
                        var value = $(this).val();
                        if (name) {
                            d[name] = value;
                        }
                    });
                };

                globalDatatable.ajax.reload(function() {
                    restoreCheckboxes(); // Restore checkbox state after reload
                });
            } else {
                console.error('globalDatatable is not defined.');
            }
        });

        $("body").on('click', '#master', function() {
            var isChecked = $(this).is(':checked');
            $('.select-checkbox').prop('checked', isChecked);
            saveCheckboxState(); // Save state when master checkbox is clicked
        });

        $("body").on('click', '.select-checkbox', function() {
            saveCheckboxState(); // Save state when individual checkboxes are clicked
        });

        // Initial restoration on page load
        restoreCheckboxes();
    });
</script>
@endsection

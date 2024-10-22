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
<div id="main-content">
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">

                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Employee List</h2>

                </div>
                <div class="col-md-6 col-sm-12 text-md-end">
                    <div class="d-inline-flex text-start">
                        <div class="me-2">
                            <h6 class="mb-0"><i class="fa fa-user"></i> 1,784</h6>
                            <small>Visitors</small>
                        </div>
                        <span id="bh_visitors"></span>
                    </div>
                    <div class="d-inline-flex text-start ms-lg-3 me-lg-3 ms-1 me-1">
                        <div class="me-2">
                            <h6 class="mb-0"><i class="fa fa-globe"></i> 325</h6>
                            <small>Visits</small>
                        </div>
                        <span id="bh_visits"></span>
                    </div>
                    <div class="d-inline-flex text-start">
                        <div class="me-2">
                            <h6 class="mb-0"><i class="fa fa-comments"></i> 13</h6>
                            <small>Chats</small>
                        </div>
                        <span id="bh_chats"></span>
                    </div>
                </div>
            </div>
        </div>



        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="card-title">Employee List</h6>
                        <ul class="header-dropdown">
                            <li>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addEmployee">Add New</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <table id="employee_List" class="table table-hover">
                            <thead class="thead-dark">
                                <tr>

                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Employee ID</th>
                                    <th>Phone</th>
                                    <th>Join Date</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <h6 class="mb-0">Marshall Nichols</h6>
                                        <span>marshall-n@gmail.com</span>
                                    </td>
                                    <td><span>LA-0215</span></td>
                                    <td><span>+ 264-625-2583</span></td>
                                    <td>24 Jun, 2015</td>
                                    <td>Web Designer</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <h6 class="mb-0">Susie Willis</h6>
                                        <span>sussie-w@gmail.com</span>
                                    </td>
                                    <td><span>LA-0216</span></td>
                                    <td><span>+ 264-625-2583</span></td>
                                    <td>28 Jun, 2015</td>
                                    <td>Web Developer</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <h6 class="mb-0">Debra Stewart</h6>
                                        <span>debra@gmail.com</span>
                                    </td>
                                    <td><span>LA-0218</span></td>
                                    <td><span>+ 264-625-2583</span></td>
                                    <td>21 July, 2015</td>
                                    <td>Web Developer</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                                <tr>

                                    <td>4 </td>
                                    <td>
                                        <h6 class="mb-0">Francisco Vasquez</h6>
                                        <span>francis-v@gmail.com</span>
                                    </td>
                                    <td><span>LA-0222</span></td>
                                    <td><span>+ 264-625-2583</span></td>
                                    <td>18 Jan, 2016</td>
                                    <td>Team Leader</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>
                                        <h6 class="mb-0">Jane Hunt</h6>
                                        <span>jane-hunt@gmail.com</span>
                                    </td>
                                    <td><span>LA-0232</span></td>
                                    <td><span>+ 264-625-2583</span></td>
                                    <td>08 Mar, 2016</td>
                                    <td>Android Developer</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6 </td>
                                    <td>
                                        <h6 class="mb-0">Darryl Day</h6>
                                        <span>darryl.day@gmail.com</span>
                                    </td>
                                    <td><span>LA-0233</span></td>
                                    <td><span>+ 264-625-2583</span></td>
                                    <td>13 Nov, 2016</td>
                                    <td>IOS Developer</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7 </td>
                                    <td>
                                        <h6 class="mb-0">Marshall Nichols</h6>
                                        <span>marshall-n@gmail.com</span>
                                    </td>
                                    <td><span>LA-0215</span></td>
                                    <td><span>+ 264-625-2583</span></td>
                                    <td>24 Jun, 2015</td>
                                    <td>Web Designer</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>
                                        <h6 class="mb-0">Jane Hunt</h6>
                                        <span>jane-hunt@gmail.com</span>
                                    </td>
                                    <td><span>LA-0232</span></td>
                                    <td><span>+ 264-625-2583</span></td>
                                    <td>08 Mar, 2016</td>
                                    <td>Android Developer</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" data-type="confirm" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Add model  Size -->
<div class="modal fade" id="addEmployee" aria-labelledby="addEmployee" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Add Contact</h5>
            </div>
            <div class="modal-body">
                <div class="row g-2">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Email ID">
                    </div>
                    <div class="col-12">
                        <input type="number" class="form-control" placeholder="Phone Number">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Employee ID">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Join Date">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Role">
                    </div>
                    <div class="col-12">
                        <input type="file" class="form-control-file" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted d-block">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
                        <hr>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Facebook">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Twitter">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Linkedin">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="instagram">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
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
                    <form action="{{route('admin.DeleteData')}}" method="post" enctype="multipart/form-data">
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

<script>
    $(document).ready(function() {
        $('#employee_List')
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

        $('#same_as_residential').on('change', function() {
            if ($(this).is(':checked')) {
                $('#permanent_country_id').val($('#country_id').val()).trigger('change');
                $('#permanent_state_id').val($('#state_id').val()).trigger('change');
                $('#permanent_city_id').val($('#city_id').val()).trigger('change');
                $('#permanent_pincode').val($('#pincode').val());
                $('#permanent_address').val($('#residential_address').val());
            } else {
                $('#permanent_country_id').val('').trigger('change');
                $('#permanent_state_id').val('').trigger('change');
                $('#permanent_city_id').val('').trigger('change');
                $('#permanent_pincode').val('');
                $('#permanent_address').val('');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.select1').select2();
    });
    $(document).ready(function() {
        $('.select3').select2();
        $('.select4').select2();
    });
</script>
<!---Get State Data ---->
<script type="text/javascript">
    $(document).ready(function() {
        $('#country_id').change(function() {
            var countryId = $(this).val();
            loadStates(countryId, null); // Load states with the selected country ID
        });

        function loadStates(countryId, selectedStateId) {
            if (countryId) {
                $.ajax({
                    url: '{{ route("admin.getStates") }}',
                    type: 'GET',
                    data: { country_id: countryId },
                    success: function(data) {
                        $('#state_id').empty();
                        $('#state_id').append('<option value="">Choose State Name</option>');
                        $.each(data, function(key, value) {
                            $('#state_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#state_id').empty();
                $('#state_id').append('<option value="">First Choose Country Name</option>');
            }
        }
    });
</script>

<!---Get City Data ---->
<script type="text/javascript">
    $(document).ready(function() {
        var stateId = $('#state_id').val();
        var cityId = "{{ !empty($editemployee->city_id) ? $editemployee->city_id : '' }}";

        if (stateId) {
            loadCities(stateId, cityId);
        }

        $('#state_id').change(function() {
            var stateId = $(this).val();
            loadCities(stateId, null);
        });

        function loadCities(stateId, selectedCityId) {
            if (stateId) {
                $.ajax({
                    url: '{{ route("admin.getCities") }}',
                    type: 'GET',
                    data: {
                        state_id: stateId
                    },
                    success: function(data) {
                        $('#city_id').empty();
                        $('#city_id').append('<option value="">Choose City Name</option>');
                        $.each(data, function(key, value) {
                            $('#city_id').append('<option value="' + key + '"' + (selectedCityId == key ? ' selected' : '') + '>' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#city_id').empty();
                $('#city_id').append('<option value="">First Choose State Name</option>');
            }
        }
    });
</script>
<!---Get Permanent State Data ---->
<script type="text/javascript">
    $(document).ready(function() {
        var countryId = $('#permanent_country_id').val();
        var stateId = "{{ !empty($editemployee->permanent_state_id) ? $editemployee->permanent_state_id : '' }}";

        if (countryId) {
            loadCities(countryId, stateId);
        }

        $('#country_id').change(function() {
            var countryId = $(this).val();
            loadCities(countryId, null);
        });

        function loadCities(countryId, selectedStateId) {
            if (countryId) {
                $.ajax({
                    url: '{{ route("admin.getStates") }}',
                    type: 'GET',
                    data: {
                        country_id: countryId
                    },
                    success: function(data) {
                        $('#permanent_state_id').empty();
                        $('#permanent_state_id').append('<option value="">Choose State Name</option>');
                        $.each(data, function(key, value) {
                            $('#permanent_state_id').append('<option value="' + key + '"' + (selectedStateId == key ? ' selected' : '') + '>' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#permanent_state_id').empty();
                $('#permanent_state_id').append('<option value="">First Choose Country Name</option>');
            }
        }
    });
</script>
<!---Get Permanent City Data ---->
<script type="text/javascript">
    $(document).ready(function() {
        var stateId = $('#state_id').val();
        var cityId = "{{ !empty($editemployee->city_id) ? $editemployee->city_id : '' }}";

        if (stateId) {
            loadCities(stateId, cityId);
        }

        $('#state_id').change(function() {
            var stateId = $(this).val();
            loadCities(stateId, null);
        });

        function loadCities(stateId, selectedCityId) {
            if (stateId) {
                $.ajax({
                    url: '{{ route("admin.getCities") }}',
                    type: 'GET',
                    data: {
                        state_id: stateId
                    },
                    success: function(data) {
                        $('#permanent_city_id').empty();
                        $('#permanent_city_id').append('<option value="">Choose City Name</option>');
                        $.each(data, function(key, value) {
                            $('#permanent_city_id').append('<option value="' + key + '"' + (selectedCityId == key ? ' selected' : '') + '>' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#permanent_city_id').empty();
                $('#permanent_city_id').append('<option value="">First Choose State Name</option>');
            }
        }
    });
</script>
<!---Get Department Data ---->
<script type="text/javascript">
    $(document).ready(function() {
        var companyId = $('#company_id').val();
        var departmentId = "{{ !empty($editdesignation->department_id) ? $editdesignation->department_id : '' }}";

        if (companyId) {
            loadDepartments(companyId, departmentId);
        }

        $('#company_id').change(function() {
            var companyId = $(this).val();
            loadDepartments(companyId, null);
        });

        function loadDepartments(companyId, selectedDepartmentId) {
            if (companyId) {
                $.ajax({
                    url: '{{ route("admin.getDepartments") }}',
                    type: 'GET',
                    data: {
                        company_id: companyId
                    },
                    success: function(data) {
                        $('#department_id').empty();
                        $('#department_id').append('<option value="">Choose Department Name</option>');
                        $.each(data, function(key, value) {
                            $('#department_id').append('<option value="' + key + '"' + (selectedDepartmentId == key ? ' selected' : '') + '>' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#department_id').empty();
                $('#department_id').append('<option value="">First Choose Company Name</option>');
            }
        }
    });
</script>
<!---Get Designation Data ---->
<script type="text/javascript">
    $(document).ready(function() {
        var departmentId = $('#department_id').val();
        var designationId = "{{ !empty($editdesignation->designation_id) ? $editdesignation->designation_id : '' }}";

        if (departmentId) {
            loadDepartments(departmentId, designationId);
        }

        $('#department_id').change(function() {
            var departmentId = $(this).val();
            loadDepartments(departmentId, null);
        });

        function loadDepartments(departmentId, selectedDesignationId) {
            if (departmentId) {
                $.ajax({
                    url: '{{ route("admin.getDepartments") }}',
                    type: 'GET',
                    data: {
                        department_id: departmentId
                    },
                    success: function(data) {
                        $('#designation_id').empty();
                        $('#designation_id').append('<option value="">Choose Designation Name</option>');
                        $.each(data, function(key, value) {
                            $('#designation_id').append('<option value="' + key + '"' + (selectedDesignationId == key ? ' selected' : '') + '>' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#designation_id').empty();
                $('#designation_id').append('<option value="">First Choose Department Name</option>');
            }
        }
    });
</script>

@endsection

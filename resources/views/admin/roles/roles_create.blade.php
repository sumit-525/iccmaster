@extends('admin.layout.master')
@section('content')
    <div class="page-heading d-flex flex-wrap justify-content-between align-items-center mt-4 gap-2 px-3">
        <h5 class="d-flex align-items-center mb-0 fw-semibold">{{ $create_or_edit }} {{ __('Role') }}</h5>
    </div>
    <div class="page-content px-3">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col">
                <div class="card rounded-8px border-custom p-3 shadow-custom mb-0 cursor-pointer">
                    <section class="row gx-0 m-0">
                        <div class="col-md-12 col-12 p-md-2 ps-md-0">
                            <div class="row m-0">
                                <form method="post" action="{{ route('admin.roles.store', $role->id) }}"
                                    class="form form-vertical yohrm-ajax-form" data-modal-form="#yohrm-modal">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="role-name">{{ __('Enter Role Name') }}*</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="role-name" class="form-control" name="role"
                                                    placeholder="Enter Role Name" value="{{ $role->name }}">
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="fw-semibold my-4">{{ __('Role Permissions') }}</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="email-horizontal">{{ __('Administrator Access') }}</label>
                                            </div>

                                            <div class="col-md-8 form-group">
                                                <div class="form-check">
                                                    <div class="checkbox1">
                                                        <input type="checkbox" id="selectAll" class="form-check-input"
                                                            @if (!empty($rolePermissions) && count($rolePermissions) == $permissions_count) checked @endif>
                                                        <label for="selectAll">{{ __('Select All') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @php $parentIndex = 0; @endphp

@foreach ($permission as $key => $permissions)
    @if ($parentIndex >= 1) <!-- Skip first two -->
        <div class="col-md-4">
            <label for="email-horizontal">
                {{ $key }}
            </label>
        </div>

        <div class="col-md-8 form-group">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                @foreach ($permissions as $key => $per_name)
                    <div class="form-check">
                        <div class="checkbox1">
                            <input type="checkbox" id="del-btn-hiring"
                                name="permission[]" value="{{ $per_name['name'] }}"
                                class="form-check-input selectAll-inner"
                                @checked(in_array($per_name['id'], $rolePermissions))>

                            <label for="del-btn-hiring">
                                @php
                                    $name = explode('-', $per_name['name']);
                                @endphp

                                {{ str_replace('_', ' ', end($name)) }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @php $parentIndex++; @endphp
@endforeach

                                            <div class="col-12 d-flex justify-content-end gap-3">
                                                <button type="submit"
                                                    class="btn btn-primary me-1 mb-1">{{ __('Submit') }}</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">{{ __('Reset') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection

@extends('admin.layout.master')
@section('content')
    <div class="page-heading d-flex flex-wrap justify-content-between align-items-center mt-4 gap-2 px-3">
        <h5 class="d-flex align-items-center mb-0 fw-semibold">{{ __('Roles & Permissions') }}</h5>
        @can('setting-add')
            <a href="{{ route('admin.roles.create') }}"
                class="btn btn-primary d-flex text-nowrap align-items-center w-fc gap-2">{{ __('Add Role Permission') }}<span><i
                        class="bi bi-plus-lg"></i></span></a>
        @endcan
    </div>
    <div class="page-content px-3">
        <section class="row gx-0 m-0">
            <div class="col-md-12 col-12 p-md-2 ps-md-0">
                <div class="row gx-0">
                    @foreach ($roles as $role)
                        <div class="col-md-4 col-lg-3 col-12 p-2 mb-3">
                            <div class="card border-custom shadow-custom mb-0">
                                <div class="p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">
                                            <a href="#"
                                                class="text-decoration-none text-color hover-effect">{{ ucwords($role->name) }}</a>
                                        </h6>
                                        @can('setting-edit')
                                            <a href="{{ route('admin.roles.create', $role->id) }}">
                                                <span>
                                                    <div
                                                        class="box-24 bg-theme-gray rounded-circle d-flex justify-content-center align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 16 16" fill="none">
                                                            <path opacity="0.3"
                                                                d="M14.267 5.56942L12.8276 7.00806L8.99031 3.17073L10.429 1.73136C10.6835 1.47688 11.0287 1.33398 11.3886 1.33398C11.7486 1.33398 12.0938 1.47688 12.3483 1.73136L14.267 3.65006C14.5214 3.9046 14.6644 4.24976 14.6644 4.6097C14.6644 4.96963 14.5214 5.31488 14.267 5.56942ZM2.4583 14.6221L6.59163 13.2441L2.7543 9.40673L1.3763 13.5401C1.32574 13.691 1.31833 13.8532 1.3549 14.0081C1.39147 14.1631 1.47057 14.3048 1.5833 14.4173C1.69603 14.5297 1.83791 14.6084 1.99297 14.6446C2.14803 14.6808 2.31011 14.673 2.46097 14.6221H2.4583Z"
                                                                fill="#2C2E33"></path>
                                                            <path
                                                                d="M3.7169 14.2006L2.46224 14.6193C2.31151 14.6694 2.1498 14.6767 1.9952 14.6402C1.8406 14.6037 1.6992 14.5249 1.58684 14.4126C1.47448 14.3003 1.39558 14.159 1.35898 14.0044C1.32237 13.8498 1.3295 13.6881 1.37956 13.5374L1.79824 12.282L3.7169 14.2006ZM2.75756 9.40398L6.5949 13.2413L12.8309 7.00532L8.99357 3.16797L2.75756 9.40398Z"
                                                                fill="#2C2E33"></path>
                                                        </svg>
                                                    </div>
                                                </span>
                                            </a>
                                        @endcan
                                    </div>
                                    {{-- <div class="d-flex justify-content-end align-items-center mt-4">
                                        <a href="{{ route('admin.roles.add_member', $role->id) }}"
                                            class="candidate-btn d-flex align-items-center rounded-5px w-fc gap-2 p-2 px-3 mt-2"
                                            data-bs-toggle="modal" data-bs-target="#yohrm-modal"
                                            data-bs-whatever="Add Member">{{__('Add Member')}}
                                            <span><i class="bi bi-plus-lg"></i></span>
                                        </a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection

@extends('admin.layout.master')
@section('content')
<style>
    .file_manager .file .hover {

        top: 18px;
    }

    .float-end {
        float: right !important;
    }
</style>
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img
                src="https://greenurjaandenergyefficiencyawards.indianchamber.org/wp-content/themes/icc_green_urja/icc_green_urja/assets/images/logo.svg"
                width="200" height="200" alt="Iconic"></div>
        <p>Please wait...</p>
    </div>
</div>
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Dashboard</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>

        </div>
    </div>

    <!--Add / Edit Form -->
    <div class="row clearfix">
        @can('documentcategory-view')
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="header pb-2">

                    <h2><b>Document Category</b></h2>

                </div>
                <div class="body demo-card pb-0">

                    <div class="row file_manager">
                        @foreach ($categories as $category)
                        @php
                        $encryptedId = encrypt($category->id);
                        @endphp
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="file">
                                    <a href="javascript:void(0);"
                                        class="d-flex justify-content-center align-items-center">
                                        <div class="hover ">
                                            <a href="{{ route('admin.document', ['category_id' => $encryptedId]) }} "
                                                class="btn btn-icon btn-info text-white btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>


                                        </div>
                                        <a href="{{ route('admin.document', ['category_id' => $encryptedId]) }} "
                                            class="folder">
                                            <h6 data-toggle="tooltip" data-placement="top"
                                                title="{{ $category->name }}"><i
                                                    class="fa fa-folder m-r-10"></i>{!! Str::limit(strip_tags($category->name), 12) !!}</h6>
                                        </a>

                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endcan
        @can('news-view')
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="header pb-2">

                    <h2><b>Real Time Business News</b></h2>

                </div>
                <div class="body demo-card">
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-unstyled feeds_widget">
                                @foreach ($allnews as $news)
                                @php
                                $encryptedId = encrypt($news->id);
                                $formattedDate = \Carbon\Carbon::parse($news->created_at)->format('M d, Y'); // Format the date

                                @endphp
                                <a href="{{ route('admin.newsfulldetails', ['id' => $news->id]) }} ">
                                    <li class="d-flex">
                                        <div class="feeds-left"><i class="fa fa-newspaper-o text-danger"></i></div>


                                        <div class="feeds-body flex-grow-1">
                                            <h6 class="mb-1 text-danger">{!! Str::limit(strip_tags($news->title), 42) !!} &emsp; <small
                                                    class="float-end text-muted small"> {{ $formattedDate }}</small></h6>
                                        </div>

                                    </li>
                                </a>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endcan
    </div>
    <div class="row clearfix">
        @can('portwise-view')
        <div class="col-md-3 col-sm-12">
            <a href="{{ route('admin.portwiseexportdata')}} ">
            <div class="card">
                <div class="header pb-2">

                    <h2><b>Portwise Data</b></h2>

                </div>
                <div class="body demo-card">
                    <div class="currency_state d-flex">
                        <div><img src="{{ asset('assets/images/excel.svg') }}" width="40"></div>
                        <div class="ml-3">
                            <div class="name">Excel Data</div>
                            <h5 class="mb-0">{{ $portwisedata }}</h5>

                        </div>
                    </div>

                </div>
            </div>
            </a>
        </div>
        @endcan
        @can('tendercategory-view')
        <div class="col-md-9 col-sm-12">
            <div class="card">
                <div class="header pb-0">

                    <h2><b>Tender Category</b></h2>

                </div>
                <div class="body demo-card py-0">

                    <div class="row file_manager">
                        @foreach ($tendercategories as $tendercategory)
                        @php
                        $encryptedId = encrypt($tendercategory->id);
                        @endphp
                        <div class="col-md-4 col-sm-12">
                            <div class="card my-3">
                                <div class="file">
                                    <a href="javascript:void(0);"
                                        class="d-flex justify-content-center align-items-center">
                                        <div class="hover ">
                                            <a href="{{ route('admin.tender', ['tendercategory_id' => $tendercategory->id]) }} "
                                                class="btn btn-icon btn-info text-white btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>


                                        </div>
                                        <a href="{{ route('admin.tender', ['tendercategory_id' => $tendercategory->id]) }} "
                                            class="folder">
                                            <h6 data-toggle="tooltip" data-placement="top"
                                                title="{{ $tendercategory->name }}"><i
                                                    class="fa fa-folder m-r-10"></i>{!! Str::limit(strip_tags($tendercategory->name), 15) !!}</h6>
                                        </a>

                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        @endcan

    </div>

</div>

@endsection()
@section('externaljs')
<script src="{{ asset('assets/js/index7.js') }}"></script>

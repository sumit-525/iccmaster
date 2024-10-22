@extends('admin.layout.master')
@section('content')


    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>News Details</h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action">
                            <a href="{{ route('admin.newsdetails')}}" type="button" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-1"></div>
            <div class="col-lg-10 col-md-12 px-5">
                <div class="card single_post">
                    <div class="body">
                        <div class="img-post">
                            <img class="d-block img-fluid" src="{{ asset('storage/'.$newsdetails->image) }}" alt="First slide" height="400" width="100%">
                        </div>
                       <!-- Display the YouTube video in an iframe if link is provided -->

                        <h3 class="py-3"><div class="row">
                            <div class="col-md-5 col-sm-12">
                                <span><a href="javascript:void(0)">{{ $newsdetails->title }}</a></span>
                            </div>
                            <div class="col-md-7 col-sm-12">
                        <span class="float-right font-16 text-dark">Start Date <i class="fa fa-calendar font-12"></i>: {{ $newsdetails->startdate }} &nbsp; End Date <i class="fa fa-calendar font-12"></i>: {{ $newsdetails->enddate }}  </span>
                            </div>
                        </div></h3>
                        @if(!empty($newsdetails->link))
                        <iframe width="100%" height="400" src="{{ $newsdetails->link }}" frameborder="0" allowfullscreen></iframe>
                    @endif
                        <p> {!! $newsdetails->description !!} </p>
                    </div>
                </div>

            </div>
            <div class="col-lg-1"></div>
        </div>

    </div>

@endsection

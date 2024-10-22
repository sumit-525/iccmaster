<?php

use Illuminate\Support\Facades\Route;

$currentRoute = Route::currentRouteName();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Icc Admin">
    <meta name="author" content="ICC">
    <title>{{ !empty($title) ? $title : 'ICC ADMIN ' }} | Indian Chamber of Commerce</title>
    <link rel="icon" href="{{ asset('assets/dist/favicon-32x32.png') }}" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/jvectormap/jquery-jvectormap-2.0.3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts-c3/plugin.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/dist/summernote.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/multi-select/css/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Include CSRF token meta tag -->
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <style>
        .profile-image img {
            width: 140px !important;
            height: 130px;
        }

        .fs-xsm {
            font-size: 0.75rem;
            /* Extra small font size */
        }

        .fs-sm {
            font-size: 0.875rem;
            /* Small font size */
        }

        .fs-md {
            font-size: 1rem;
            /* Medium font size (default) */
        }

        .fs-lg {
            font-size: 1.25rem;
            /* Large font size */
        }

        .fs-xl {
            font-size: 1.5rem;
            /* Extra large font size */
        }

        .file_manager .file {
            position: relative;
            /* Ensure the file element is positioned relative for the hover to be absolute */
        }

        .file_manager .file:hover .hover {
            display: block;
            /* Display the hover element when hovering over the file element */
        }

        .file_manager .file .hover {
            position: absolute;
            right: 10px;
            top: 10px;
            display: none;
            transition: all 0.3s ease-in-out;
            /* Ensure transition works smoothly */
        }


        .table tr th {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #fff;
            text-transform: uppercase;
            font-size: 12px;
            border-width: 0 0 0 1px;
        }

        .filter-row th {
            border-color: #fff;
            background-color: unset !important;
            color: #fff;
            text-transform: uppercase;
            font-size: 12px;
            border-width: 0 0 0 1px;
            padding: 0;
        }

        .btn-check:checked+.btn,
        :not(.btn-check)+.btn:active,
        .btn:first-child:active,
        .btn.active,
        .btn.show {
            color: var(--bs-btn-active-color);
            background-color: var(--bs-btn-active-bg);
            border-color: #fff;
        }

        .bg-success-subtle {
            background-color: #d2f1e8 !important;
        }

        .text-success {
            --bs-text-opacity: 1;
            color: rgba(28, 187, 140, 1) !important;
        }

        .bg-danger-subtle {
            background-color: #f8d7da !important;
        }

        .text-danger {
            --bs-text-opacity: 1;
            color: rgba(220, 53, 69, 1) !important;
        }

        .badge {
            font-weight: 400;
            font-size: 12px !important;
        }

        #cke_1_contents {
            height: 120px !important;
        }

        .dropdown-menu {
            /* left: -20px !important; */
            min-width: 12rem;
        }

        .user-account .dropdown .dropdown-menu a {

            color: #fff;
        }

        .dropdown-item.active,
        .dropdown-item:active {
            background-color: #f8f9fa;
        }
        .note-editable{
            height: 150px !important;
        }
        .page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: var(--primary-color) !important;
    border-color: var(--primary-color) !important;
}
    </style>
</head>

<body data-theme="light" class="font-nunito">

    <div id="wrapper" class="theme-cyan">



        <!-- Top navbar div start -->
        <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-bars"></i></button>
                    <button type="button" class="btn-toggle-fullwidth"><i class="fa fa-bars"></i></button>
                    <a href="{{ route('admin.dashboard') }}">ICC Admin</a>
                </div>

                <div class="navbar-right">
                    <!--<form id="navbar-search" class="navbar-form search-form">-->
                    <!--    <input value="" class="form-control" placeholder="Search here..." type="text">-->
                    <!--    <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>-->
                    <!--</form>-->

                    <div id="navbar-menu">
                        <ul class="nav navbar-nav">

                            <li>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#smallModal"
                                    class="icon-menu"><i class="fa fa-power-off"></i></a>

                                </a>
                            </li>

                        </ul>
                    </div>

                </div>

            </div>
        </nav>
        <!-- Small Size -->
        <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h4 class="title mb-0" id="smallModalLabel">Logout {{ config('app.name') }}</h4>
                    </div>
                    <div class="modal-body"> Would you like to logout? </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-primary text-white" data-dismiss="modal">NO</a>
                        <a type="button" class="btn btn-danger" href="{{ route('admin.logout') }}">Yes</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- main left menu -->
        <div id="left-sidebar" class="sidebar">
            <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-arrow-left"></i></button>
            <div class="sidebar-scroll">
                <div class="user-account">

                    <img src="https://greenurjaandenergyefficiencyawards.indianchamber.org/wp-content/uploads/2022/09/cropped-favicon-180x180.png"
                        class="rounded-circle user-photo" alt="User Profile Picture">
                    <div class="dropdown">
                        <span>Welcome,</span>
                        <a href="javascript:void(0);" class="dropdown-toggle user-name"
                            data-toggle="dropdown"><strong>{{ auth()->user()->name }}</strong></a>
                        <ul class="dropdown-menu dropdown-menu-right account">
                            <li><a href="{{ route('admin.adminprofile') }}"><i class="icon-user"></i>My Profile</a>
                            </li>
                            <li><a href="{{ route('admin.changePassword') }}"><i class="icon-settings"></i>Change
                                    Password</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:void(0);" data-toggle="modal" data-target="#smallModal"><i
                                        class="icon-power"></i>Logout</a></li>

                        </ul>
                    </div>
                </div>
                <!-- Tab panes -->
                <div class="tab-content padding-0">
                    <div class="tab-pane active" id="menu">
                        <nav id="left-sidebar-nav" class="sidebar-nav">
                            <ul id="main-menu" class="metismenu li_animation_delay">
                                <li class="{{ $currentRoute == 'dashboard' ? 'active' : '' }}">
                                    <a href="{{ route('dashboard') }}" class=""><i
                                            class="fa fa-dashboard"></i><span>Dashboard</span></a>

                                </li>
                                @role('admin')
                                    <li class="{{ $currentRoute == 'admin.role' ? 'active' : '' }}">
                                        <a href="{{ route('admin.roles.index') }}" class=""><i
                                                class="fa fa-building-o"></i><span>Role & Permission</span></a>
                                    </li>
                                    <li class="{{ $currentRoute == 'admin.staff' ? 'active' : '' }}">
                                        <a href="{{ route('admin.staff') }}" class=""><i
                                                class="icon-users"></i><span>&emsp;Manage Staff</span></a>

                                    </li>
                                @endrole
                                @canany(['documentcategory-view', 'document-view'])
                                    <li
                                        class="{{ in_array($currentRoute, ['admin.category', 'admin.document']) ? 'active' : '' }}">
                                        <a href="#DocumentSection" class="has-arrow"><i
                                                class="fa fa-file-text-o"></i><span>Manage Document</span></a>
                                        <ul aria-expanded="true"
                                            class="{{ in_array($currentRoute, ['admin.category', 'admin.document']) ? 'collapse in' : '' }}">
                                            @can('documentcategory-view')
                                                <li class="{{ $currentRoute == 'admin.category' ? 'active' : '' }}">
                                                    <a href="{{ route('admin.category') }}">Document Category</a>
                                                </li>
                                            @endcan
                                            @can('document-view')
                                                <li class="{{ $currentRoute == 'admin.document' ? 'active' : '' }}">
                                                    <a href="{{ route('admin.document') }}">Document Details</a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcanany
                                @canany(['newscategory-view', 'news-view'])
                                    <li
                                        class="{{ in_array($currentRoute, ['admin.newscategory', 'admin.newsdetails']) ? 'active' : '' }}">
                                        <a href="#NewsSection" class="has-arrow"><i
                                                class="fa fa-newspaper-o"></i><span>News</span></a>
                                        <ul aria-expanded="true"
                                            class="{{ in_array($currentRoute, ['admin.newscategory', 'admin.newsdetails']) ? 'collapse in' : '' }}">
                                            @can('newscategory-view')
                                                <li class="{{ $currentRoute == 'admin.newscategory' ? 'active' : '' }}">
                                                    <a href="{{ route('admin.newscategory') }}">News Category</a>
                                                </li>
                                            @endcan
                                            @can('news-view')
                                                <li class="{{ $currentRoute == 'admin.newsdetails' ? 'active' : '' }}">
                                                    <a href="{{ route('admin.newsdetails') }}">News Details</a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcanany
                                @canany(['tendercategory-view', 'tender-view'])
                                    <li
                                        class="{{ in_array($currentRoute, ['admin.tendercategory', 'admin.tender']) ? 'active' : '' }}">
                                        <a href="#TenderDocumentSection" class="has-arrow"><i
                                                class="fa fa-tasks"></i><span>Manage Tender</span></a>
                                        <ul aria-expanded="true"
                                            class="{{ in_array($currentRoute, ['admin.tendercategory', 'admin.tender']) ? 'collapse in' : '' }}">
                                            @can('tendercategory-view')
                                                <li class="{{ $currentRoute == 'admin.tendercategory' ? 'active' : '' }}">
                                                    <a href="{{ route('admin.tendercategory') }}">Tender Category</a>
                                                </li>
                                            @endcan
                                            @can('tender-view')
                                                <li class="{{ $currentRoute == 'admin.tender' ? 'active' : '' }}">
                                                    <a href="{{ route('admin.tender') }}">Tender Details</a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcanany
                                @can('portwise-view')
                                <li class="{{ $currentRoute == 'admin.portwiseexportdata' ? 'active' : '' }}">
                                    <a href="{{ route('admin.portwiseexportdata') }}" class=""><i
                                            class="fa fa-file-excel-o"></i><span>Portwise Export Data</span></a>

                                </li>
                                @endcan

                            </ul>
                        </nav>
                    </div>
                    <div class="tab-pane" id="Chat">
                        <!--<form>-->
                        <!--    <div class="input-group m-b-20">-->
                        <!--        <div class="input-group-prepend">-->
                        <!--            <span class="input-group-text"><i class="icon-magnifier"></i></span>-->
                        <!--        </div>-->
                        <!--        <input type="text" class="form-control" placeholder="Search...">-->
                        <!--    </div>-->
                        <!--</form>-->
                        <ul class="right_chat list-unstyled li_animation_delay">
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="{{ asset('assets//images/xs/avatar1.jpg') }}"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name d-flex justify-content-between">Chris Fox <i
                                                class="fa fa-heart-o font-12"></i></span>
                                        <span class="message">chrisfox@gmail.com</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="{{ asset('assets//images/xs/avatar2.jpg') }}"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name d-flex justify-content-between">Joge Lucky <i
                                                class="fa fa-heart-o font-12"></i></span>
                                        <span class="message">Jogelucky@gmail.com</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="{{ asset('assets//images/xs/avatar3.jpg') }}"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name d-flex justify-content-between">Isabella <i
                                                class="fa fa-heart-o font-12"></i></span>
                                        <span class="message">Isabella@gmail.com</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="{{ asset('assets//images/xs/avatar4.jpg') }}"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name d-flex justify-content-between">Folisise Chosielie <i
                                                class="fa fa-heart font-12"></i></span>
                                        <span class="message">FolisiseChosielie@gmail.com</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="{{ asset('assets//images/xs/avatar5.jpg') }}"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name d-flex justify-content-between">Alexander <i
                                                class="fa fa-heart-o font-12"></i></span>
                                        <span class="message">Alexander@gmail.com</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="setting">
                        <h6>Choose Skin</h6>
                        <ul class="choose-skin list-unstyled">
                            <li data-theme="purple">
                                <div class="purple"></div>
                            </li>
                            <li data-theme="blue">
                                <div class="blue"></div>
                            </li>
                            <li data-theme="cyan" class="active">
                                <div class="cyan"></div>
                            </li>
                            <li data-theme="green">
                                <div class="green"></div>
                            </li>
                            <li data-theme="orange">
                                <div class="orange"></div>
                            </li>
                            <li data-theme="blush">
                                <div class="blush"></div>
                            </li>
                            <li data-theme="red">
                                <div class="red"></div>
                            </li>
                        </ul>

                        <ul class="list-unstyled font_setting mt-3">
                            <li>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="font"
                                        value="font-nunito" checked="">
                                    <span class="custom-control-label">Nunito Google Font</span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="font"
                                        value="font-ubuntu">
                                    <span class="custom-control-label">Ubuntu Font</span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="font"
                                        value="font-raleway">
                                    <span class="custom-control-label">Raleway Google Font</span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="font"
                                        value="font-IBMplex">
                                    <span class="custom-control-label">IBM Plex Google Font</span>
                                </label>
                            </li>
                        </ul>

                        <ul class="list-unstyled mt-3">
                            <li class="d-flex align-items-center mb-2">
                                <label class="toggle-switch theme-switch">
                                    <input type="checkbox">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                                <span class="ml-3">Enable Dark Mode!</span>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <label class="toggle-switch theme-rtl">
                                    <input type="checkbox">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                                <span class="ml-3">Enable RTL Mode!</span>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <label class="toggle-switch theme-high-contrast">
                                    <input type="checkbox">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                                <span class="ml-3">Enable High Contrast Mode!</span>
                            </li>
                        </ul>

                        <hr>
                        <h6>General Settings</h6>
                        <ul class="setting-list list-unstyled">
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="checkbox" checked>
                                    <span>Allowed Notifications</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="checkbox">
                                    <span>Offline</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="checkbox">
                                    <span>Location Permission</span>
                                </label>
                            </li>
                        </ul>

                        <a href="#" target="_blank" class="btn btn-block btn-primary">Buy this item</a>
                        <a href="https://themeforest.net/user/wrraptheme/portfolio" target="_blank"
                            class="btn btn-block btn-secondary">View portfolio</a>
                    </div>
                    <div class="tab-pane" id="question">
                        <!--<form>-->
                        <!--    <div class="input-group">-->
                        <!--        <div class="input-group-prepend">-->
                        <!--            <span class="input-group-text"><i class="icon-magnifier"></i></span>-->
                        <!--        </div>-->
                        <!--        <input type="text" class="form-control" placeholder="Search...">-->
                        <!--    </div>-->
                        <!--</form>-->
                        <ul class="list-unstyled question">
                            <li class="menu-heading">HOW-TO</li>
                            <li><a href="javascript:void(0);">How to Create Campaign</a></li>
                            <li><a href="javascript:void(0);">Boost Your Sales</a></li>
                            <li><a href="javascript:void(0);">Website Analytics</a></li>
                            <li class="menu-heading">ACCOUNT</li>
                            <li><a href="javascript:void(0);">Cearet New Account</a></li>
                            <li><a href="javascript:void(0);">Change Password?</a></li>
                            <li><a href="javascript:void(0);">Privacy &amp; Policy</a></li>
                            <li class="menu-heading">BILLING</li>
                            <li><a href="javascript:void(0);">Payment info</a></li>
                            <li><a href="javascript:void(0);">Auto-Renewal</a></li>
                            <li class="menu-button mt-3">
                                <a href="../docs/index.html" class="btn btn-primary btn-block">Documentation</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <!-- mani page content body part -->
        <div id="main-content">

            @yield('content')

        </div>

    </div>

    <!-- Javascript -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>

    <script src="{{ asset('assets/bundles/jvectormap.bundle.js') }}"></script> <!-- JVectorMap Plugin Js -->
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>


    <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>

    <script src="{{ asset('assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script> <!-- Bootstrap Colorpicker Js -->
    <script src="{{ asset('assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script> <!-- Input Mask Plugin Js -->
    <script src="{{ asset('assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script> <!-- Multi Select Plugin Js -->
    <script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script> <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{{ asset('assets/vendor/nouislider/nouislider.js') }}"></script> <!-- noUISlider Plugin Js -->
    <script src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ asset('assets/vendor/summernote/dist/summernote.js') }}"></script>

<script>
    jQuery(document).ready(function() {

        $('.summernote').summernote({
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false, // set focus to editable area after initializing summernote
            popover: { image: [], link: [], air: [] }
        });

        $('.inline-editor').summernote({
            airMode: true
        });

    });

    window.edit = function() {
            $(".click2edit").summernote()
        },
        
    window.save = function() {
        $(".click2edit").summernote('destroy');
    }
</script>
    <script src="{{ asset('assets/vendor/toastr/toastr.js') }}"></script>
    <!-- page js file -->
    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>

    <script src="{{ asset('assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/editors.js') }}"></script>

    <script src="{{ asset('assets/js/pages/file/filemanager.js') }}"></script>

    <script src="{{ asset('assets/vendor/LightboxGallery/mauGallery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/LightboxGallery/scripts.js') }}"></script>

    <!-- Dropify Js -->
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify({
                showErrors: true,
                errorTimeout: 3000,
                errorsPosition: 'overlay',
                // Include WEBP in allowed extensions
                imgFileExtensions: ['png', 'jpg', 'jpeg', 'gif', 'bmp', 'webp', 'mp4'],
                maxFileSizePreview: "5M",
                allowedFormats: ['portrait', 'square', 'landscape'],
                allowedFileExtensions: ['*'],
            });
            var drEvent = $("#dropify-event").dropify();
            drEvent.on("dropify.beforeClear", function(event, element) {
                return confirm(
                    'Do you really want to delete "' + element.file.name + '" ?'
                );
            });

            drEvent.on("dropify.afterClear", function(event, element) {
                alert("File deleted");
            });

            $(".dropify-fr").dropify({
                messages: {
                    default: "Glissez-dÃ©posez un fichier ici ou cliquez",
                    replace: "Glissez-dÃ©posez un fichier ou cliquez pour remplacer",
                    remove: "Supprimer",
                    error: "DÃ©solÃ©, le fichier trop volumineux",
                },
            });
        });
    </script>

    <!-- Ajax Request -->
    <script>
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
    </script>
    <!-- jQuery UI Sortable -->
    {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
    <!---Make the table rows sortable -->

    @isset($tablename)
        <script>
            $(document).ready(function() {
                // Make the table rows sortable
                $("#yajradb tbody").sortable({
                    axis: "y", // Allow dragging only vertically
                    cursor: "move", // Set cursor style to indicate draggable elements
                    update: function(event, ui) {
                        // Get the new order of the rows
                        var newOrder = $(this).sortable('toArray', {
                            attribute: 'data-id'
                        });

                        // Perform AJAX call to update the database
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        var tablename = "{{ $tablename }}";
                        $.ajax({
                            url: "{{ route('admin.updatePositions') }}",
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            data: {
                                newOrder: newOrder,
                                tablename: tablename
                            },
                            success: function(response) {
                                console.log(response);
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }
                }).disableSelection(); // Prevent text selection while dragging
            });
        </script>
    @endisset
    <!-- - Validation CDN --->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <!-- whitespace validation--->

    <script>
        $('input').keypress(function(e) {
            if (this.value.length === 0 && e.which === 32) e.preventDefault();
        });
        $('textarea').keypress(function(e) {
            if (this.value.length === 0 && e.which === 32) e.preventDefault();
        });
        $('input[name="mobile"]').on('input', function() {
            $(this).val($(this).val().replace(/\D/g, '')); // Remove non-digits
            if ($(this).val().length > 10) {
                $(this).val($(this).val().substr(0, 10)); // Limit to 10 digits
            }
        });

        $("body").on("click", "#selectAll", function() {
            if ($(this).prop("checked")) {
                $(".selectAll-inner").prop("checked", true);
            } else {
                $(".selectAll-inner").prop("checked", false);
            }
        });


        $('input[name="section"]').on('input', function() {
            $(this).val($(this).val().replace(/\D/g, '')); // Remove non-digits
            if ($(this).val().length > 10) {
                $(this).val($(this).val().substr(0, 10)); // Limit to 10 digits
            }
        });
    </script>

    <!-- toastr init -->
    <script>
        @if (Session::has('message'))
            var messageType = '{{ Session::get('status') }}';
            var message = '{{ Session::get('message') }}';

            toastr[messageType](message, '', {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
        @endif


        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}', '', {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
        @endif


        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}', '', {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
        @endif
    </script>
    <!--- Change status -->
    <script>
        function changeStatus(where_id, where_id_value, where_column, where_column_value, where_table) {

            // $('.table').html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: "{{ route('admin.changeStatus') }}", // Replace with your Laravel route
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "where_id": where_id,
                    "where_id_value": where_id_value,
                    "where_column": where_column,
                    "where_column_value": where_column_value,
                    "where_table": where_table,
                },
                success: function(data) {
                    if (data.status === 'success') {
                        // Display success message using Toastr
                        toastr.success('Update successful');

                        // Reload the page after a delay
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        // Display error message using Toastr
                        toastr.error('Error: ' + data.message);
                    }
                },
                error: function(error) {
                    // Display generic error message using Toastr
                    toastr.error('An error occurred');
                }
            });
        }
    </script>


    <!--- Delete model--->
    <script>
        function deleteData(where_column, where_id, where_table) {
            $('#delete_modal').modal('show');
            $('#delColumn').val(where_column);
            $('#delId').val(where_id);
            $('#delTable').val(where_table);
        }
    </script>
    @yield('externaljs')
</body>

</html>

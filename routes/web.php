<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\changeStatusController;
use App\Http\Controllers\deleteController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsDetailsController;
use App\Http\Controllers\PortwiseexportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TenderCaegoryController;
use App\Http\Controllers\TenderCategoryController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\UpdatePositionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AdminController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.save');
    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});



Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('auth')->group(function () {

        //Admin Section ===============================================
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/admindashboard', [AdminController::class, 'admin'])->name('admindashboard');
        Route::get('/profile', [AdminController::class, 'adminprofile'])->name('adminprofile');

        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

        Route::post('/adminprofile', [AdminController::class, 'adminprofile'])->name('updateProfileImg');

        Route::patch('/adminprofile', [AdminController::class, 'adminprofile'])->name('updateProfile');
        // change status
        Route::post('/changeStatus', [changeStatusController::class, 'changeStatus'])->name('changeStatus');



        // staff section ==============================================
        Route::get('/staff', [StaffController::class, 'index'])->name('staff')->middleware('permission:employee-view');
        Route::get('/addstaffshow', [StaffController::class, 'add'])->name('addstaffshow')->middleware('permission:employee-add');
        Route::post('/addstaff', [StaffController::class, 'save'])->name('addstaff')->middleware('permission:employee-add|employee-edit');
        Route::get('/editstaff/{id}', [StaffController::class, 'add'])->name('editstaff')->middleware('permission:employee-edit');


        // document section ==============================================
        Route::get('/document/{category_id?}', [DocumentController::class, 'index'])->name('document')->middleware('permission:document-view');
        Route::get('/adddocumentshow', [DocumentController::class, 'add'])->name('adddocumentshow')->middleware('permission:document-add');
        Route::post('/adddocument', [DocumentController::class, 'save'])->name('adddocument')->middleware('permission:document-edit|document-add');
        Route::get('/editdocument/{id}', [DocumentController::class, 'add'])->name('editdocument')->middleware('permission:document-edit');
        Route::get('/downloaddocument/{id}', [DocumentController::class, 'download'])->name('downloaddocument')->middleware('permission:document-view');



        // category section ==============================================
        Route::get('/category', [CategoryController::class, 'index'])->name('category')->middleware('permission:documentcategory-view');
        Route::get('/addcategoryshow', [CategoryController::class, 'add'])->name('addcategoryshow')->middleware('permission:documentcategory-add');
        Route::post('/addcategory', [CategoryController::class, 'save'])->name('addcategory')->middleware('permission:documentcategory-add|documentcategory-edit');
        Route::get('/editcategory/{id}', [CategoryController::class, 'add'])->name('editcategory')->middleware('permission:documentcategory-edit');
        Route::post('check-category-name', [CategoryController::class, 'checkCategoryName'])->name('checkCategoryName');
        Route::delete('/deletecategory', [CategoryController::class, 'destroy'])->name('deletecategory')->middleware('permission:documentcategory-delete');

        //news category section ==============================================
        Route::get('/newscategory', [NewsCategoryController::class, 'index'])->name('newscategory')->middleware('permission:newscategory-view');
        Route::get('/addnews', [NewsCategoryController::class, 'add'])->name('addnews')->middleware('permission:newscategory-add');
        Route::post('/addnewscategory', [NewsCategoryController::class, 'save'])->name('addnewscategory')->middleware('permission:newscategory-add|newscategory-edit');
        Route::get('/editnewscategory/{id}', [NewsCategoryController::class, 'add'])->name('editnewscategory')->middleware('permission:newscategory-edit');
        Route::post('check-newscategory-name', [NewsCategoryController::class, 'checkNewsCategoryName'])->name('checkNewsCategoryName');
        Route::delete('/deletenewscategory', [NewsCategoryController::class, 'destroy'])->name('deletenewscategory')->middleware('permission:newscategory-delete');

        // News Details section ==============================================
        Route::get('/newsdetails/{newscategory_id?}', [NewsDetailsController::class, 'index'])->name('newsdetails')->middleware('permission:news-view');
        Route::get('/addnewsshow', [NewsDetailsController::class, 'add'])->name('addnewsshow')->middleware('permission:news-add');
        Route::post('/addnewsdetails', [NewsDetailsController::class, 'save'])->name('addnewsdetails')->middleware('permission:news-add|news-edit');
        Route::get('/editnewsdetails/{id}', [NewsDetailsController::class, 'add'])->name('editnewsdetails')->middleware('permission:news-edit');
        Route::get('/newsfulldetails/{id}', [NewsDetailsController::class, 'newsfulldetails'])->name('newsfulldetails')->middleware('permission:news-view');


        //tender category section ==============================================
        Route::get('/tendercategory', [TenderCategoryController::class, 'index'])->name('tendercategory');
        Route::get('/addtendercategoryshow', [TenderCategoryController::class, 'add'])->name('addtendercategoryshow');
        Route::post('/addtendercategory', [TenderCategoryController::class, 'save'])->name('addtendercategory');
        Route::get('/edittendercategory/{id}', [TenderCategoryController::class, 'add'])->name('edittendercategory');
        Route::post('check-tendercategory-name', [TenderCategoryController::class, 'checkTenderCategoryName'])->name('checkTenderCategoryName');
        Route::delete('/deletetendercategory', [TenderCategoryController::class, 'destroy'])->name('deletetendercategory');

        // Tender Details section ==============================================
        Route::get('/tender/{tendercategory_id?}', [TenderController::class, 'index'])->name('tender');
        Route::get('/addtendershow', [TenderController::class, 'add'])->name('addtendershow');
        Route::post('/addtenderdetails', [TenderController::class, 'save'])->name('addtenderdetails');
        Route::get('/edittenderdetails/{id}', [TenderController::class, 'add'])->name('edittenderdetails');

        // portwiseexportdata section ==============================================
        Route::get('/portwiseexportdata', [PortwiseexportController::class, 'index'])->name('portwiseexportdata');
        Route::get('/addportwiseexportdatashow', [PortwiseexportController::class, 'add'])->name('addportwiseexportdatashow');
        Route::post('/addportwiseexportdata', [PortwiseexportController::class, 'store'])->name('addportwiseexportdata');
        Route::get('/editportwiseexportdata/{id}', [PortwiseexportController::class, 'add'])->name('editportwiseexportdata');
        Route::get('/export-checked', [PortwiseexportController::class, 'exportChecked'])->name('portwise.export');
        Route::get('/export-checked/download', [PortwiseexportController::class, 'export'])->name('portwise.export.download');




        // change password =================================================
        Route::get('/changePassword', [AdminController::class, 'changePasswordShow'])->name('changePassword');
        Route::put('/changePassword', [AdminController::class, 'changePassword'])->name('changePassworddata');


        // Delete Data =================================================
        Route::delete('/deleteData', [deleteController::class, 'destroy'])->name('DeleteData')->middleware('permission:newscategory-delete|news-delete|employee-delete|documentcategory-delete|document-delete|setting-delete');
        //update position ===========================================
        Route::post('/updatePositions', [UpdatePositionController::class, 'index'])->name('updatePositions')->middleware('permission:newscategory-edit|news-edit|employee-edit|documentcategory-edit|document-edit|setting-edit');;

        Route::prefix('roles-permission')->name('roles.')->group(function () {
            Route::get('/', [RolesController::class, 'index'])->name('index')->middleware('permission:setting-view');
            Route::get('members/add/{id?}', [RolesController::class, 'add_member'])->name('add_member')->middleware('permission:setting-add');
            Route::post('members/add', [RolesController::class, 'store_member'])->name('store_member')->middleware('permission:setting-add|setting-edit');
            Route::get('create/{id?}', [RolesController::class, 'create'])->name('create')->middleware('permission:setting-add|setting-edit');
            Route::post('save/{id?}', [RolesController::class, 'store'])->name('store')->middleware('permission:setting-add|setting-edit');
            Route::get('teams/datatable', [RolesController::class, 'TeamsDatatable'])->name('teams.datatable');
            Route::get('teams/{id}', [RolesController::class, 'ourTeams'])->name('role-team');
        });
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsPosts;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\AdminUser;
use App\Http\Controllers\RoleManagement;
use App\Http\Controllers\GenClass;
use App\Http\Controllers\ProcessData;
use App\Http\Middleware\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProjectsPosts::class, 'index']);
Route::get('/projects-photos', [ProjectsPosts::class, 'project_photos']);
Route::get('/projects-photos/{pn}', [ProjectsPosts::class, 'project_photos'])->where('pn', '[0-9]+');
Route::post('/projects-photos', [ProjectsPosts::class, 'project_photos']);
Route::view('/about', 'about', ['title' => 'About Us', 'page_slug'=>'about']);
Route::view('/contact', 'contact', ['title' => 'Contact Us', 'page_slug'=>'contact']);
Route::view('/services', 'services', ['title' => 'Our Services', 'page_slug'=>'services'])->name('service');

Route::middleware('guest')->group(function(){
Route::get('/register', [AuthUserController::class, 'create']);
Route::post('/register', [AuthUserController::class, 'store']);
Route::view('/login', 'login', ['title' => 'Login', 'page_slug'=>'login'])->name('login');
Route::post('/login', [AuthUserController::class, 'login']);
});

Route::get('/logout', [AuthUserController::class, 'logout']);

Route::middleware('auth')->group(function(){

///////======Admin====///////
//Route::middleware([Admin::class])->group(function(){
Route::middleware('admin')->group(function(){
	
Route::get('/' . GenClass::$admin, [AdminUser::class, 'admin_dashboard']);

Route::get('/' . GenClass::$admin . '/profile', [AdminUser::class, 'admin_profile']);
Route::post('/' . GenClass::$admin . '/profile/pics', [AdminUser::class, 'admin_profile_pics']);
Route::get('/' . GenClass::$admin . '/profile/{user}/edit', [AdminUser::class, 'admin_profile_edit']);
Route::put('/' . GenClass::$admin . '/profile/{user}', [AdminUser::class, 'admin_profile_update']);

Route::get('/' . GenClass::$admin . '/reset-password', [AdminUser::class, 'reset_password']);
Route::put('/' . GenClass::$admin . '/reset-password/{id}', [AdminUser::class, 'update_password']);

Route::match(['get', 'post'], '/' . GenClass::$admin . '/manage-projects-images', [ProjectsPosts::class, 'manage_projects_images']);
Route::match(['get', 'post'], '/' . GenClass::$admin . '/manage-projects-images/{pn}', [ProjectsPosts::class, 'manage_projects_images'])->where('pn', '[0-9]+');
Route::get('/' . GenClass::$admin . '/manage-projects-images/{pn}/view/{view}', [ProjectsPosts::class, 'manage_projects_images_view'])->where('pn', '[0-9]+')->where('view', '[0-9]+');
Route::get('/' . GenClass::$admin . '/manage-projects-images/create', [ProjectsPosts::class, 'manage_projects_images_create']);
Route::post('/' . GenClass::$admin . '/manage-projects-images/create', [ProjectsPosts::class, 'manage_projects_images_save']);
Route::get('/' . GenClass::$admin . '/manage-projects-images/{pn}/edit/{edit}', [ProjectsPosts::class, 'manage_projects_images_edit'])->where('pn', '[0-9]+')->where('edit', '[0-9]+');
Route::put('/' . GenClass::$admin . '/manage-projects-images/{pn}/edit/{edit}', [ProjectsPosts::class, 'manage_projects_images_save'])->where('pn', '[0-9]+')->where('edit', '[0-9]+');
Route::get('/' . GenClass::$admin . '/manage-projects-images/{pn}/change/{change}', [ProjectsPosts::class, 'manage_projects_images_change'])->where('pn', '[0-9]+')->where('change', '[0-9]+');
Route::delete('/' . GenClass::$admin . '/delete-projects-posts', [ProjectsPosts::class, 'delete_projects_posts']);
Route::post('/process-data/upload-project-image', [ProcessData::class, 'upload_project_image']);
Route::post('/process-data/edit-project-image', [ProcessData::class, 'edit_project_image']);
Route::get('/process-data/delete-project-image', [ProcessData::class, 'delete_project_image']);
Route::post('/process-data/change-project-image', [ProcessData::class, 'change_project_image']);
Route::put('/process-data/change-project-description', [ProcessData::class, 'change_project_description']);
Route::get('/process-data/delete-changed-project-image', [ProcessData::class, 'delete_changed_project_image']);

////======Manage Admin====///////
Route::match(['get', 'post'], '/' . GenClass::$admin . '/manage-admin', [AdminUser::class, 'manage_admin']);
Route::match(['get', 'post'], '/' . GenClass::$admin . '/manage-admin/{pn}', [AdminUser::class, 'manage_admin'])->where('pn', '[0-9]+');
Route::get('/' . GenClass::$admin . '/manage-admin/{pn2}/{pn}/activities/{activities}', [AdminUser::class, 'manage_admin_activities'])->where('pn2', '[0-9]+')->where('pn', '[0-9]+');
Route::get('/' . GenClass::$admin . '/manage-admin/{pn}/view/{view}', [AdminUser::class, 'manage_admin_view'])->where('pn', '[0-9]+')->where('view', '[0-9]+');
Route::get('/' . GenClass::$admin . '/manage-admin/create', [AdminUser::class, 'manage_admin_create']);
Route::post('/' . GenClass::$admin . '/manage-admin/create', [AdminUser::class, 'manage_admin_save']);
Route::get('/' . GenClass::$admin . '/manage-admin/{pn}/edit/{edit}', [AdminUser::class, 'manage_admin_edit'])->where('pn', '[0-9]+')->where('edit', '[0-9]+');
Route::put('/' . GenClass::$admin . '/manage-admin/{pn}/edit/{edit}', [AdminUser::class, 'manage_admin_save'])->where('pn', '[0-9]+')->where('edit', '[0-9]+');
Route::put('/' . GenClass::$admin . '/manage-admin/change-password', [AdminUser::class, 'change_admin_password']);
Route::put('/' . GenClass::$admin . '/manage-admin/assign-role', [AdminUser::class, 'assign_admin_role']);
Route::post('/' . GenClass::$admin . '/manage-admin/profile-pics', [AdminUser::class, 'manage_admin_profile_pics']);
Route::get('/' . GenClass::$admin . '/manage-admin/{pn}/remove/{remove}', [AdminUser::class, 'remove_admin_user'])->where('pn', '[0-9]+')->where('remove', '[0-9]+');

////======Manage Customer====///////
Route::match(['get', 'post'], '/' . GenClass::$admin . '/manage-customers', [AdminUser::class, 'manage_customer']);
Route::match(['get', 'post'], '/' . GenClass::$admin . '/manage-customers/{pn}', [AdminUser::class, 'manage_customer'])->where('pn', '[0-9]+');
Route::get('/' . GenClass::$admin . '/manage-customers/{pn2}/{pn}/activities/{activities}', [AdminUser::class, 'manage_customer_activities'])->where('pn2', '[0-9]+')->where('pn', '[0-9]+');
Route::get('/' . GenClass::$admin . '/manage-customers/{pn}/view/{view}', [AdminUser::class, 'manage_customer_view'])->where('pn', '[0-9]+')->where('view', '[0-9]+');
Route::get('/' . GenClass::$admin . '/manage-customers/create', [AdminUser::class, 'manage_customer_create']);
Route::post('/' . GenClass::$admin . '/manage-customers/create', [AdminUser::class, 'manage_customer_save']);
Route::get('/' . GenClass::$admin . '/manage-customers/{pn}/edit/{edit}', [AdminUser::class, 'manage_customer_edit'])->where('pn', '[0-9]+')->where('edit', '[0-9]+');
Route::put('/' . GenClass::$admin . '/manage-customers/{pn}/edit/{edit}', [AdminUser::class, 'manage_customer_save'])->where('pn', '[0-9]+')->where('edit', '[0-9]+');
Route::put('/' . GenClass::$admin . '/manage-customers/change-password', [AdminUser::class, 'change_customer_password']);
Route::post('/' . GenClass::$admin . '/manage-customers/profile-pics', [AdminUser::class, 'manage_customer_profile_pics']);
Route::get('/' . GenClass::$admin . '/manage-customers/{pn}/make-admin/{make_admin}', [AdminUser::class, 'make_user_admin'])->where('pn', '[0-9]+')->where('make_admin', '[0-9]+');
Route::get('/' . GenClass::$admin . '/manage-customers/{pn}/activate/{activate}', [AdminUser::class, 'activate_customer'])->where('pn', '[0-9]+')->where('activate', '[0-9]+');
Route::get('/' . GenClass::$admin . '/manage-customers/{pn}/block/{block}', [AdminUser::class, 'block_customer'])->where('pn', '[0-9]+')->where('block', '[0-9]+');
Route::get('/' . GenClass::$admin . '/manage-customers/{pn}/unblock/{unblock}', [AdminUser::class, 'unblock_customer'])->where('pn', '[0-9]+')->where('unblock', '[0-9]+');

////======Manage Newletter Subscribers====///////
Route::match(['get', 'post'], '/' . GenClass::$admin . '/newsletter-subscribers', [AdminUser::class, 'newsletter_subscribers']);
Route::match(['get', 'post'], '/' . GenClass::$admin . '/newsletter-subscribers/{pn}', [AdminUser::class, 'newsletter_subscribers'])->where('pn', '[0-9]+');

///////////////=======Role Management=============////////////

Route::match(['get', 'post'], '/' . GenClass::$admin . '/role-management', [RoleManagement::class, 'role_management']);
Route::match(['get', 'post'], '/' . GenClass::$admin . '/role-management/{pn}', [RoleManagement::class, 'role_management'])->where('pn', '[0-9]+');
Route::get('/' . GenClass::$admin . '/role-management/create', [RoleManagement::class, 'role_management_create']);
Route::post('/' . GenClass::$admin . '/role-management/create', [RoleManagement::class, 'role_management_save']);
Route::get('/' . GenClass::$admin . '/role-management/{pn}/edit/{edit}', [RoleManagement::class, 'role_management_edit'])->where('pn', '[0-9]+')->where('edit', '[0-9]+');
Route::put('/' . GenClass::$admin . '/role-management/{pn}/edit/{edit}', [RoleManagement::class, 'role_management_save'])->where('pn', '[0-9]+')->where('edit', '[0-9]+');
Route::delete('/' . GenClass::$admin . '/delete-role', [RoleManagement::class, 'delete_role']);

});

});

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'Index'])->name('index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');

});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'roles:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])-> name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])-> name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])-> name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])-> name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])-> name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])-> name('admin.update.password');

    Route::controller(CategoryController::class)->group(function() {
      Route::get('/all/category', 'AllCategory')->name('all.category');
      Route::get('/add/category', 'AddCategory')->name('add.category');
      Route::post('/store/category', 'StoreCategory')->name('store.category');
      Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
      Route::post('/update/category/{id}', 'UpdateCategory')->name('update.category');
      Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });

    Route::controller(CategoryController::class)->group(function() {
        Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory/{id}', 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'DeleteSubCategory')->name('delete.subcategory');
      });

      Route::controller(AdminController::class)->group(function() {
        Route::get('/all/instructor', 'AllInstructor')->name('all.instructor');
     
      });
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])-> name('admin.login');
Route::get('/become/instructor', [AdminController::class, 'BecomeInstructor'])-> name('become.instructor');

Route::middleware(['auth', 'roles:instructor'])->group(function() {
    Route::get('/instructor/dashboard', [InstructorController::class, 'InstructorDashboard'])-> name('instructor.dashboard');
    Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogout'])-> name('instructor.logout');
    Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])-> name('instructor.profile');
    Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])-> name('instructor.profile.store');
    Route::get('/instructor/change/password', [InstructorController::class, 'InstructorChangePassword'])-> name('instructor.change.password');
    Route::post('/instructor/update/password', [InstructorController::class, 'InstructorUpdatePassword'])-> name('instructor.update.password');
});

Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])-> name('instructor.login');
Route::post('/instructor/register', [InstructorController::class, 'InstructorRegister'])-> name('instructor.register');

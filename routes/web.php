<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\{PropertyTypeController, PropertyController};
use App\Http\Controllers\{AgentController, UserController};
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

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

// User Frontend Routes
Route::get('/', [UserController::class, 'Index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
});

// Admin Group Middleware
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);

// Agent Group Middleware
Route::middleware(['auth','role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
    Route::get('/agent/logout', [AgentController::class, 'AgentLogout'])->name('agent.logout');
    Route::get('/agent/profile', [AgentController::class, 'AgentProfile'])->name('agent.profile');
});

Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);

Route::post('/agent/register', [AgentController::class, 'AgentRegister'])->name('agent.register');

// Type-of-property Routes
Route::middleware(['auth','role:admin'])->group(function () {
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/type', 'AllType')->name('all.type');
        Route::get('/add/type', 'AddType')->name('add.type');
        Route::post('/store/type', 'StoreType')->name('store.type');
        Route::get('/edit/type/{id}', 'EditType')->name('edit.type');
        Route::post('/update/type', 'UpdateType')->name('update.type');
        Route::get('/delete/type/{id}', 'DeleteType')->name('delete.type');
    });
});

Route::middleware(['auth','role:admin'])->group(function () {
    // Amenities Routes
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/amenities', 'AllAmenities')->name('all.amenities');
        Route::get('/add/amenities', 'AddAmenities')->name('add.amenities');
        Route::post('/store/amenities', 'StoreAmenities')->name('store.amenities');
        Route::get('/edit/amenities/{id}', 'EditAmenities')->name('edit.amenities');
        Route::post('/update/amenities', 'UpdateAmenities')->name('update.amenities');
        Route::get('/delete/amenities/{id}', 'DeleteAmenities')->name('delete.amenities');
    });
    // Property Routes
    Route::controller(PropertyController::class)->group(function () {
        Route::get('/all/property', 'AllProperty')->name('all.property');
        Route::get('/add/property', 'AddProperty')->name('add.property');
        Route::post('/store/property', 'StoreProperty')->name('store.property');
        Route::get('/details/property/{id}', 'DetailsProperty')->name('details.property');
        Route::get('/edit/property/{id}', 'EditProperty')->name('edit.property');
        Route::post('/update/property', 'UpdateProperty')->name('update.property');
        Route::post('/inactive/property', 'InactiveProperty')->name('inactive.property');
        Route::post('/active/property', 'ActiveProperty')->name('active.property');
        Route::post('/update/property/thumbnail', 'UpdatePropertyThumbnail')->name('update.property.thumbnail');
        Route::post('/update/property/multiImage', 'UpdatePropertyMultiImage')->name('update.property.multiImage');
        Route::get('/delete/property/multiImage/{id}', 'DeletePropertyMultiImage')->name('delete.property.multiImage');
        Route::post('/store/new/multiImage', 'StoreNewMultiImage')->name('store.new.multiImage');
        Route::post('/update/property/facilities', 'UpdatePropertyFacilities')->name('update.property.facilities');
        Route::get('/delete/property/{id}', 'DeleteProperty')->name('delete.property');
    });
});

// Route::middleware(['auth','role:admin'])->group(function () {
// });

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EquipmentTypeController;
use App\Http\Controllers\ProfileController;
use App\Models\Equipment;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('main');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contacts', function () {
    return Inertia::render('Contacts');
})->name('contacts');

Route::get('/types', function () {
    return Inertia::render('TypeList');
})->name('types');

Route::get('/equipments', function () {
    return Inertia::render('EquipmentList');
})->name('equipments');

Route::get('/equipments/add', function () {
    return Inertia::render('AddEquipment');
})->name('AddEquipment');

Route::get('/market',function () {
    return Inertia::render('Market');
})->name('market');

Route::get('/applications',function () {
    return Inertia::render('UserApplications');
})->name('applications');

Route::get('/orders', function(){
    return Inertia::render('UserOrders');
})->name('orders');

Route::get('/equipments/list',function () {
    return Inertia::render('UserEquipmentList');
})->name('UserEquipments');

Route::get('/market/{id}', [EquipmentController::class, 'create'])->name('EquipmentCard');

Route::get('/equipment/{id}', [EquipmentController::class, 'createProductCard'])->name('ProductCard');

Route::delete('/deleteType',[EquipmentTypeController::class, 'delete']);

Route::post('/createType', [EquipmentTypeController::class, 'store']);

Route::get('/type/{id}',[EquipmentTypeController::class, 'create'])->name('TypeCard');

Route::post('/addTypeSpec',[EquipmentTypeController::class, 'addSpecialization']);

Route::post('/deleteTypeSpec', [EquipmentTypeController::class, 'deleteSpecialization']);

Route::post('/updateType', [EquipmentTypeController::class, 'update']);

Route::get('/fetchTypes',[EquipmentTypeController::class, 'fetchall']);

Route::get('/fetchSpecializations', [EquipmentTypeController::class, 'fetchSpecializations']);

Route::post('/createEquipment', [EquipmentController::class,'store']);

Route::get('/fetchEquipments', [EquipmentController::class, 'fetchEquipments']);

Route::post('/deleteEquipment', [EquipmentController::class, 'delete']);

Route::post('/updateEquipment', [EquipmentController::class, 'update']);

Route::get('/application/{equipmentId}',[ApplicationController::class, 'create'])->name('application');
Route::post('/addApplication',[ApplicationController::class, 'store']);
Route::get('/fetchUserAddress', [ApplicationController::class, 'fetchUserAddress']);

Route::get('/fetchUserApplications',[ApplicationController::class, 'fetchUserApplications']); 

Route::get('/fetchUserOrders', [ApplicationController::class, 'fetchUserOrders']);
Route::post('/changeOrderStatus', [ApplicationController::class, 'changeOrderStatus']);

Route::get('/fetchUserEquipments', [EquipmentController::class, 'fetchUserEquipments']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

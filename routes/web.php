<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;



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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');


//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::resource('users', UsersController::class);
Route::resource('roles', RolesController::class);
Route::resource('permissions', PermissionsController::class);

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/registrasi', [App\Http\Controllers\RegistrasiController::class, 'index'])->name('registrasi');
Route::get('/registrasi/chart', [App\Http\Controllers\RegistrasiController::class, 'chart'])->name('registrasi.chart');
Route::get('/registrasi/detail', [App\Http\Controllers\RegistrasiController::class, 'detail'])->name('registrasi.detail');
Route::get('/registrasi/inv/{id}', [App\Http\Controllers\RegistrasiController::class, 'inv'])->name('registrasi.inv');
Route::post('/registrasi', [App\Http\Controllers\RegistrasiController::class, 'store'])->name('registrasi.tambah');
Route::post('/registrasi/hapus', [App\Http\Controllers\RegistrasiController::class, 'destroy'])->name('registrasi.hapus');
Route::post('/registrasi/update', [App\Http\Controllers\RegistrasiController::class, 'update'])->name('registrasi.update');
Route::get('/registrasi/input', function () {
    return view('pages.registrasi.input');
});

Route::get('/pembayaran/invoice', [App\Http\Controllers\InvController::class, 'index'])->name('pembayaran');
Route::get('/pembayaran/status', [App\Http\Controllers\InvController::class, 'status'])->name('pembayaran.status');

Route::get('/pembayaran/invoice/detail', [App\Http\Controllers\InvController::class, 'show'])->name('pembayaran.show');

Route::get('/pembayaran/herregistrasi', [App\Http\Controllers\HerregistrasiController::class, 'index'])->name('herregistrasi');
Route::get('/pembayaran/herregistrasi/detail', [App\Http\Controllers\HerregistrasiController::class, 'detail'])->name('herregistrasi.detail');
Route::post('/pembayaran/herregistrasi', [App\Http\Controllers\HerregistrasiController::class, 'store'])->name('herregistrasi.post');
Route::post('/payment', [App\Http\Controllers\HerregistrasiController::class, 'payment_post']);


Route::get('/ahliwaris', [App\Http\Controllers\AhliWarisController::class, 'index'])->name('ahliwaris');
Route::post('/ahliwaris', [App\Http\Controllers\AhliWarisController::class, 'store'])->name('ahliwaris.tambah');
Route::post('/ahliwaris/update', [App\Http\Controllers\AhliWarisController::class, 'update'])->name('ahliwaris.update');
Route::post('/ahliwaris/hapus', [App\Http\Controllers\AhliWarisController::class, 'destroy'])->name('ahliwaris.hapus');
Route::get('/ahliwaris/get', [App\Http\Controllers\AhliWarisController::class, 'search'])->name('ahliwaris.search');

Route::get('/tpu', [App\Http\Controllers\TpuController::class, 'index'])->name('tpu');




Route::post('/skrd', [App\Http\Controllers\InvController::class, 'store'])->name('skrd.tambah');

// Route::get('/pembayaran', [App\Http\Controllers\OrderController::class, 'index']);
// Route::get('/payment', [App\Http\Controllers\OrderController::class, 'payment']);

Route::resource('orders', App\Http\Controllers\OrderController::class)->only(['index', 'show']);
Route::post('payments/midtrans-notification', [App\Http\Controllers\PaymentCallbackController::class, 'receive']);

Route::post('/import', [App\Http\Controllers\RegistrasiController::class, 'import'])->name('import_registrasi');
Route::get('/export', [App\Http\Controllers\RegistrasiController::class, 'export'])->name('export_registrasi');

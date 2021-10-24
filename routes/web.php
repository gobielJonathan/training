<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StimulusController;
use App\Http\Controllers\StimulusMapController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get("/user/dump", function(){
    return Auth::guard('web')->user();
});

Route::get('/as', [AdminController::class, 'index']);
Route::get('/faq', function() {
    $datas = [
        ['Tahap 1', 'Calon peserta mendaftarkan diri dengan membuat akun (sign up) pada website: https://www.pelatihandaringeksperimen.com/auth/login'],
        ['Tahap 2', 'Calon peserta memasuki (sign in) laman pendaftaran pada website: https://www.pelatihandaringeksperimen.com melalui akun masing-masing.'],
        ['Tahap 3', 'Calon peserta memilih fitur: yang terletak pada sisi kiri tengah laman pendaftaran website, apabila ingin langsung melakukan pembayaran.'],
        ['Tahap 4', 'Calon peserta memilih fitur:  yang terletak pada sisi kiri tengah laman pendaftaran website, apabila tidak ingin langsung melakukan pembayaran.'],
        ['Tahap 5', 'Calon peserta melakukan pembayaran (checkout) dengan melakukan transfer pada alternatif pilihan bank yang tersedia.'],
        ['Tahap 6', 'Calon peserta mengunduh bukti transfer pada fitur “upload bukti pembayaran”.'],
        ['Tahap 7', 'Calon peserta melakukan konfirmasi telah melakukan pembayaran kepada nomer salah satu contact person yang tertera pada e-poster pada website: https://www.pelatihandaringeksperimen.com'],
        ['Tahap 8', 'Calon peserta menunggu e-ticket yang berisi link dan passcode Zoom untuk mengikuti pelatihan.  E-ticket akan dikirimkan langsung ke email calon peserta yang pembayarannya sudah diverifikasi oleh panitia.'],
    ];
    return view('faq', compact($datas));
})->name('faq');

Route::get('/', [TrainingController::class, 'index'])->name('home');
Route::get('/home', [TrainingController::class, 'index']);

Route::get('/cart', [CartController::class, 'index'])->name('seeCart');
Route::post('/cart/delete/{id}', [CartController::class, 'remove'])->name('removeCart');

Route::get('/payment', [PaymentTypeController::class, 'index'])->name('seePayment');

Route::get('/buy/{banner_id}', [CartController::class, 'buy'])->name('buyCart');

Route::post('/cart/add/{id}/{training_id}', [CartController::class, 'add'])->name('addCart');
Route::post('/cart/remove/{id}/{training_id}', [CartController::class, 'decrease'])->name('decreaseCart');

Route::get('/direct-buy/{banner_id}', [CartController::class, 'instantCart'])->name('instantCart');

Route::post('/checkout', [TransactionController::class, 'add'])->name('checkout');


Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
    Route::post('/register', [RegisterController::class, 'register'])->name('addUser')->middleware('guest');
    Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('loginAs')->middleware('guest');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/user', [UserController::class, 'index'])->name('seeUser');
});


Route::group([
    'prefix' => "admin",
    'middleware' => ['role:' . User::ADMIN]
], function () {
    Route::get("/", [AdminController::class, 'showPageAdmin'])->name('showPageAdmin');
    Route::post('/user/delete', [UserController::class, 'remove'])->name('deleteUser');
    Route::post('/summary', [AdminController::class, 'summaryPeriod'])->name('summary');
    Route::post('/training', [TrainingController::class, 'add'])->name('addTraining');
    Route::post('/training/toggle-status', [TrainingController::class, 'toggleStatus'])->name('toggleTraining');

    Route::post('/training/delete', [TrainingController::class, 'remove'])->name('deleteTraining');

    Route::post('/payment', [PaymentTypeController::class, 'add'])->name('addPayment');
    Route::get('/transaction', [TransactionController::class, 'get'])->name('getTranscations');

    Route::post('/payment/delete', [PaymentTypeController::class, 'remove'])->name('removePayment');
    Route::post('/payment/accept', [TransactionController::class, 'accept'])->name('acceptPayment');

    Route::post('/stimulus', [StimulusController::class, 'add'])->name('addStimulus');
    Route::get('/stimulus', [StimulusController::class, 'get'])->name('getStimulus');
    Route::post('/stimulus/delete', [StimulusController::class, 'remove'])->name('deleteStimulus');
    Route::post('/stimulus/map', [StimulusMapController::class, 'map'])->name('mapStimulus');
});

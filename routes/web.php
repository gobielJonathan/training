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
    return view('faq');
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

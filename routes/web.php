<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\UserTypeRedirect;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FeedbackCategoryController;
use Illuminate\Support\Facades\Hash;

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

// dd(Hash::make('kami1234'));

Route::get('/login', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/categories', [FeedbackCategoryController::class, 'index'])->name('categories');
    Route::post('/category/store', [FeedbackCategoryController::class, 'store'])->name('category.store');
    Route::get('/category/getAllCategories', [FeedbackCategoryController::class, 'getAllCategoryData'])->name('category.getAllCategoryData');
    Route::patch('/category/update', [FeedbackCategoryController::class, 'update'])->name('category.update');
    Route::post('/category/destroyOrRestore', [FeedbackCategoryController::class, 'destroyOrRestore'])->name('category.destroyOrRestore');

    // Feedback Routes
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks');
    Route::get('/feedback/getAllFeedbacks', [FeedbackController::class, 'getAllFeedbacksData'])->name('feedback.getAllFeedbacksData');
    Route::post('/feedback/destroyOrRestore', [FeedbackController::class, 'destroyOrRestore'])->name('feedback.destroyOrRestore');
});

Route::group(['middleware' => ['auth', 'user.type']], function () {
    Route::get('/home', [HomeController::class, 'welcome'])->name('user.home');
    Route::get('/feedback/create', [HomeController::class, 'create'])->name('user.add_feedback');
    Route::post('/feedback/store', [HomeController::class, 'store'])->name('user.store_feedback');
    Route::get('/feedback/{id}', [HomeController::class, 'show'])->name('user.feedback_detail');
    Route::get('/feedbacks', [HomeController::class, 'index'])->name('user.feedbacks');
    Route::post('/feedback/voting', [HomeController::class, 'feedbackVoting'])->name('user.feedback.voting');
    Route::post('/feedback/comment', [HomeController::class, 'feedbackComment'])->name('user.feedback.comment');
});
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

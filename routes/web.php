<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("welcome");
Route::get('account', [LoginController::class, 'login_home'])->name("l_home");
Route::get('test', [LoginController::class, 'test'])->name("sec");


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'verified']], function () {
    Route::get('dashboard', [AdminController::class, 'dash'])->name("dash");
    Route::get('management_dashboard', [AdminController::class, 'index'])->name("home");
    Route::get('list_borrower', [AdminController::class, 'data2'])->name("list_b");
    Route::get('view_borrower/{id}', [AdminController::class, 'detail'])->name("view_b");
    Route::get('rolling_borrower', [AdminController::class, 'data'])->name("form");
    Route::post('insert_borrower', [AdminController::class, 'insert_data'])->name("insert");
    Route::get('update_borrower/{id}', [AdminController::class, 'edit_data'])->name("edit");
    Route::put('edit_borrower/{id}', [AdminController::class, 'update_data'])->name("update");
    Route::delete('delete_borrower/{id}', [AdminController::class, 'delete_data'])->name("delete");
    Route::get('return_book/{id}', [AdminController::class, 'return_b'])->name("return_b");
    Route::post('return_process/{id}', [AdminController::class, 'rtrn_book'])->name("return_p");
    Route::get('list_book', [BookController::class, 'index'])->name("l_book");
    Route::get('register_book', [BookController::class, 'form'])->name("r_book");
    Route::post('register_process', [BookController::class, 'insert'])->name("insert_book");
    Route::get('manage_book/{id}', [BookController::class, 'detail'])->name("m_book");
    Route::get('edit_book/{id}', [BookController::class, 'update'])->name("e_book");
    Route::put('edit_process/{id}', [BookController::class, 'update_process'])->name("e_process");
    Route::post('find_borrower', [BookController::class, 'find'])->name("find");
    Route::get('booking', [BookController::class, 'book'])->name("booking");
    Route::get('user_list', [AdminController::class, 'l_user'])->name("l_user");
    Route::post('user_process/{id}', [AdminController::class, 'lp_user'])->name("lp_user");
    Route::delete('delete_book/{id}', [BookController::class, 'delete_data'])->name("d_book");
    Route::put('approval_process/{id}', [AdminController::class, 'approve'])->name("approve");

});


Route::group(['prefix' => 'borrower', 'as' => 'borrower.', 'middleware' => ['auth', 'verified']], function () {
    //newcomer
    Route::get('details_form', [BorrowerController::class, 'form'])->name("d_form");
    Route::post('details_process', [BorrowerController::class, 'form_p'])->name("fp");
    Route::get('waiting_respond', [BorrowerController::class, 'wait'])->name("wait");
    //old
    Route::get('user_dashboard', [BorrowerController::class, 'index'])->name("home"); //checking user authorization
    Route::get('dash', [BorrowerController::class, 'dash'])->name("dash");
    Route::get('book_lists', [BorrowerController::class, 'l_book'])->name("l_bk");
    Route::get('request_book', [BorrowerController::class, 'req_b'])->name("req_b");
    Route::put('request_book_process', [BorrowerController::class, 'req_bp'])->name("req_bp");
    Route::get('request_status', [BorrowerController::class, 'status'])->name("status");
    Route::put('pickup_process{id}', [BorrowerController::class, 'pickup'])->name("pickup");
});


require __DIR__ . '/auth.php';

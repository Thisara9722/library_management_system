<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/books', [\App\Http\Controllers\BookController::class, 'getBooks'])->name('books.data');
    Route::get('/book/add', [\App\Http\Controllers\BookController::class, 'addBook'])->name('add-book.data');
    Route::get('/books/edit/{id}', [\App\Http\Controllers\BookController::class, 'edit']);
    Route::delete('/books/delete/{id}', [\App\Http\Controllers\BookController::class, 'destroy'])->name('books.destroy');
    Route::post('/book/store', [\App\Http\Controllers\BookController::class, 'store'])->name('books.store');
    Route::post( '/book/update', [\App\Http\Controllers\BookController::class, 'update'])->name('books.update');

    Route::get('/members', [\App\Http\Controllers\MemberController::class, 'index'])->name('members');
    Route::get('/members/data', [\App\Http\Controllers\MemberController::class, 'getMembers'])->name('members.data');
    Route::get('/member/add', [\App\Http\Controllers\MemberController::class, 'addMember'])->name('add-member.data');
    Route::post('/member/store', [\App\Http\Controllers\MemberController::class, 'store'])->name('members.store');
    Route::delete('/members/delete/{id}', [\App\Http\Controllers\MemberController::class, 'destroy'])->name('members.destroy');
    Route::get('/members/edit/{id}', [\App\Http\Controllers\MemberController::class, 'edit'])->name('members.edit');
    Route::post( '/member/update', [\App\Http\Controllers\MemberController::class, 'update'])->name('members.update');
});

require __DIR__.'/auth.php';

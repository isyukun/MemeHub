<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard & Memes
    Route::get('/dashboard', [MemeController::class, 'index'])->name('dashboard');
    Route::post('/memes', [MemeController::class, 'store'])->name('memes.store');
    Route::delete('/memes/{meme}', [MemeController::class, 'destroy'])->name('memes.destroy');
    Route::post('/memes/{meme}/like', [MemeController::class, 'toggleLike'])->name('memes.like');
    
    // Comments
    Route::post('/memes/{meme}/comments', [MemeController::class, 'storeComment'])->name('comments.store');
    Route::delete('/comments/{comment}', [MemeController::class, 'destroyComment'])->name('comments.destroy');

    // Notifications
    Route::post('/notifications/read', function() {
        \App\Models\Notification::where('user_id', auth()->id())->update(['is_read' => true]);
        return back();
    })->name('notifications.read');

    // Profile & Social
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/user/{user:name}', [ProfileController::class, 'show'])->name('user.profile');
    Route::post('/user/{user}/follow', [ProfileController::class, 'toggleFollow'])->name('user.follow');
});

require __DIR__.'/auth.php';

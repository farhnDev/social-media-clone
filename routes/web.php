<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SavePostController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

// Rute Autentikasi
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Rute untuk profil
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile']);
    Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit/{id}', [ProfileController::class, 'update'])->name('profile.edit');
    Route::post('/profile/verify-password', [ProfileController::class, 'verifyPassword'])->name('profile.verifyPassword');
});

// Rute utama
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/for-you', [HomeController::class, 'forYou'])->name('home.forYou');
    Route::get('/home/following', [HomeController::class, 'following'])->name('home.following');
    Route::post('/follow/{user}', [FollowerController::class, 'store'])->name('follow');

    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // Rute untuk store
    Route::resource('posts', PostController::class)->except(['create', 'store']);
    Route::resource('users', UserController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('likes', LikeController::class);
    Route::resource('saved-posts', SavePostController::class);
    Route::resource('followers', FollowerController::class);
});


// icons save and like
// Rute untuk Bookmark
Route::post('/save-post/{post}', [SavePostController::class, 'store'])->name('save-post.store');
Route::delete('/save-post/{post}', [SavePostController::class, 'destroy'])->name('save-post.destroy');

// Rute untuk Like
Route::post('/like/{post}', [LikeController::class, 'store'])->name('like.store');
Route::delete('/like/{post}', [LikeController::class, 'destroy'])->name('like.destroy');

Route::middleware(['auth'])->group(function () {
    // Rute Bookmark dan Like yang dilindungi
    Route::post('/save-post/{post}', [SavePostController::class, 'store'])->name('save-post.store');
    Route::delete('/save-post/{post}', [SavePostController::class, 'destroy'])->name('save-post.destroy');
    Route::post('/like/{post}', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/like/{post}', [LikeController::class, 'destroy'])->name('like.destroy');
    
});

Route::get('/search', [SearchController::class, 'index'])->name('search.index');

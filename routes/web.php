<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\GalleryToolController;
use App\Http\Controllers\Admin\GalleryProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Visitor\VisitorHomeController;
use App\Http\Controllers\Visitor\VisitorArticleController;
use App\Http\Controllers\Visitor\VisitorGalleryController;
use App\Http\Controllers\Visitor\VisitorServiceController;

/*
|--------------------------------------------------------------------------
| Admin Routes (Hanya untuk admin yang login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ DataTables route for articles
    Route::get('articles/data', [AdminArticleController::class, 'getData'])->name('articles.data');

    // Articles
    Route::get('articles/preview/{article}', [AdminArticleController::class, 'preview'])->name('articles.preview');
    Route::post('articles/upload-image', [AdminArticleController::class, 'uploadImage'])->name('articles.upload-image');
    Route::resource('articles', AdminArticleController::class);

    // Services
    Route::get('services/data', [AdminServiceController::class, 'getData'])->name('services.data');
    Route::get('services/preview/{service}', [AdminServiceController::class, 'preview'])->name('services.preview');
    Route::resource('services', AdminServiceController::class);

    // Gallery Projects
    Route::get('galleries/data', [GalleryProjectController::class, 'getData'])->name('galleries.getData');
    Route::resource('galleries', GalleryProjectController::class)
        ->parameters(['galleries' => 'galleryProject']);
    Route::get('gallery-data', [GalleryProjectController::class, 'data'])->name('galleries.data');

    Route::get('cities-by-province/{province}', function ($province) {
        return \App\Models\City::where('province', $province)
            ->select('id', 'city_name')
            ->get();
    });

    // Gallery Tools
    Route::resource('gallerytools', GalleryToolController::class);
});

/*
|--------------------------------------------------------------------------
| Visitor Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [VisitorHomeController::class, 'index'])->name('visitor.home');

// Tentang Kami
Route::prefix('about')->name('visitor.about.')->group(function () {
    Route::view('/profile', 'visitor.about.profile')->name('profile');
    Route::view('/history', 'visitor.about.history')->name('history');
});

// Articles
Route::prefix('articles')->name('visitor.articles.')->group(function () {
    Route::get('/', [VisitorArticleController::class, 'index'])->name('index');
    Route::get('/csr', [VisitorArticleController::class, 'csr'])->name('csr');
    Route::get('/{slug}', [VisitorArticleController::class, 'show'])->name('show');
});

// Services
Route::prefix('services')->name('visitor.services.')->group(function () {
    Route::get('/', [VisitorServiceController::class, 'index'])->name('index');
    Route::get('/{slug}', [VisitorServiceController::class, 'show'])->name('show');
});

// Galleries
Route::prefix('galleries')->name('visitor.galleries.')->group(function () {
    Route::get('/', [VisitorGalleryController::class, 'index'])->name('index');
    Route::get('/{slug}', [VisitorGalleryController::class, 'show'])->name('show');
});

// Contact
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

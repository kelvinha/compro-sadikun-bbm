<?php

use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Landing\AboutController;
use App\Http\Controllers\Landing\BlogController;
use App\Http\Controllers\Landing\ProductController;
use App\Http\Controllers\Landing\ProjectController;
use App\Http\Controllers\Landing\ContactController;
use Illuminate\Support\Facades\Route;

// Landing page routes (with tracking and locale)
Route::middleware(['web.tracking', 'web.locale'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/page/{slug}', [HomeController::class, 'page'])->name('home.page');

    // About routes
    Route::get('/about', [AboutController::class, 'index'])->name('home.about');

    // Blog routes
    Route::get('/blog', [BlogController::class, 'index'])->name('home.blog');
    Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('home.blog.category');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('home.blog.post');

    // Project routes
    Route::get('/projects', [ProjectController::class, 'index'])->name('home.projects');
    Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('home.projects.show');

    // Product routes
    Route::get('/products', [ProductController::class, 'index'])->name('home.products');
    Route::get('/products/category/{slug}', [ProductController::class, 'category'])->name('home.products.category');
    Route::get('/products/{slug}', [ProductController::class, 'show'])->name('home.products.show');
    Route::get('/products/file/{slug}', [ProductController::class, 'file'])->name('home.products.file');

    // Contact routes
    Route::get('/contact', [ContactController::class, 'index'])->name('home.contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('home.contact.store');
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SubmenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\LanguageController;

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

// Language switch route
Route::middleware(['web.locale'])->group(function () {
    Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');
});

// Landing Routes
require __DIR__.'/landing.php';

// Admin login route
Route::get('/admin/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/auth-user', [App\Http\Controllers\Auth\AuthController::class, 'loginPage'])->name('auth.page');
Route::post('/auth-user', [App\Http\Controllers\Auth\AuthController::class, 'loginUser'])->name('auth.submit');


Auth::routes();
Route::get('/sign-out', [AuthController::class, 'logout'])->name('sign-out');

// Admin routes
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->as('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Analytics
    Route::get('analytics', [\App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('analytics.index');

    // Profile
    Route::get('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/change-password', [\App\Http\Controllers\Admin\ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::put('profile/change-password', [\App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Content Management
    Route::resource('menus', MenuController::class)->names([
            'index' => 'menus.index',
            'create' => 'menus.create',
            'store' => 'menus.store',
            'show' => 'menus.show',
            'edit' => 'menus.edit',
            'update' => 'menus.update',
            'destroy' => 'menus.destroy',
        ]);
    Route::resource('submenus', SubmenuController::class)->names([
        'index' => 'submenus.index',
        'create' => 'submenus.create',
        'store' => 'submenus.store',
        'show' => 'submenus.show',
        'edit' => 'submenus.edit',
        'update' => 'submenus.update',
        'destroy' => 'submenus.destroy',
    ]);
    Route::resource('teams', \App\Http\Controllers\Admin\TeamController::class)->names([
        'index' => 'teams.index',
        'create' => 'teams.create',
        'store' => 'teams.store',
        'show' => 'teams.show',
        'edit' => 'teams.edit',
        'update' => 'teams.update',
        'destroy' => 'teams.destroy',
    ]);

    // Pages routes
    Route::get('pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('pages', [PageController::class, 'store'])->name('pages.store');
    Route::get('pages/{page}', [PageController::class, 'show'])->name('pages.show');
    Route::get('pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::get('pages/{page}/sections', [PageController::class, 'sections'])->name('pages.sections');
    Route::put('pages/{page}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');
    Route::post('pages/{page}/sections', [PageController::class, 'addSection'])->name('pages.add-section');
    Route::put('pages/sections/{section}', [PageController::class, 'updateSection'])->name('pages.update-section');
    Route::delete('pages/sections/{section}', [PageController::class, 'deleteSection'])->name('pages.delete-section');
    Route::post('pages/sections/order', [PageController::class, 'updateSectionOrder'])->name('pages.update-section-order');
    Route::post('pages/order', [PageController::class, 'updateOrder'])->name('pages.update-order');
    Route::get('sections/{section}/edit', [PageController::class, 'editSection'])->name('pages.edit-section');

    // Blogs
    Route::resource('blogs', BlogController::class)->names([
        'index' => 'blogs.index',
        'create' => 'blogs.create',
        'store' => 'blogs.store',
        'show' => 'blogs.show',
        'edit' => 'blogs.edit',
        'update' => 'blogs.update',
        'destroy' => 'blogs.destroy',
    ]);
    Route::resource('blog-categories', BlogCategoryController::class)->names([
        'index' => 'blog-categories.index',
        'create' => 'blog-categories.create',
        'store' => 'blog-categories.store',
        'show' => 'blog-categories.show',
        'edit' => 'blog-categories.edit',
        'update' => 'blog-categories.update',
        'destroy' => 'blog-categories.destroy',
    ]);
    Route::resource('media', MediaController::class)->names([
        'index' => 'media.index',
        'create' => 'media.create',
        'store' => 'media.store',
        'show' => 'media.show',
        'edit' => 'media.edit',
        'update' => 'media.update',
        'destroy' => 'media.destroy',
    ]);
    Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::post('media/batch-upload', [MediaController::class, 'batchUpload'])->name('media.batch-upload');
    Route::get('media/get-all', [MediaController::class, 'getAll'])->name('media.get-all');

    // E-commerce
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class)->names([
        'index' => 'services.index',
        'create' => 'services.create',
        'store' => 'services.store',
        'show' => 'services.show',
        'edit' => 'services.edit',
        'update' => 'services.update',
        'destroy' => 'services.destroy',
    ]);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->names([
        'index' => 'products.index',
        'create' => 'products.create',
        'store' => 'products.store',
        'show' => 'products.show',
        'edit' => 'products.edit',
        'update' => 'products.update',
        'destroy' => 'products.destroy',
    ]);
    Route::resource('product-categories', \App\Http\Controllers\Admin\ProductCategoryController::class)->names([
        'index' => 'product-categories.index',
        'create' => 'product-categories.create',
        'store' => 'product-categories.store',
        'show' => 'product-categories.show',
        'edit' => 'product-categories.edit',
        'update' => 'product-categories.update',
        'destroy' => 'product-categories.destroy',
    ]);

    // Projects
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class)->names([
        'index' => 'projects.index',
        'create' => 'projects.create',
        'store' => 'projects.store',
        'show' => 'projects.show',
        'edit' => 'projects.edit',
        'update' => 'projects.update',
        'destroy' => 'projects.destroy',
    ]);

    // Banners
    Route::resource('banners', BannerController::class)->names([
        'index' => 'banners.index',
        'create' => 'banners.create',
        'store' => 'banners.store',
        'show' => 'banners.show',
        'edit' => 'banners.edit',
        'update' => 'banners.update',
        'destroy' => 'banners.destroy',
    ]);

    // Clients
    Route::resource('clients', ClientController::class)->names([
        'index' => 'clients.index',
        'create' => 'clients.create',
        'store' => 'clients.store',
        'show' => 'clients.show',
        'edit' => 'clients.edit',
        'update' => 'clients.update',
        'destroy' => 'clients.destroy',
    ]);

    // Settings
    Route::get('settings', [WebsiteSettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [WebsiteSettingController::class, 'update'])->name('settings.update');
    Route::get('seo', [SeoController::class, 'index'])->name('seo.index');
    Route::post('seo', [SeoController::class, 'update'])->name('seo.update');

    // Contact Messages
    Route::get('contact-messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::get('contact-messages/{id}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::put('contact-messages/{id}/mark-as-replied', [\App\Http\Controllers\Admin\ContactMessageController::class, 'markAsReplied'])->name('contact-messages.mark-as-replied');
    Route::delete('contact-messages/{id}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');

    // Newsletter Subscribers
    Route::resource('newsletter-subscribers', \App\Http\Controllers\Admin\NewsletterSubscriberController::class)->names([
        'index' => 'newsletter-subscribers.index',
        'create' => 'newsletter-subscribers.create',
        'store' => 'newsletter-subscribers.store',
        'show' => 'newsletter-subscribers.show',
        'edit' => 'newsletter-subscribers.edit',
        'update' => 'newsletter-subscribers.update',
        'destroy' => 'newsletter-subscribers.destroy',
    ]);
    Route::get('newsletter-subscribers-export', [\App\Http\Controllers\Admin\NewsletterSubscriberController::class, 'export'])->name('newsletter-subscribers.export');

    // Legacy routes
    Route::resource('user', UserController::class)->names([
        'index' => 'user.index',
        'create' => 'user.create',
        'store' => 'user.store',
        'show' => 'user.show',
        'edit' => 'user.edit',
        'update' => 'user.update',
        'destroy' => 'user.destroy',
    ]);
    Route::get('user/{user}/change-password', [UserController::class, 'changePassword'])->name('user.change-password');
    Route::put('user/{user}/update-password', [UserController::class, 'updatePassword'])->name('user.update-password');
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class)->names([
        'index' => 'testimonials.index',
        'create' => 'testimonials.create',
        'store' => 'testimonials.store',
        'show' => 'testimonials.show',
        'edit' => 'testimonials.edit',
        'update' => 'testimonials.update',
        'destroy' => 'testimonials.destroy',
    ]);
});


// SuperAdmin routes
Route::middleware(['auth', 'isSuperAdmin'])->prefix('admin')->as('admin.')->group(function () {
    // User Management
    Route::resource('users', UserController::class);
    Route::get('users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::put('users/{user}/update-password', [UserController::class, 'updatePassword'])->name('users.update-password');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

// Employee routes
// Commented out until EmployeeProcurementController is implemented
// Route::middleware(['auth'])->prefix('employee')->group(function () {
//     Route::resource('procurement', \App\Http\Controllers\Employee\EmployeeProcurementController::class);
//     Route::get('procurement/approve/{id}', [\App\Http\Controllers\Employee\EmployeeProcurementController::class, 'approve']);
//     Route::get('procurement/deny/{id}', [\App\Http\Controllers\Employee\EmployeeProcurementController::class, 'deny']);
// });


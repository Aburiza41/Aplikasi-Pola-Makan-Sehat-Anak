<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
})->name('welcome');


Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Begin Users Handling
    Route::prefix('/user')->name('user')->middleware(['user'])->group(function () {
        // Users
        Route::prefix('/users')->name('.users')->controller(\App\Http\Controllers\User\UserController::class)->group(function () {
            Route::get('/', 'index')->name('.index');
            Route::get('/create', 'create')->name('.create');
            Route::post('/', 'store')->name('.store');
            Route::get('/{user}/edit', 'edit')->name('.edit');
            Route::patch('/{user}', 'update')->name('.update');
            Route::delete('/{user}', 'destroy')->name('.destroy');
        });

        // Children
        Route::prefix('/children')->name('.children')->controller(\App\Http\Controllers\User\ChildrenController::class)->group(function () {
            Route::get('/', 'index')->name('.index');
            Route::get('/create', 'create')->name('.create');
            Route::post('/', 'store')->name('.store');
            Route::get('/{children}/edit', 'edit')->name('.edit');
            Route::patch('/{children}', 'update')->name('.update');
            Route::delete('/{children}', 'destroy')->name('.destroy');
        });

        // Food Recommendation
        Route::prefix('/food-recommendation')->name('.food_recommendation')->controller(\App\Http\Controllers\User\FoodRecommendationController::class)->group(function () {
            Route::get('/', 'index')->name('.index');
            Route::get('/create', 'create')->name('.create');
            Route::post('/', 'store')->name('.store');
            Route::get('/{food_recommendation}/edit', 'edit')->name('.edit');
            Route::patch('/{food_recommendation}', 'update')->name('.update');
            Route::delete('/{food_recommendation}', 'destroy')->name('.destroy');
        });

        // Food
        Route::prefix('/food')->name('.food')->controller(\App\Http\Controllers\User\FoodController::class)->group(function () {
            Route::get('/', 'index')->name('.index');
            Route::get('/create', 'create')->name('.create');
            Route::post('/', 'store')->name('.store');
            Route::get('/{food}/edit', 'edit')->name('.edit');
            Route::patch('/{food}', 'update')->name('.update');
            Route::delete('/{food}', 'destroy')->name('.destroy');
        });
    });
    // End Users Handling

    // Begin Admin Handling
    Route::prefix('/admin')->name('admin')->middleware(['auth', 'admin'])->group(function () {
        // Admin
        Route::prefix('/admin')->name('.admin')->controller(\App\Http\Controllers\Admin\AdminController::class)->group(function () {
            Route::get('/', 'index')->name('.index');
            Route::get('/create', 'create')->name('.create');
            Route::post('/', 'store')->name('.store');
            Route::get('/{admin}/edit', 'edit')->name('.edit');
            Route::patch('/{admin}', 'update')->name('.update');
            Route::delete('/{admin}', 'destroy')->name('.destroy');
        });

        // Food Group
        Route::prefix('/food-group')->name('.food_group')->controller(\App\Http\Controllers\Admin\FoodGroupController::class)->group(function () {
            Route::get('/', 'index')->name('.index');
            Route::get('/create', 'create')->name('.create');
            Route::post('/', 'store')->name('.store');
            Route::get('/{food_group}/edit', 'edit')->name('.edit');
            Route::patch('/{food_group}', 'update')->name('.update');
            Route::delete('/{food_group}', 'destroy')->name('.destroy');

            // Customized
            Route::post('/store/image', 'image')->name('.image');
        });

        // Food
        Route::prefix('/food')->name('.food')->controller(\App\Http\Controllers\Admin\FoodController::class)->group(function () {
            Route::get('/', 'index')->name('.index');
            Route::get('/create', 'create')->name('.create');
            Route::post('/', 'store')->name('.store');
            Route::get('/{food}/edit', 'edit')->name('.edit');
            Route::patch('/{food}', 'update')->name('.update');
            Route::delete('/{food}', 'destroy')->name('.destroy');
        });

        // Boys || Anak Laki-Laki
        Route::prefix('/boys')->name('.boys')->controller(\App\Http\Controllers\Admin\BoysController::class)->group(function () {
            Route::get('/', 'index')->name('.index');
            Route::get('/create', 'create')->name('.create');
            Route::post('/', 'store')->name('.store');
            Route::get('/{boys}/edit', 'edit')->name('.edit');
            Route::patch('/{boys}', 'update')->name('.update');
            Route::delete('/{boys}', 'destroy')->name('.destroy');
        });

        // Girls || Anak Perempuan
        Route::prefix('/girls')->name('.girls')->controller(\App\Http\Controllers\Admin\GirlsController::class)->group(function () {
            Route::get('/', 'index')->name('.index');
            Route::get('/create', 'create')->name('.create');
            Route::post('/', 'store')->name('.store');
            Route::get('/{girls}/edit', 'edit')->name('.edit');
            Route::patch('/{girls}', 'update')->name('.update');
            Route::delete('/{girls}', 'destroy')->name('.destroy');
        });
    });
    // End Admin Handling

    // Profile || All Users
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

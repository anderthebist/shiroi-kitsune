<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ComentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudiosController;
use App\Http\Controllers\VideoController;

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

Route:: group(['middleware' => 'throttle:120'], function() {

    Route::get('/',  [HomeController:: class, 'index'])->name("index");

    Route:: prefix('auth')->group(function () {
        Route:: post("/auth_process", [AuthController:: class, 'auth'])->name("auth");
        Route:: get("/logout", [AuthController:: class, 'logout'])->name("logout");
        Route:: post("/register_process", [AuthController:: class, 'register'])->name("register");
        Route:: get("/forget", [AuthController:: class, 'forgetShow'])->name("forget");
        Route:: post("/forget_process", [AuthController:: class, 'forget'])->name("forget_process");
        Route:: get("/reset_password/{token}", [AuthController:: class, 'resetPasswordShow'])->name("reset_password");
        Route:: post("/reset_password_process", [AuthController:: class, 'resetPassword'])->name("reset_password_process");
    });

    Route:: get("/rules", function () {
        return view("regulations");
    })->name("rules");
    Route::post('/releases/search', [AnimeController:: class, 'search']);

    Route:: prefix('admin')->middleware(["admin"])->group(function () {
        Route:: get("/", [AdminController::class, 'index'])->name("admin.index");
        Route:: get("/anime", [AnimeController::class, 'admin'])->name("anime.admin");
        Route:: get("/anime/create", [AnimeController::class, 'create'])->name("anime.create");
        Route:: get("/anime/edit/{id}", [AnimeController::class, 'edit'])->name("anime.edit");
        Route:: get("/news", [NewsController::class, 'admin'])->name("news.admin");
        Route:: get("/news/create", [NewsController::class, 'create'])->name("news.create");
        Route:: get("/news/edit/{id}", [NewsController::class, 'edit'])->name("news.edit");
        Route:: get("/team", [TeamController:: class, 'admin'])->name("team.admin");
        Route:: get("/team/create", [TeamController::class, 'create'])->name("team.create");
        Route:: get("/team/edit/{id}", [TeamController::class, 'edit'])->name("team.edit");
        Route::resource('categories', CategoryController::class);
        Route::resource('studios', StudiosController::class);
        Route::resource('videos', VideoController::class);
    });

    Route:: get("/releases/watch/{name}", [AnimeController:: class, 'watch'])->name("watch");
    Route::resource('releases', AnimeController::class);

    Route::resource('news', NewsController::class)->except(["create"]);

    Route::get('/team/{id?}/{page?}', [TeamController:: class, 'index'])->name("team.index");
    Route::resource('team', TeamController::class)->except([
        'index', 'create', 'edit'
    ]);
    Route:: post("/team_process", [TeamController:: class, 'team_process'])->name("team_process");
    Route:: post("/team_next", [TeamController:: class, 'next'])->name("team_next");
    Route:: post("/team_prev", [TeamController:: class, 'prev'])->name("team_prev");

    Route:: prefix('coment')->group(function () {
        Route:: post("/send", [ComentController:: class, 'send'])->name("coment.send");
        Route:: get("/delete/{id}", [ComentController:: class, 'delete'])->name("coment.delete");
    });

    Route:: prefix('favorite')->middleware(['auth'])->group(function () {
        Route:: post("/create", [FavoriteController:: class, 'create'])->name("favorite.create");
        Route:: get("/delete/{id}", [FavoriteController:: class, 'delete'])->name("coment_delete");
    });

    Route:: prefix('marks')->group(function () {
        Route:: post("/create", [MarkController:: class, 'create'])->name("marks.create");
    });

    Route:: prefix('users')->group(function () {
        Route:: post("/upload_image", [UserController:: class, 'upload'])->name("users.upload");
        Route:: post("/edit_name", [UserController:: class, 'changeName'])->name("users.edit_name");
    });
    Route::resource('users', UserController::class);

});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PsychogramController;
use App\Http\Controllers\PsychotestController;
use App\Http\Controllers\JadwalsUserController;
use App\Http\Controllers\PsychologistController;
use App\Http\Controllers\PsychotestScheduleController;
use App\Http\Controllers\PsychotestParticipantController;

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



Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'viewRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('/psychogram', PsychogramController::class, ['names' => ['index' => 'psychogram']]);
    Route::resource('/psychotest/schedule', JadwalController::class, ['names' => ['index' => 'schedule']]);
    Route::resource('/psychotest/participant', JadwalsUserController::class, ['names' => ['index' => 'participant']]);
    Route::resource('/master/admin', AdminController::class, ['names' => ['index' => 'admin']]);
    Route::resource('/master/company', PerusahaanController::class, ['names' => ['index' => 'company']]);
    Route::resource('/master/user', UserController::class, ['names' => ['index' => 'user']]);
    Route::resource('/master/psychologist', PsychologistController::class, ['names' => ['index' => 'psychologist']]);
    Route::resource('/skill/category', CategoryController::class, ['names' => ['index' => 'category']]);
    Route::resource('/skill/data', SkillController::class, ['names' => ['index' => 'skill']]);
    Route::resource('/vacancy', VacancyController::class, ['names' => ['index' => 'vacancy']]);
    Route::post('/logout', [AuthController::class, 'logout']);
});

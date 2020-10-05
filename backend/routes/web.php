<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraphController;

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

Route::get('/', function () {
    logger('welcom route.');
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 入力ページ
Route::get('/', [GraphController::class, 'index'])->middleware('auth');

// データベースに登録
Route::post('/inputData', [GraphController::class, 'inputData'])->name('inputData')->middleware('auth');

// グラフを表示
Route::get('/graph', [GraphController::class, 'showGraph'])->middleware('auth');

// 編集
Route::get('/edit', [GraphController::class, 'showEdit'])->name('edit')->middleware('auth');
Route::post('/edit', [GraphController::class, 'edit'])->middleware('auth');

// 削除
Route::get('/delete', [GraphController::class, 'showDelete'])->name('delete')->middleware('auth');
Route::post('/delete', [GraphController::class, 'delete'])->middleware('auth');
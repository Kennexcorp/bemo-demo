<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\DBDumperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResources([
    'cards' => CardController::class,
    'columns' => ColumnController::class
]);

Route::put('column/saveState', [ColumnController::class, 'saveState']);

Route::get('dump_database', [DBDumperController::class, 'dumpDatabase']);

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\BorrowRequestController;
use App\Http\Controllers\ExamineAssetController;
use App\Http\Controllers\InsertController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\showAssetController;
use App\Http\Controllers\DashboardController;
use App\Models\Asset;
use App\Models\BorrowRequest;


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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::post('/getDataChart',[DashboardController::class,'getDataChart']);

    Route::get('/asset/all',[AssetController::class,'assetAll'])->name('assetAll');//รวมAsset
    Route::get('/asset/edit/{id}',[AssetController::class,'edit'])->name('assetEdit'); //ฟอร์มแก้ไข
    Route::post('/asset/update/{id}',[AssetController::class,'update'])->name('assetUpdate');
    Route::get('/asset/insert',[InsertController::class,'insert'])->name('assetInsert'); //หน้าinsert
    Route::post('/asset/store',[InsertController::class,'store'])->name('assetStore'); //หน้าadd
    Route::get('/asset/delete/{id}',[AssetController::class,'delete'])->name('assetDelete');

    Route::get('/asset/repair',[ShowAssetController::class,'showAsset'])->name('assetshow');
    Route::get('/request',[BorrowRequestController::class,'index']);
    Route::get('/request',[BorrowRequestController::class,'create']);
    Route::post('/request/add',[BorrowRequestController::class,'store'])->name('request');

    // Examine
    Route::get('/asset/examine',[ExamineAssetController::class,'index'])->name('assetExamine');
    Route::post('/assets/examine/store', [ExamineAssetController::class, 'store'])->name('examineStore');

    // Repair
    Route::get('/repair',[RepairController::class,'repair'])->name('assetRepair');
    Route::get('/repair/insert',[RepairController::class,'insert']);
    Route::post('/repair/store',[RepairController::class,'store'])->name('repairStore');
    Route::post('/repair/update',[RepairController::class,'update'])->name('repairUpdate');


});

// Route::get('/asset/management',[assetController::class,'index'])->name('assetManagement');
// Route::post('/asset/insert',[assetController::class,'insert'])->name('assetInsert');
// Route::get('/asset/all',function() {
//     $assets=Asset::all();
//     return view('approver.asset.index',compact('assets'));
// })->name('assetAll');


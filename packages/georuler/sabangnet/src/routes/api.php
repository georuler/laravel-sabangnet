<?php

use Illuminate\Support\Facades\Route;

//sabangNet
Route::prefix('sabangNets')->group(function(){

    //클레임 수집
    Route::prefix('claim')->group(function(){
        Route::get('', [\Georuler\Sabangnet\App\Http\Controllers\SabangNetClaimController::class, 'index']);
        Route::get('searchXml', [\Georuler\Sabangnet\App\Http\Controllers\SabangNetClaimController::class, 'searchXml']);
    });

    //송장 등록
    Route::prefix('invoice')->group(function(){
        Route::post('', [\Georuler\Sabangnet\App\Http\Controllers\SabangNetInvoiceController::class, 'store']);
        Route::get('createXml', [\Georuler\Sabangnet\App\Http\Controllers\SabangNetInvoiceController::class, 'createXml']);
    });
    
    //주문 수집
    Route::prefix('order')->group(function(){
        Route::get('', [\Georuler\Sabangnet\App\Http\Controllers\SabangNetOrderInfoController::class, 'index']);
        Route::get('searchXml', [\Georuler\Sabangnet\App\Http\Controllers\SabangNetOrderInfoController::class, 'searchXml']);
    });

    //문의사항 수집/등록
    Route::prefix('qna')->group(function(){
        Route::get('', [\Georuler\Sabangnet\App\Http\Controllers\SabangNetQnaController::class, 'index']);
        Route::post('', [\Georuler\Sabangnet\App\Http\Controllers\SabangNetQnaController::class, 'store']);
        Route::get('searchXml', [\Georuler\Sabangnet\App\Http\Controllers\SabangNetQnaController::class, 'searchXml']);
        Route::get('createXml', [\Georuler\Sabangnet\App\Http\Controllers\SabangNetQnaController::class, 'createXml']);
    });

});
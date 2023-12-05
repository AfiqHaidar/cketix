<?php

use App\Http\Module\Banner\Presentation\Controller\BannerController;
use Illuminate\Support\Facades\Route;

Route::get('ping', function () {
    return csrf_token();
});

Route::middleware('admin')->group(function () {

    Route::get('banner-test', [BannerController::class, 'getAllBanners']);
    route::post('/admin/banner/create', [BannerController::class, 'createBanner'])->name('admin.createBanner');
    route::post('/admin/banner/update/{id}', [BannerController::class, 'updateBanner'])->name('admin.updateBanner');
    route::get('/admin/banner/delete/{id}', [BannerController::class, 'deleteBanner'])->name('admin.deleteBanner');
});

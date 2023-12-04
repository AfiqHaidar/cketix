<?php

use App\Http\Module\Banner\Presentation\Controller\BannerController;
use Illuminate\Support\Facades\Route;

Route::get('ping', function () {
    return csrf_token();
});

Route::get('banner-test', [BannerController::class, 'getAllBanners']);

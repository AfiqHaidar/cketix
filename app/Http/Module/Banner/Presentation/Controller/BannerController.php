<?php

namespace App\Http\Module\Banner\Presentation\Controller;

use App\Http\Module\Banner\Application\Services\CreateBannerRequest;
use App\Http\Module\Banner\Application\Services\CreateBannerService;
use App\Http\Module\Banner\Application\Services\GetBannerRequest;
use App\Http\Module\Banner\Application\Services\GetBannerService;
use App\Http\Module\Banner\Domain\Model\Banner;
use Illuminate\Http\Request;

class BannerController
{
    public function __construct(
        private CreateBannerService $create_banner_service,
        private GetBannerService $getBannerService
    ) {
    }

    public function createBanner(Request $request)
    {
        // dd($request);
        $request = new CreateBannerRequest(
            $request->input('header'),
            $request->input('subheader'),
            $request->input('image'),
        );

        return $this->create_banner_service->execute($request);
    }

    public function getAllBanners()
    {
        $getBannerRequest = new GetBannerRequest();
        $banners = $this->getBannerService->execute($getBannerRequest);

        return ($banners);
    }
}

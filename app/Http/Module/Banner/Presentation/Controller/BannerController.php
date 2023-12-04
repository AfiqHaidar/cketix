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
        $validatedData = $request->validate([
            'header' => 'required|string|max:255',
            'subheader' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);
        $imagePath = $request->file('image')->store('banners', 'public');
        $validatedData['image'] =  $imagePath;

        $request = new CreateBannerRequest(
            $validatedData['header'],
            $validatedData['subheader'],
            $validatedData['image'],
        );

        $this->create_banner_service->execute($request);

        return redirect()->route('admin.banner');
    }

    public function getAllBanners()
    {
        $getBannerRequest = new GetBannerRequest();
        $banners = $this->getBannerService->execute($getBannerRequest);

        return ($banners);
    }
}

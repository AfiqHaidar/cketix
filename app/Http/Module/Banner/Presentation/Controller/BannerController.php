<?php

namespace App\Http\Module\Banner\Presentation\Controller;

use App\Http\Module\Banner\Application\Services\CreateBannerRequest;
use App\Http\Module\Banner\Application\Services\CreateBannerService;
use App\Http\Module\Banner\Application\Services\DeleteBannerRequest;
use App\Http\Module\Banner\Application\Services\DeleteBannerService;
use App\Http\Module\Banner\Application\Services\GetBannerRequest;
use App\Http\Module\Banner\Application\Services\GetBannerService;
use App\Http\Module\Banner\Domain\Model\Banner;
use App\Models\Banner as ModelsBanner;
use Illuminate\Http\Request;

class BannerController
{
    public function __construct(
        private CreateBannerService $create_banner_service,
        private GetBannerService $getBannerService,
        private DeleteBannerService $deleteBannerService,
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

    public function updateBanner(Request $request, $id)
    {
        $validatedData = $request->validate([
            'header' => 'required|string|max:255',
            'subheader' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

        $banner = ModelsBanner::where('id', $id)->get();

        if (isset($validatedData['image'])) {
            $imagePath = $request->file('image')->store('banners', 'public');
            $validatedData['image']  = $imagePath;
        } else {
            $validatedData['image']  = $banner[0]->image;
        }

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

    public function deleteBanner($id)
    {
        $deleteBannerRequest = new DeleteBannerRequest($id);
        $this->deleteBannerService->execute($deleteBannerRequest);

        return redirect()->route('admin.banner');
    }
}

<?php

namespace App\Http\Module\Banner\Application\Services;

use App\Http\Module\Banner\Domain\Model\Banner;
use App\Http\Module\Banner\Infrastructure\Repository\BannerRepository;

class GetBannerService
{
    public function __construct(
        private BannerRepository $bannerRepository
    ) {
    }

    public function execute()
    {
        // Retrieve banners from the repository
        $banners = $this->bannerRepository->getAllBanners();

        // You can add any additional processing logic here

        return $banners;
    }
}

<?php

namespace App\Http\Module\Banner\Application\Services;

use App\Http\Module\Banner\Domain\Model\Banner;
use App\Http\Module\Banner\Infrastructure\Repository\BannerRepository;

class DeleteBannerService
{

    public function __construct(
        private BannerRepository $banner_repository
    ) {
    }

    public function execute(DeleteBannerRequest $id)
    {

        $this->banner_repository->deleteBanner($id);
    }
}

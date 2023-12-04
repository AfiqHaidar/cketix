<?php

namespace App\Http\Module\Banner\Application\Services;

use App\Http\Module\Banner\Domain\Model\Banner;
use App\Http\Module\Banner\Infrastructure\Repository\BannerRepository;

class CreateBannerService
{

    public function __construct(
        private BannerRepository $banner_repository
    ) {
    }

    public function execute(CreateBannerRequest $request)
    {
        $banner = new Banner(
            $request->header,
            $request->subheader,
            $request->image,
        );

        $this->banner_repository->save($banner);
    }
}

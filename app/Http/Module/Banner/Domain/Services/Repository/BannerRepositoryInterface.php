<?php

namespace App\Http\Module\Banner\Domain\Services\Repository;

use App\Http\Module\Banner\Domain\Model\Banner;

interface BannerRepositoryInterface
{
    public function save(Banner $banner);
    public function getAllBanners();
}

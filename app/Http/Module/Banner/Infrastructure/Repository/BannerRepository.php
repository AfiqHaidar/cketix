<?php

namespace App\Http\Module\Banner\Infrastructure\Repository;

use App\Http\Module\Banner\Domain\Model\Banner;
use App\Http\Module\Banner\Domain\Services\Repository\BannerRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BannerRepository implements BannerRepositoryInterface
{
    public function save(Banner $banner)
    {
        DB::table('banners')->upsert(
            [
                'header' => $banner->header,
                'subheader' => $banner->subheader,
                'image' => $banner->image,
            ],
            'header'
        );
    }

    public function getAllBanners()
    {
        return DB::table('banners')->get();
        // You might want to transform the raw database results into Banner models here
    }
}

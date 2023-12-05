<?php

namespace App\Http\Module\Banner\Application\Services;

class CreateBannerRequest
{
    public function __construct(
        public string $header,
        public string $subheader,
        public string $image,
    ) {
    }
}

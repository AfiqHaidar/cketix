<?php

namespace App\Http\Module\Banner\Application\Services;

class DeleteBannerRequest
{
    public function __construct(
        public int $id,
    ) {
    }
}

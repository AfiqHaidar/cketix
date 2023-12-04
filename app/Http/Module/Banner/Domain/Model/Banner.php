<?php

namespace App\Http\Module\Banner\Domain\Model;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Banner
{
    /**
     * @param string $header
     * @param string $subheader
     * @param string $image
     */
    public function __construct(
        public string $header,
        public string $subheader,
        public string $image,
    ) {
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $table = 'concerts';

    protected $guarded = ['id'];
    protected $fillable = ['name', 'image'];

    public function guestDetail()
    {
        return $this->hasMany(GuestDetail::class);
    }

    public function concertDetail()
    {
        return $this->hasMany(ConcertDetail::class);
    }
}

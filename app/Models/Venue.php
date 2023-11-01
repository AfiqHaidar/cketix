<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $table = 'venues';

    protected $guarded = ['id'];
    protected $fillable = ['name', 'address', 'city_id'];

    public function concertDetail()
    {
        return $this->hasMany(GuestDetail::class);
    }

    public function seat()
    {
        return $this->hasMany(Catagory::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

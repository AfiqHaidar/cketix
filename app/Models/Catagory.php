<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    use HasFactory;

    protected $table = 'catagories';

    protected $guarded = ['id'];
    protected $fillable = ['seat', 'code', 'price', 'concert_detail_id', 'venue_id'];

    public function concertDetail()
    {
        return $this->belongsTo(ConcertDetail::class);
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}

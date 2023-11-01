<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestDetail extends Model
{
    use HasFactory;

    protected $table = 'guest_details';

    protected $guarded = ['id'];
    protected $fillable = ['concert_id', 'guest_id',];

    public function concert()
    {
        return $this->belongsTo(Concert::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}

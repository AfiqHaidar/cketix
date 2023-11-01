<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $guarded = ['id'];
    protected $fillable = ['tcode', 'catagory_id', 'transaction_id'];

    public function catagory()
    {
        return $this->belongsTo(Catagory::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}

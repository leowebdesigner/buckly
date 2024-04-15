<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'hotel_id',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotels::class);
    }
}

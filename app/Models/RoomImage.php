<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_room',
        'image'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}

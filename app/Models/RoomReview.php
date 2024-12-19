<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomReview extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'customer_id', 'rating', 'review'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function reviews()
    {
        return $this->hasMany(RoomReview::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

}


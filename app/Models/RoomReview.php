<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomReview extends Model
{
    use HasFactory;

    protected $fillable = ['id_room', 'id_customer', 'rating', 'review'];

    public function room()
    {
        return $this->belongsTo(Room::class, 'id_room');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
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


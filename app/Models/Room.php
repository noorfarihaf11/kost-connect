<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_room'; 
    protected $fillable = [
        'id_city',
        'name',
        'room_type',
        'description',
        'price_per_month',
        'address',
        'square_feet',
        'is_available',
        'available_rooms',
        'timestamps'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function house ()
    {
        return $this->belongsTo(BoardingHouse::class, 'id_house');
    }

    public function owner ()
    {
        return $this->belongsTo(User::class, 'id_owner');
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function reservations()
    {
        return $this->hasMany(Transaction::class);
        
    }

    public function testimonials ()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function reviews()
    {
        return $this->hasMany(RoomReview::class, 'id_room');
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}

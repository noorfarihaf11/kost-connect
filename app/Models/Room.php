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
        'name_room',
        'room_type',
        'description',
        'price_per_month',
        'address',
        'square_feet',
        'is_available',
        'available_rooms',
        'timestamps'
    ];

    public function city ()
    {
        return $this->belongsTo(City::class, 'id_city');
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
}

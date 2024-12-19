<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_reservation';
    protected $fillable = [
        'id_reservation',
        'id_room',
        'id_user',
        'reservation_status',
        'reservation_date',
        'phone_number',
        'notes',
        'timestamps'
    ];

    public function room ()
    {
        return $this->belongsTo(Room::class, 'id_room');
    }

    public function user ()
    {
        return $this->belongsTo(User::class, 'id_user','id_user');
    }

    public function customer ()
    {
        return $this->hasOne(Customer::class, 'id_reservation','id_reservation');
    }

}

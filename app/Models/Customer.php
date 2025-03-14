<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_customer';
    protected $fillable = [
        'id_customer',
        'id_reservation',
        'name',
        'email',
        'phone_number',
        'start_date',
        'end_date',
        'customer_status',
        'timestamps'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function reservation()
    {
        return $this->hasOne(Reservation::class, 'id_reservation', 'id_reservation');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_payment');
    }

    public function reviews()
    {
        return $this->hasMany(RoomReview::class, 'id_customer', 'id_customer');
    }
}

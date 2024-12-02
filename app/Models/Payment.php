<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_payment';
    protected $fillable = [
        'id_payment',
        'id_reservation',
        'payment_method',
        'payment_status',
        'total_amount',
        'proof_of_payment',
        'payment_due_date',
        'first_payment_date',
        'timestamps'
    ];

    public function reservation ()
    {
        return $this->belongsTo(Reservation::class, 'id_reservation','id_reservation');
    }

    public function customer ()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

}

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
        'id_payment',
        'name',
        'email',
        'phone_number',
        'start_date',
        'end_date',
        'customer_status',
        'timestamps'
    ];

    public function payment ()
    {
        return $this->belongsTo(Payment::class, 'id_payment');
    }
}

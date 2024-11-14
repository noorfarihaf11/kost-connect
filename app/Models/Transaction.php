<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'id_house',
        'id_room',
        'name',
        'email',
        'phone',
        'payment_method',
        'payment_status',
        'start_date',
        'duration',
        'total_amount',
        'transaction_date'
    ];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}

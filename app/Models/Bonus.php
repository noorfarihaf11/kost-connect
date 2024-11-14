<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_house',
        'image',
        'name_bonus',
        'description'
    ];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    
    }

}

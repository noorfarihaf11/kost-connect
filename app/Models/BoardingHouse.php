<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_house',
        'slug',
        'thumbnail',
        'id_city',
        'id_category',
        'description',
        'price',
        'address',
    ];

   


    public function rooms ()
    {
        return $this->hasMany(Room::class);
    }

    public function bonuses ()
    {
        return $this->hasMany(Bonus::class);
    }
    
   
    
}

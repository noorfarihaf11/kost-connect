<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_city';
    protected $fillable = [
        'name_city',
        'slug'
    ];

    public function boardingHouses ()
    {
        return $this->hasMany(BoardingHouse::class);
    }
}

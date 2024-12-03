<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouse extends Model
{
    use HasFactory;

    protected $table = 'boarding_houses';
    protected $primaryKey = 'id_house';

    protected $fillable = [
        'id_owner',
        'id_city',
        'name',
        'address',
        'gender_type',
        'image',
        'timestamps'
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'id_owner','id_owner');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'id_city','id_city');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'id_house');
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }
}

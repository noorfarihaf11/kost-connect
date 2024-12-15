<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $table = 'owners';
    protected $primaryKey = 'id_owner';

    protected $fillable = [
        'id_user',
        'name',
        'email',
        'password',
        'phone',
        'address',
        'owner_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function boardingHouses()
    {
        return $this->hasMany(BoardingHouse::class, 'id_owner');
    }
}

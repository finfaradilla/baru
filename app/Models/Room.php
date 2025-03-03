<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function room()
    {
        return $this->hasMany(Rent::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function getRouteKeyName()
    {
        return 'code';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function rents()
    {
        return $this->belongsToMany(Rent::class, 'rent_item');
    }

    public function scopeAvailable($query)
    {
        return $query->where('available', true);
    }


}

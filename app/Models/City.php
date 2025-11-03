<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory;

    protected $fillable = [
        'province',
        'city_name'
    ];

    public function getFullNameAttribute()
    {
        return "{$this->province} - {$this->city_name}";
    }
}

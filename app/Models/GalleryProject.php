<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\City;

class GalleryProject extends Model
{
    /** @use HasFactory<\Database\Factories\GalleryProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'project_name',
        'service_id',
        'city_id',
        'slug'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function images()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_project_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'thumbnail',
        'description',
        'slug',
    ];

    public function images()
    {
        return $this->hasMany(ServiceImage::class);
    }

    // Accessor thumbnail biar langsung URL penuh
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail
            ? asset('storage/services/thumbnails/' . basename($this->thumbnail))
            : asset('images/no-image.png'); // fallback jika kosong
    }
}

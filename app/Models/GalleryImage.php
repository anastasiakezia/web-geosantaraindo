<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    /** @use HasFactory<\Database\Factories\GalleryImageFactory> */
    use HasFactory;

    protected $fillable = ['gallery_project_id', 'image_path'];

    public function project()
    {
        return $this->belongsTo(GalleryProject::class, 'gallery_project_id', 'id');
    }
}

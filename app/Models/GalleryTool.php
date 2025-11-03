<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryTool extends Model
{
    /** @use HasFactory<\Database\Factories\GalleryToolFactory> */
    use HasFactory;

    protected $fillable = [
        'service_id',
        'tool_name',
        'description',
        'image_path',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

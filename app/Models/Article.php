<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $fillable = [
        'service_id',
        'title',
        'slug',
        'content',
        'type',
        'image_path',
        'author',
        'schedule_date',
        'published_at',
    ];

    protected $casts = [
        'schedule_date' => 'datetime',
        'published_at'  => 'datetime',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getFirstImage()
    {
        // 1. Thumbnail utama dari image_path
        if (!empty($this->image_path)) {
            return asset('storage/' . $this->image_path);
        }

        // 2. Ambil dari content dengan DOMDocument
        if (!empty($this->content)) {
            libxml_use_internal_errors(true);
            $doc = new \DOMDocument();
            $doc->loadHTML($this->content);
            $tags = $doc->getElementsByTagName('img');
            if ($tags->length > 0) {
                return $tags->item(0)->getAttribute('src');
            }
        }

        // 3. Ambil dari description (kalau ada)
        if (!empty($this->description)) {
            libxml_use_internal_errors(true);
            $doc = new \DOMDocument();
            $doc->loadHTML($this->description);
            $tags = $doc->getElementsByTagName('img');
            if ($tags->length > 0) {
                return $tags->item(0)->getAttribute('src');
            }
        }

        // 4. Fallback default
        return asset('visitor/img/default.jpg');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //auto status update jika sudah lewat schedule_date
    protected static function booted()
    {
        static::retrieved(function ($article) {
            if ($article->schedule_date && now()->gte($article->schedule_date) && $article->status === 'inactive') {
                $article->update(['status' => 'active']);
            }
        });
    }
}

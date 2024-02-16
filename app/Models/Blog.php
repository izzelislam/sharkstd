<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Blog extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        "admin_id", 
        "blog_category_id", 
        "title",
        "slug",
        "content",
        "image_cover",
    ];

    /**
     * fill slug from name field
     *
     * @return SlugOptions
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class);
    }
}

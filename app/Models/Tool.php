<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tool extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        "name", 
        "slug", 
        "image", 
    ];

    /**
     * fill slug from name field
     *
     * @return SlugOptions
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tool', 'tool_id', 'product_id');
    }
}

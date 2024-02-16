<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    protected $fillable = [
        "product_category_id",
        "name",
        "slug",
        "describtion",
        "file_size",
        "file",
        "price",
        "promo",
        "is_free",
        "status",
        "admin_id"
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

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function tools()
    {
        return $this->belongsToMany(Tool::class, 'product_tool', 'product_id', 'tool_id');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'product_feature', 'product_id', 'feature_id');
    }

    public function compatibles()
    {
        return $this->belongsToMany(Compatible::class, 'product_compatible', 'product_id', 'compatible_id');
    }

    public function licenses()
    {
        return $this->belongsToMany(License::class, 'product_license', 'product_id', 'license_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class)  ;
    }


}

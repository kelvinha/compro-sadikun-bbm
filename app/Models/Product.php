<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Models\SeoSetting;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'gallery',
        'product_catalog',
        'short_description',
        'description',
        'price',
        'sale_price',
        'sku',
        'stock',
        'category_id',
        'order',
        'status',
        'featured',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'gallery' => 'array',
        'price' => 'float',
        'sale_price' => 'float',
        'stock' => 'integer',
        'featured' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    /**
     * Get the full URL to the product catalog file.
     *
     * @return string|null
     */
    public function getCatalogUrlAttribute()
    {
        return $this->product_catalog ? asset('storage/' . $this->product_catalog) : null;
    }

    /**
     * Check if the product has a catalog file.
     *
     * @return bool
     */
    public function hasCatalog()
    {
        return !empty($this->product_catalog);
    }

    /**
     * Get the SEO settings for the product.
     */
    public function seo()
    {
        return $this->morphOne(SeoSetting::class, 'seoable');
    }
}

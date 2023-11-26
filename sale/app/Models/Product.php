<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'thumbnail',
        'discount',
        'brand'
    ];

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'product_category',
            'product_id',
            'category_id'
        );
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function addCategories($categoryIds)
    {
        return $this->categories()->attach($categoryIds);
    }

    public function syncCategories($categoryIds)
    {
        return $this->categories()->sync($categoryIds);
    }

    public function scopeCategorySlug($query, $slug)
    {
        return $slug ? $query->whereHas('categories', function ($query) use ($slug){
            $query->where('slug', $slug);
        }) : null;
    }

    public function scopeWithBrand($query, $brand)
    {
        return $brand ? $query->where('brand', $brand) : null;
    }

    public function scopeWithName($query, $name)
    {
        return $name ? $query->where('name', 'like', '%'.$name.'%') : null;
    }

    public function scopeSortPrice($query, $type)
    {
        return $type ? $query->orderBy('price', $type) : null;
    }
}

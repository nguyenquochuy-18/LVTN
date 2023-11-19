<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Category extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = 'categories';
    
    protected $fillable = [
        'name',
        'slug'
    ];

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_category',
            'category_id',
            'product_id'
        );
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}

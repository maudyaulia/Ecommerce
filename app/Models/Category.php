<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}

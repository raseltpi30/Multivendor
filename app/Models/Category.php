<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name', 'category_slug', 'status'];
    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }
}

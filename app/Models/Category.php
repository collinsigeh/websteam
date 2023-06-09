<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_name',
        'slug',
        'is_active',
    ];

    public function banners(): BelongsToMany
    {
        return $this->belongsToMany(Banner::class);
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}

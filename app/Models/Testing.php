<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Testing extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'slug',
        'body',
        'featured_image',
        'tags',
        'primary_category_id',
        'visibility',
        'is_scheduled',
        'publish_at',
        'is_published',
        'published_at',
        'views',
        'user_id',
    ];
}

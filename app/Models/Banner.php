<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Banner extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'featured_image',
        'redirect_url',
        'start_display_at',
        'stop_display_at',
        'is_display_above_page',
        'is_display_in_sidebar',
        'is_display_within_page',
        'is_display_on_homepage',
        'is_display_on_homepage',
        'is_display_on_allsegments',
        'is_active',
        'additional_information',
        'impressions',
        'clicks',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}

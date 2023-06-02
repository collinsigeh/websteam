<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'featured_image',
        'redirect_url',
        'start_display_at',
        'end_display_at',
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
}

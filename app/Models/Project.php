<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'year',
        'color',
        'company',
        'logo_url',
        'site_url',
        'ios_url',
        'android_url',
        'screenshots',
        'main_image',
        'is_published'
    ];

    protected $casts = [
        'screenshots' => 'array',
        'is_published' => 'boolean'
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}

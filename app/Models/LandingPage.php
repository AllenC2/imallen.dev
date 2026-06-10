<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LandingPage extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'view_file',
        'meta_title',
        'meta_description',
        'seo_image',
        'is_default_root',
        'visits',
        'variables',
    ];

    protected function casts(): array
    {
        return [
            'variables' => 'array',
        ];
    }

    protected static function booted()
    {
        static::saving(function ($landingPage) {
            if ($landingPage->is_default_root) {
                // Set all other landing pages to not be the root
                static::where('id', '!=', $landingPage->id)->update(['is_default_root' => false]);
            }
        });
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class)
            ->withPivot('sort_order')
            ->withTimestamps();
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)
            ->withPivot('sort_order')
            ->withTimestamps();
    }
}

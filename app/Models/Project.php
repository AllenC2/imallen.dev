<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'technologies',
        'images',
        'links',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'images' => 'array',
            'links' => 'array',
        ];
    }

    public function landingPages(): BelongsToMany
    {
        return $this->belongsToMany(LandingPage::class)
            ->withPivot('sort_order')
            ->withTimestamps();
    }
}

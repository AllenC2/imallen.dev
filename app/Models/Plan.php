<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    /** @use HasFactory<\Database\Factories\PlanFactory> */
    use HasFactory;

    protected $fillable = ['name', 'price', 'discount_percentage', 'is_popular', 'badge', 'button_text', 'button_url'];

    public function features()
    {
        return $this->hasMany(PlanFeature::class)->orderBy('sort_order');
    }
}

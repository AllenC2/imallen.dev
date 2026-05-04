<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    /** @use HasFactory<\Database\Factories\PlanFeatureFactory> */
    use HasFactory;

    protected $fillable = ['plan_id', 'name', 'is_included', 'sort_order'];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}

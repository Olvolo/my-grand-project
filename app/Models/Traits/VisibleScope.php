<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait VisibleScope
{
    public function scopeVisible(Builder $query): Builder
    {
        if (Auth::check()) {
            return $query;
        }
        return $query->where('is_hidden', false);
    }

    public function scopeHidden(Builder $query): Builder
    {
        return $query->where('is_hidden', true);
    }

    public function scopePublic(Builder $query): Builder
    {
        return $query->where('is_hidden', false);
    }
}

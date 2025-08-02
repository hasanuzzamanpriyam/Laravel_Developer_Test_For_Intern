<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    protected $fillable = ['name', 'country_id'];

    // A state belongs to a country
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    // A state has many cities
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}

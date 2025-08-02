<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    protected $fillable = ['name', 'state_id'];

    // A city belongs to a state
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bargain extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'files' => 'array'
    ];


    public function lots(): HasMany
    {
        return $this->hasMany(Lot::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(Organizer::class);
    }

    public function debtor(): BelongsTo
    {
        return $this->belongsTo(Debtor::class);
    }
}

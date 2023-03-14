<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Debtor extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function bargains(): HasMany
    {
        return $this->hasMany(Bargain::class);
    }

}

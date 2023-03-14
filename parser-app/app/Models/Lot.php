<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'hashName',
        'familiarization',
        'classification',
        'startPrice',
        'deposit',
        'increaseAmount',
        'status',
        'files'
    ];

    protected $casts = [
        'files' => 'array'
    ];

}

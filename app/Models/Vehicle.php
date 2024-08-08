<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'license_plate',
        'brand',
        'model',
        'year',
        'color',
        'garage_id',
    ];

    protected $hidden = [
        'user_id',
    ];

    public function garage(): BelongsTo
    {
        return $this->belongsTo(Garage::class);
    }
}

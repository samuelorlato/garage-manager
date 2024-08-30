<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $primaryKey = 'license_plate';

    protected $fillable = [
        'license_plate',
        'brand',
        'model',
        'year',
        'color',
        'garage_id',
        'user_id',
        'in_garage_since'
    ];

    protected $hidden = [
        'user_id',
    ];

    public function garage(): BelongsTo
    {
        return $this->belongsTo(Garage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

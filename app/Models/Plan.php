<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'features_json',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'features_json' => 'array',
    ];

    /**
     * Get the users for the plan.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}

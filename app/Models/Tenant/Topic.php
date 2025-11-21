<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasFactory;

    protected $connection = 'tenant';

    protected $fillable = [
        'title',
        'youtube_url',
        'youtube_id',
        'thumbnail_url',
        'is_completed',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    /**
     * Get the notes for the topic.
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Get the learning sessions for the topic.
     */
    public function learningSessions(): HasMany
    {
        return $this->hasMany(LearningSession::class);
    }
}

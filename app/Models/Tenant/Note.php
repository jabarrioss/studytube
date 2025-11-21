<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory;

    protected $connection = 'tenant';

    protected $fillable = [
        'topic_id',
        'content',
        'timestamp_seconds',
    ];

    protected $casts = [
        'timestamp_seconds' => 'integer',
    ];

    /**
     * Get the topic that owns the note.
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Format timestamp as MM:SS
     */
    public function getFormattedTimestampAttribute(): string
    {
        $minutes = floor($this->timestamp_seconds / 60);
        $seconds = $this->timestamp_seconds % 60;
        return sprintf('%02d:%02d', $minutes, $seconds);
    }
}

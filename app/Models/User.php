<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Paddle\Billable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'google_id',
        'is_admin',
        'is_pana',
        'plan_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_pana' => 'boolean',
        ];
    }

    /**
     * Boot function to automatically generate UUID
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->uuid)) {
                $user->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the plan that owns the user.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Get topics count from tenant database
     */
    public function topics()
    {
        return \App\Models\Tenant\Topic::on('tenant');
    }

    /**
     * Get notes count from tenant database
     */
    public function notes()
    {
        return \App\Models\Tenant\Note::on('tenant');
    }

    /**
     * Check if the user has an active premium subscription via Paddle.
     * 
     * @return bool
     */
    public function isPremium(): bool
    {
        // Check Paddle subscription first (new system)
        if ($this->subscribed('default')) {
            return true;
        }
        
        // Fallback to old plan_id system (for legacy users)
        if ($this->plan && strtolower($this->plan->name) === 'premium') {
            return true;
        }
        
        return false;
    }
    
    /**
     * Legacy method for backwards compatibility.
     * Use isPremium() for new code.
     *
     * @param string $planName
     * @return bool
     */
    public function subscribedToLegacyPlan(string $planName): bool
    {
        if (!$this->plan) {
            return false;
        }

        return strtolower($this->plan->name) === strtolower($planName);
    }

    /**
     * Check if the user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Check if the user Is Pana.
     */
    public function isPana(): bool
    {
        return $this->is_pana;
    }

    /**
     * Check if the user can access the admin panel.
     * Used for Filament or custom admin panels.
     */
    public function canAccessPanel($panel = null): bool
    {
        return $this->isAdmin();
    }
}

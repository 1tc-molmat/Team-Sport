<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamMember extends Model
{
    protected $fillable = [
        'user_id',
        'team_id',
        'joined_at',
        'role',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
    ];

    /**
     * A csapattag felhasználója
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A csapattag csapata
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}

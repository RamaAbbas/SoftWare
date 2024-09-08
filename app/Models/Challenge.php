<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Challenge extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = "project_challenges";

    public function projects(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function challenges_details(): HasMany
    {
        return $this->hasMany(ChallengeDetail::class, 'challenge_id', 'id');
    }
}

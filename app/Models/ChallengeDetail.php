<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChallengeDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = "project_challenges_details";

    public function challenge(): BelongsTo
    {
        return $this->belongsTo(Challenge::class, 'challenge_id', 'id');
    }

}

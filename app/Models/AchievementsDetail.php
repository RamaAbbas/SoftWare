<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AchievementsDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = "project_achievements_details";

    public function achievement(): BelongsTo
    {
        return $this->belongsTo(Achievement::class, 'achievement_id', 'id');
    }

}

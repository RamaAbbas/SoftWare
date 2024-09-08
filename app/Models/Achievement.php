<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Achievement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = "project_achievements"; //achievements

    public function projects(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function achievement_details(): HasMany
    {
        return $this->hasMany(AchievementsDetail::class, 'achievement_id', 'id');
    }

}

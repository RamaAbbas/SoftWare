<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = "projects";

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function project_images(): HasMany
    {
        return $this->hasMany(ProjectImage::class, 'project_id', 'id');
    }
    public function project_live_links(): HasMany
    {
        return $this->hasMany(ProjectLiveLinks::class, 'project_id', 'id');
    }
    public function project_technologies(): HasMany
    {
        return $this->hasMany(ProjectTechnology::class, 'project_id', 'id');
    }
    public function service_categories(): HasMany
    {
        return $this->hasMany(ServiceCategory::class, 'project_id', 'id');
    }
    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class, 'project_id', 'id');
    }
    public function challenges(): HasMany
    {
        return $this->hasMany(Challenge::class, 'project_id', 'id');
    }
}

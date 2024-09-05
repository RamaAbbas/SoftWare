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


    public function project_images(): HasMany
    {
        return $this->hasMany(ProjectImage::class, 'project_id', 'id');
    }

    public function project_details(): HasMany
    {
        return $this->hasMany(ProjectDetail::class, 'project_id', 'id');
    }
    public function project_services(): HasMany
    {
        return $this->hasMany(ProjectService::class, 'project_id', 'id');
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class, 'project_id', 'id');
    }
    public function results(): HasMany
    {
        return $this->hasMany(Result::class, 'project_id', 'id');
    }
    public function challenges(): HasMany
    {
        return $this->hasMany(Challenge::class, 'project_id', 'id');
    }
    public function client()
    {
        return $this->hasOne(Client::class);
    }
    public function client_review()
    {
        return $this->hasOne(ClientReview::class);
    }
}

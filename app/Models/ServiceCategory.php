<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = "service_categories";

    public function projects(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}

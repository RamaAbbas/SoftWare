<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReview extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = "project_client_reviews";

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

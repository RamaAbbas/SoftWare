<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReview extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = "client_review";

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

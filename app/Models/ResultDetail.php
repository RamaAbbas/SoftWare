<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResultDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = "results_details";

    public function result(): BelongsTo
    {
        return $this->belongsTo(Result::class, 'result_id', 'id');
    }
}

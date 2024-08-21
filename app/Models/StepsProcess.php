<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StepsProcess extends Model
{
    use HasFactory;

    protected $table = "steps_processs";
    protected $guarded = ['id'];



    public function about_us(): BelongsTo
    {
        return $this->belongsTo(AboutUs::class,'about_us_id','id');
    }
}

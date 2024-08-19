<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HowItWork extends Model
{
    use HasFactory;

    protected $table = "service_processs";

    protected $casts = [
        'name_of_step' => 'array',
        'description_of_step' => 'array',
    ];
    protected $guarded = ['id'];
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
}

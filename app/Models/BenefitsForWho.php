<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BenefitsForWho extends Model
{
    use HasFactory;

    protected $table = "benefits_for_whom";
    protected $guarded = ['id'];

    protected $casts = [
        'benefit_name' => 'array',
        'benefit_description' => 'array',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
}

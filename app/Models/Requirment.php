<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Requirment extends Model
{
    use HasFactory;
    protected $table = "requirments";

    protected $guarded = ['id'];

    protected $casts = [
        'descripton_of_requirment' => 'array',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
}

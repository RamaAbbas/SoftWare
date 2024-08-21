<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientTestimonialService extends Model
{
    use HasFactory;

    protected $table = "client_testimonial_services";
    protected $guarded = ['id'];


    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
}

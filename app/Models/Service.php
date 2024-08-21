<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $table = "services";
    protected $guarded = ['id'];


    public function requirment(): HasMany
    {
        return $this->hasMany(Requirment::class, 'service_id', 'id');
    }

    public function service_benefits(): HasMany
    {
        return $this->hasMany(BenefitsForWho::class, 'service_id', 'id');
    }
    public function service_processs(): HasMany
    {
        return $this->hasMany(HowItWork::class, 'service_id', 'id');
    }
    public function client_testimonial(): HasMany
    {
        return $this->hasMany(ClientTestimonialService::class, 'service_id', 'id');
    }
}

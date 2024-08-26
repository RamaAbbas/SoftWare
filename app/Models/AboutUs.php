<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AboutUs extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = "about_us";

    public function steps_process(): HasMany
    {
        return $this->hasMany(StepsProcess::class, 'about_us_id', 'id');
    }

    public function client_testimonial(): HasMany
    {
        return $this->hasMany(ClientTestimonial::class, 'about_us_id', 'id');
    }
    public function for_who_services(): HasMany
    {
        return $this->hasMany(ForWhoService::class, 'about_us_id', 'id');
    }
}

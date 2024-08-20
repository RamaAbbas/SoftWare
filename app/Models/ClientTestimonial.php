<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientTestimonial extends Model
{
    use HasFactory;

    protected $table = "client_testimonials"; //client_testimonials
    protected $guarded = ['id'];

    protected $casts = [
        'testimonial' => 'array',
        'client' => 'array',
    ];

    public function about_us(): BelongsTo
    {
        return $this->belongsTo(AboutUs::class, 'about_us_id', 'id');
    }
}

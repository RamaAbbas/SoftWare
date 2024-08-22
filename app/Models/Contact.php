<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function contacts_messeges(): HasMany
    {
        return $this->hasMany(ContactMessage::class, 'contact_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactsPage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "contacts_page";


    public function contacts_whats_next(): HasMany
    {
        return $this->hasMany(ContactsWhatsNext::class, 'contacts_id', 'id');
    }
}

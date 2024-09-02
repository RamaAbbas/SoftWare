<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactsWhatsNext extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = "contacts_whats_next";

    public function contact_page(): BelongsTo
    {
        return $this->belongsTo(ContactsPage::class,'contacts_id','id');
    }
}

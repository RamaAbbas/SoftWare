<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProcessProcedures extends Model
{
    use HasFactory;

    protected $table = "process_procedures";
    protected $guarded = ['id'];


    public function service_process(): BelongsTo
    {
        return $this->belongsTo(HowItWork::class, 'service_processs_id', 'id');
    }
}

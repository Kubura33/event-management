<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FAQ extends Model
{
    protected $fillable = [
        'event_id',
        'question',
        'answer',
    ];

    public function event() : BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}

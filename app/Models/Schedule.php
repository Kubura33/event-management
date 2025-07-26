<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $event_id
 * @property string $start_time
 * @property string $end_time
 * @property string $title
 * @property string $description
 * @property string $date
 *
 */
class Schedule extends Model
{
    protected $fillable = [
        'event_id',
        'start_time',
        'end_time',
        'title',
        'description',
        'date',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}

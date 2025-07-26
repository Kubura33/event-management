<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $event_id
 * @property string $name
 * @property string $role
 * @property string $bio
 * @property string $linkedin
 * @property string $twitter
 * @property string $website
 * @property string $photo
 */
class Speaker extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'role',
        'bio',
        'linkedin',
        'twitter',
        'website',
        'photo',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}

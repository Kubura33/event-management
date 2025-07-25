<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class Event
 *
 * @property int $id
 * @property string $title
 * @property string $date
 * @property int $capacity
 * @property string $slug
 * @property string $image
 * @property float $price
 * @property string $address
 * @property string $city
 * @property string $country
 * @property string|null $zipcode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'capacity',
        'date',
        'slug',
        'image',
        'price',
        'address',
        'city',
        'country',
        'zipcode',
    ];

    protected $appends = ['imageUrl', 'attendees'];

    protected static function booted()
    {
        static::creating(function ($article) {
            $article->slug = static::generateUniqueSlug($article->title);
        });
    }

    public static function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }

    public function getImageUrlAttribute(): ?string
    {
        $value = $this->image;
        if(!Str::startsWith($value, 'http')) {
            $value = asset(Storage::url($this->image));
        }
        return $value;
    }

    public function getAttendeesAttribute(): int
    {
        return $this->attendees()->count();
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function attendees(): HasMany
    {
        return $this->hasMany(Attendee::class, 'event_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when($filters['searchQuery'] ?? null,
            fn (Builder $query, $search): Builder => $query->whereAny(['title', 'description', 'address', 'city', 'country', 'zipcode'], 'LIKE', "%{$search}%"))
            ->when($filters['categories'] ?? null,
                fn (Builder $query, $categoryId): Builder => $query->whereIn('category_id', $categoryId)
            )
            ->when(!empty($filters['locations']) && is_array($filters['locations']),
                fn (Builder $query) => $query->location($filters['locations'])
            )
            ->when($filters['minPrice'] ?? null, fn($q, $v) => $q->where('price', '>=', $v))
            ->when($filters['maxPrice'] ?? null, fn($q, $v) => $q->where('price', '<=', $v))
            ->when($filters['dateRange'] ?? null, fn($q, $v) => $q->whereBetween('date', [now()->startOfDay(), now()->addDays((int)$v)->endOfDay()]));
    }

    public function scopeLocation(Builder $query, array $locations): Builder
    {
        return $query->where(function ($q) use ($locations) {
            foreach ($locations as $location) {
                if (str_contains($location, ',')) {
                    [$city, $country] = array_map('trim', explode(',', $location));
                    $q->orWhere(function ($q2) use ($city, $country) {
                        $q2->where('city', 'LIKE', "%{$city}%")
                            ->orWhere('country', 'LIKE', "%{$country}%");
                    });
                } else {
                    $q->orWhere('city', 'LIKE', "%{$location}%")
                        ->orWhere('country', 'LIKE', "%{$location}%");
                }
            }
        });
    }

    public function scopeFree(Builder $query): Builder
    {
        return $query->where('price', '=', null)
            ->orWhere('price', '=', 0);
    }

    public function scopeOnline(Builder $query): Builder
    {
        return $query->where('location', '!=', null);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query;
    }

}

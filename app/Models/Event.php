<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}

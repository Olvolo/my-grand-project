<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Article> $articles
 * @property-read int|null $articles_count
 *
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category whereSlug($value)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @method static Builder|Category firstOrCreate(array $attributes, array $values = [])
 * @method static Builder|Category create(array $attributes = []) // PHPDoc для create
 * @method static Builder|Category where(string $column, string $operator = null, mixed $value = null) // PHPDoc для where
 * @mixin Builder
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $casts = [
        // Здесь могут быть дополнительные приведения типов, если нужны
    ];

    /**
     * Automatically generate a slug from the name if not provided.
     *
     * @param string $value
     * @return void
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = $value;
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    /**
     * Get the route key for the model.
     * Используем slug вместо ID для маршрутов
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Get the articles for the category.
     */
    public function articles(): HasMany // <-- ЭТОТ МЕТОД НУЖЕН
    {
        return $this->hasMany(Article::class);
    }
}

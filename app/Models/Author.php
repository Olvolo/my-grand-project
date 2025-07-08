<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $bio
 * @property string|null $photo
 * @property bool $is_teacher
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Book> $books
 * @property-read int|null $books_count
 * @property-read Collection<int, Article> $articles
 * @property-read int|null $articles_count
 *
 * @method static Builder|Author newModelQuery()
 * @method static Builder|Author newQuery()
 * @method static Builder|Author query()
 * @method static Builder|Author whereId($value)
 * @method static Builder|Author whereName($value)
 * @method static Builder|Author whereSlug($value)
 * @method static Builder|Author whereBio($value)
 * @method static Builder|Author wherePhoto($value)
 * @method static Builder|Author whereIsTeacher($value)
 * @method static Builder|Author whereCreatedAt($value)
 * @method static Builder|Author whereUpdatedAt($value)
 * @method static Builder|Author firstOrCreate(array $attributes, array $values = [])
 * @mixin Builder
 */
class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'bio',
        'photo',
        'is_teacher',
    ];

    protected $casts = [
        'is_teacher' => 'boolean',
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
     * Get the books written by the Author.
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_author', 'author_id', 'book_id');
    }

    /**
     * Get the articles written by the Author.
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_author', 'author_id', 'article_id');
    }
}

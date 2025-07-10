<?php

namespace App\Models;

use App\Models\Traits\VisibleScope;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string|null $cover_image
 * @property string|null $publication_year
 * @property string $language
 * @property string|null $publisher
 * @property bool $is_hidden
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Author> $authors
 * @property-read int|null $authors_count
 * @property-read Collection<int, Chapter> $chapters
 * @property-read int|null $chapters_count
 * @property-read Collection<int, Chapter> $visibleChapters
 * @property-read int|null $visible_chapters_count
 *
 * @method static Builder|Book visible()
 * @method static Builder|Book newModelQuery()
 * @method static Builder|Book newQuery()
 * @method static Builder|Book query()
 * @method static Builder|Book whereId($value)
 * @method static Builder|Book whereTitle($value)
 * @method static Builder|Book whereSlug($value)
 * @method static Builder|Book whereDescription($value)
 * @method static Builder|Book whereCoverImage($value)
 * @method static Builder|Book wherePublicationYear($value)
 * @method static Builder|Book whereLanguage($value)
 * @method static Builder|Book wherePublisher($value)
 * @method static Builder|Book whereIsHidden($value)
 * @method static Builder|Book whereCreatedAt($value)
 * @method static Builder|Book whereUpdatedAt($value)
 * @method static Builder|Book create(array $attributes = [])
 * @method static Builder|Book where(string $column, string $operator = null, mixed $value = null)
 * @mixin Builder
 */
class Book extends Model
{
    use HasFactory, VisibleScope;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',
        'publication_year',
        'language',
        'publisher',
        'is_hidden',
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
    ];

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
     * Get the authors that wrote the Book.
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'book_author', 'book_id', 'author_id');
    }

    /**
     * Get all chapters for the Book (used in eager loading and for admin).
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class)->orderBy('order');
    }

    /**
     * Get visible chapters for the Book based on user authentication.
     */
    public function visibleChapters(): HasMany
    {
        return $this->chapters()
            ->when(!auth()->check(), function ($query) {
                $query->where('is_hidden', false);
            });
    }
}

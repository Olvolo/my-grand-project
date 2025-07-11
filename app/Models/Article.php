<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Models\Traits\VisibleScope;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;


/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $content_html
 * @property string|null $content_markdown
 * @property Carbon|null $published_at
 * @property bool $is_hidden
 * @property int|null $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Author|null $author // Если у вас есть author_id и BelongsTo Author
 * @property-read Collection<int, Author> $authors
 * @property-read int|null $authors_count
 * @property-read Category|null $category
 * @property-read Collection<int, Tag> $tags
 * @property-read int|null $tags_count
 *
 * @method static Builder|Article visible()
 * @method static Builder|Article newModelQuery()
 * @method static Builder|Article newQuery()
 * @method static Builder|Article query()
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereTitle($value)
 * @method static Builder|Article whereSlug($value)
 * @method static Builder|Article whereContent($value)
 * @method static Builder|Article wherePublishedAt($value)
 * @method static Builder|Article whereIsHidden($value)
 * @method static Builder|Article whereCategoryId($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereUpdatedAt($value)
 * @method static Builder|Article create(array $attributes = [])
 * @method static Builder|Article where(string $column, string $operator = null, mixed $value = null)
 * @method static Builder|Article firstOrCreate(array $attributes, array $values = []) // Добавлено для firstOrCreate
 * @mixin Builder
 */
class Article extends Model
{
    use HasFactory, VisibleScope, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content_html',
        'content_markdown',
        'published_at',
        'is_hidden',
        'category_id',
        'order_column',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
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
     * Get the authors that wrote the Article.
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'article_author', 'article_id', 'author_id');
    }

    /**
     * Get the category that owns the Article.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the tags associated with the Article.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id');
    }


}

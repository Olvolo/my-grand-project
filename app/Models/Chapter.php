<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property int $book_id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property int $order
 * @property bool $is_hidden
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Book $book
 *
 * @method static Builder|Chapter newModelQuery()
 * @method static Builder|Chapter newQuery()
 * @method static Builder|Chapter query()
 * @method static Builder|Chapter whereId($value)
 * @method static Builder|Chapter whereBookId($value)
 * @method static Builder|Chapter whereTitle($value)
 * @method static Builder|Chapter whereSlug($value)
 * @method static Builder|Chapter whereContent($value)
 * @method static Builder|Chapter whereOrder($value)
 * @method static Builder|Chapter whereIsHidden($value)
 * @method static Builder|Chapter whereCreatedAt($value)
 * @method static Builder|Chapter whereUpdatedAt($value)
 * @method static Builder|Chapter create(array $attributes = [])
 * @method static Builder|Chapter where(string $column, string $operator = null, mixed $value = null)
 * @method static Builder|Chapter firstOrCreate(array $attributes, array $values = []) // Добавлено для firstOrCreate
 * @mixin Builder
 */
class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'title',
        'slug',
        'content',
        'order',
        'is_hidden',
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
    ];

    /**
     * Automatically generate a slug from the title if not provided.
     *
     * @param string $value
     * @return void
     */
    public function setTitleAttribute(string $value): void
    {
        $this->attributes['title'] = $value;
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
     * Get the book that owns the Chapter.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the next chapter in the same book.
     */
    public function nextChapter(): ?Chapter
    {
        return static::where('book_id', $this->book_id)
            ->where('order', '>', $this->order)
            ->orderBy('order')
            ->first();
    }

    /**
     * Get the previous chapter in the same book.
     */
    public function previousChapter(): ?Chapter
    {
        return static::where('book_id', $this->book_id)
            ->where('order', '<', $this->order)
            ->orderBy('order', 'desc')
            ->first();
    }
}

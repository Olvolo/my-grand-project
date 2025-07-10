<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Models\Traits\VisibleScope;
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
 * @property string|null $content_html
 * @property string|null $content_markdown
 * @property int $order
 * @property bool $is_hidden
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Book $book
 *
 * @method static Builder|Chapter visible()
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
 * @method static Builder|Chapter firstOrCreate(array $attributes, array $values = [])
 * @mixin Builder
 */
class Chapter extends Model
{
    use HasFactory, VisibleScope, Searchable;

    protected $fillable = [
        'book_id',
        'title',
        'slug',
        'content_html',
        'content_markdown',
        'order',
        'is_hidden',
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
    ];

    /**
     * Bootstrap model events.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function (Chapter $chapter) {
            if (empty($chapter->slug)) {
                $chapter->slug = static::generateUniqueSlug($chapter->title, $chapter->book_id);
            }
        });

        static::updating(function (Chapter $chapter) {
            if ($chapter->isDirty('title') && empty($chapter->slug)) {
                $chapter->slug = static::generateUniqueSlug($chapter->title, $chapter->book_id, $chapter->id);
            }
        });
    }

    /**
     * Generate a unique slug for the given title and book.
     *
     * @param string $title
     * @param int $bookId
     * @param int|null $excludeId
     * @return string
     */
    private static function generateUniqueSlug(string $title, int $bookId, ?int $excludeId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)
            ->where('book_id', $bookId)
            ->when($excludeId, fn($query) => $query->where('id', '!=', $excludeId))
            ->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
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
        return static::visible()
            ->where('book_id', $this->book_id)
            ->where('order', '>', $this->order)
            ->orderBy('order')
            ->first();
    }

    /**
     * Get the previous chapter in the same book.
     */
    public function previousChapter(): ?Chapter
    {
        return static::visible()
            ->where('book_id', $this->book_id)
            ->where('order', '<', $this->order)
            ->orderBy('order', 'desc')
            ->first();
    }
}

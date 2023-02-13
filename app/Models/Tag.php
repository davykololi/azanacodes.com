<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Support\Str;
use App\Casts\TimestampsCast;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, Sluggable, Searchable;

    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $fillable = ['name','description','keywords','slug'];
    protected $with = ['articles'];
    protected $casts = ['name'=>TimestampsCast::class,'description'=>TimestampsCast::class];
    const EXCERPT_LENGTH = 100;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Get the index name for the model.
    */
    public function searchableAs()
    {
        return 'tags_index';
    }

    public function articles(): BelongsToMany
    {
    	return $this->belongsToMany(Article::class,'article_tag')->withTimestamps();
    }

    public function excerpt()
    {
        return Str::limit(strip_tags($this->description),Tag::EXCERPT_LENGTH);
    }

    public function path()
    {
        return route('tag.articles', $this->slug);
    }

    public function scopeEagerLoaded($query)
    {
        return $query->with('articles');
    }

    public function getAll()
    {
        return static::eagerLoaded()->get();
    }

    public function tagId($id)
    {
        return static::findOrFail($id);
    }

    public function deleteTag($id)
    {
        return static::destroy($id);
    }

    public function paginated()
    {
        return static::latest()->paginate(config('blog.articles_per_page'));
    }

    public function tagSlug($slug)
    {
        return static::query()->whereSlug($slug)->first();
    }

    public function tagWithArticles()
    {
        return static::with('articles')->get();
    }
}

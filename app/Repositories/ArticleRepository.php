<?php

namespace App\Repositories;

use App\Interfaces\ArticleInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\ArticleException\ArticleNotFoundException;
use App\Models\Article;

class ArticleRepository implements ArticleInterface
{
    protected $model;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    /**
     * Return new instance of the Query Builder for this model.
     */
    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    public function all()
    {
        return $this->model->eagerLoaded()->latest()->paginate(config('blog.articles_per_page'));
    }

    public function authArticles()
    {
        return auth()->user()->articles()->eagerLoaded()->latest()->paginate(5);
    }

    public function create(array $data)
    {
        return $this->query()->create($data);
    }

    public function getId(int $id): Article
    {
        try {
            // the published_at + is_published are handled by BlogEtcPublishedScope, and don't take effect if the
            // logged in user can manage log posts
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ArticleNotFoundException('Unable to find blog post with id: '.$id);
        }
    }

    public function update(array $data,$id)
    {
        $record = $this->getId($id);
        return $record->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function randonmPublishedTwo()
    {
        return $this->query()->model->eagerLoaded()->published()->inRandomOrder()->take(2)->get();
    }

    public function latestPublishedFive()
    {
        return $this->query()->model->eagerLoaded()->latest()->published()->take(5)->get();
    }

    public function articleSlug(string $slug)
    {
        try {
            // the published_at + is_published are handled by BlogEtcPublishedScope, and don't take effect if the
            // logged in user can manage log posts
            return $this->query()->model->eagerLoaded()->published()->whereSlug($slug)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new ArticleNotFoundException('Unable to find blog post with slug: '.$slug);
        } 
    }

    public function allPublishedArticles()
    {
        return $this->query()->model->eagerLoaded()->published()->latest()->get();
    }
}
<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Interfaces\TagInterface;
use App\Exceptions\TagException\TagNotFoundException;
use Illuminate\Database\Eloquent\Builder;

class TagRepository implements TagInterface
{
	protected $model;
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Tag $model)
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
        return $this->model->getAll();
    }

    public function paginated()
    {
        return $this->model->paginated();
    }

    public function create(array $data)
    {
    	return $this->query()->create($data);
    }

    public function getId($id): Tag
    {
        try {
            // the published_at + is_published are handled by BlogEtcPublishedScope, and don't take effect if the
            // logged in user can manage log posts
            return $this->model->tagId($id);
        } catch (ModelNotFoundException $e) {
            throw new TagNotFoundException('Unable to find tag with id: '.$id);
        }

    }

    public function update(array $data,$id)
    {
        $record = $this->getId($id);
    	return $record->update($data);
    }

    public function delete($id)
    {
    	return $this->model->deleteTag($id);
    }

    public function tagSlug(string $slug): Tag
    {
        try {
            // the published_at + is_published are handled by BlogEtcPublishedScope, and don't take effect if the
            // logged in user can manage log posts
            return $this->query()->tagSlug($slug);
        } catch (ModelNotFoundException $e) {
            throw new TagNotFoundException('Unable to find tag with slug: '.$slug);
        }
    }

    public function tagWithArticles()
    {
        return $this->query()->tagWithArticles();
    }
}
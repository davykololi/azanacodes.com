<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryInterface;
use App\Exceptions\CategoryException\CategoryNotFoundException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class CategoryRepository implements CategoryInterface
{
	protected $model;
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $model)
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

    public function getId(int $id): Category
    {
        try {
            return $this->model->categoryId($id);
        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException('Unable to find a blog category with ID: '.$id);
        }
    }

    public function update(array $data,$id)
    {
        $record = $this->getId($id);
    	return $record->update($data);
    }

    public function delete(int $id)
    {
        try {
            return $this->model->deleteCategory($id);
        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException('Unable to find a blog category with ID: '.$id);
        }
    }

    public function categorySlug(string $slug): Category
    {
        try {
            return $this->query()->categorySlug($slug);
        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException('Unable to find a blog category with slug: '.$slug);
        }
    }

    public function categoryWithArticles()
    {
        return $this->query()->categoryWithArticles();
    }

    public function laravelCategory()
    {
        return $this->query()->laravelCategory();
    }

    public function vueJsCategory()
    {
        return $this->query()->vueJsCategory();
    }

    public function reactJsCategory()
    {
        return $this->query()->reactJsCategory();
    }

    public function tailwindCssCategory()
    {
        return $this->query()->tailwindCssCategory();
    }
}
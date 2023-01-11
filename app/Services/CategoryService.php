<?php

namespace App\Services;

use App\Repositories\CategoryRepository as CategoryRepo;
use App\Http\Requests\CategoryFormRequest as StoreRequest;
use App\Http\Requests\CategoryFormRequest as UpdateRequest;

class CategoryService
{
	protected $categoryRepo;

	public function __construct(CategoryRepo $categoryRepo)
	{
		$this->categoryRepo = $categoryRepo;
	}

	public function all()
	{
		return $this->categoryRepo->all();
	}

	public function paginated()
	{
		return $this->categoryRepo->paginated();
	}

	public function create(StoreRequest $request)
	{
		$data = $request->validated();

		return $this->categoryRepo->create($data);
	}

	public function getId($id)
	{
		return $this->categoryRepo->getId($id);
	}

	public function update(UpdateRequest $request,$id)
	{
		$data = $request->validated();

		return $this->categoryRepo->update($data,$id);
	}

	public function delete($id)
	{
		return $this->categoryRepo->delete($id);
	}
}
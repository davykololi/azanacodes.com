<?php

namespace App\Services;

use App\Repositories\TagRepository as TagRepo;
use App\Http\Requests\TagFormRequest as StoreRequest;
use App\Http\Requests\TagFormRequest as UpdateRequest;

class TagService
{
	protected $tagRepo;

	public function __construct(TagRepo $tagRepo)
	{
		$this->tagRepo = $tagRepo;
	}

	public function all()
	{
		return $this->tagRepo->all();
	}

	public function paginated()
	{
		return $this->tagRepo->paginated();
	}

	public function create(StoreRequest $request)
	{
		$data = $request->validated();

		return $this->tagRepo->create($data);
	}

	public function getId($id)
	{
		return $this->tagRepo->getId($id);
	}

	public function update(UpdateRequest $request,$id)
	{
		$data = $request->validated();

		return $this->tagRepo->update($data,$id);
	}

	public function delete($id)
	{
		return $this->tag->delete($id);
	}
}
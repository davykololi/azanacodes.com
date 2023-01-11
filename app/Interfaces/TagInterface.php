<?php 

namespace App\Interfaces;

interface TagInterface
{
	public function all();

	public function paginated();

	public function create(array $data);

	public function getId($id);

	public function update(array $data,$id);

	public function delete($id);

	public function tagSlug(string $slug);

	public function tagWithArticles();
}
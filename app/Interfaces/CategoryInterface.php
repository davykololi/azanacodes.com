<?php 

namespace App\Interfaces;

interface CategoryInterface
{
	public function all();

	public function paginated();

	public function create(array $data);

	public function getId(int $id);

	public function update(array $data,$id);

	public function delete(int $id);

	public function categorySlug(string $slug);

	public function categoryWithArticles();

	public function laravelCategory();

	public function vueJsCategory();

	public function reactJsCategory();

	public function tailwindCssCategory();
}
<?php 

namespace App\Interfaces;

interface ArticleInterface
{
	public function all();

	public function authArticles();

	public function create(array $data);

	public function getId(int $id);

	public function update(array $data,$id);

	public function delete(int $id);

	public function randonmPublishedTwo();

	public function latestPublishedFive();

	public function articleSlug(string $slug);

	public function allPublishedArticles();
}
<?php

namespace App\Services;

use Auth;
use App\Repositories\ArticleRepository;
use App\Traits\ImageUploadTrait;
use App\Http\Requests\ArticleFormRequest;
class ArticleService
{
	use ImageUploadTrait;
	protected $articleRepo;

	public function __construct(ArticleRepository $articleRepo)
	{
		$this->articleRepo = $articleRepo;
	}

	public function all()
	{
		return $this->articleRepo->all();
	}

	public function authArticles()
	{
		return $this->articleRepo->authArticles();
	}

	public function getId($id)
	{
		return $this->articleRepo->getId($id);
	}

	public function data(ArticleFormRequest $request)
	{
		$data = $request->validated();
        $data['image'] = $this->verifyAndUpload($request,'image','/storage/storage/');
        $data['category_id'] = $request->category_id;
        if(Auth::user()->isEditor()){
        	$data['is_published']  = $request->has('publish');
        	$data['user_id'] = $request->user_id;
        	$data['published_by'] = Auth::user()->name;
        	$data['published_at'] = $request->published_at;
        }

        if(Auth::user()->isAuthor()){
        	$data['user_id'] = auth()->user()->id;
        }
        
        return $data;
	}

	public function createArticle(ArticleFormRequest $request)
	{
		$data = $this->data($request);

		return $this->articleRepo->create($data);
	}

	public function updateArticle(ArticleFormRequest $request,$id)
	{
		$data = $this->data($request,$id);

		return $this->articleRepo->update($data,$id);;
	}

	public function deleteArticle($id)
	{
		return $this->articleRepo->delete($id);
	}
}
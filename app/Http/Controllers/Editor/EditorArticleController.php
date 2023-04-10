<?php

namespace App\Http\Controllers\Editor;

use Auth;
use Storage;
use App\Models\User;
use App\Services\ArticleService;
use App\Services\CategoryService;
use App\Services\TagService;
use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleFormRequest as UpdateRequest;

class EditorArticleController extends Controller
{
    protected $articleService;
    protected $categoryService;
    protected $tagService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleService $articleService,CategoryService $categoryService,TagService $tagService)
    {
        $this->articleService = $articleService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles =  $this->articleService->all(); 
        $title = 'Editor View Articles';
        
        return view('editor.articles.index',compact('articles','title'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $article = $this->articleService->getId($id);
        if(Auth::user()->isEditor() && $article){
            $articleTags = $article->tags;
            $this->articleService->getId($id)->increment('total_views');
            $title = 'Editor View Article';
            
            return view('editor.articles.show',compact('article','title','articleTags'));
        } else {
            toastr()->error(ucwords('You have no sufficient permission to view this article'));

            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $article = $this->articleService->getId($id);
        $categories = $this->categoryService->all();
        $tags = $this->tagService->all()->pluck('name','id');
        $articleTags = $article->tags;
        $authors = User::whereRole(UserRoleEnum::Author)->get();
        $title = 'Editor Edit Article';

        return view('editor.articles.edit',compact('article','categories','tags','articleTags','authors','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        //
        try{
            DB::beginTransaction();
            $article = $this->articleService->getId($id);
            if(!$article && !Auth::user()->isEditor()){
                DB::rollBack();
                toastr()->error(ucwords('Something went wrong. Please try again'));

                return back();
            }
            DB::commit();
            Storage::delete('public/storage/'.$article->image);
            $this->articleService->updateArticle($request,$id);
            $tags = $request->tags;
            $article->tags()->sync($tags);
            toastr()->success(ucwords($article->title." ".'Article updated successfully'));

            return redirect()->route('editor.articles.index');
        } catch (\Throwable $th){
            DB::rollBack();
            throw $th;
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete the article with image
        try{
            DB::beginTransaction();
            $article = $this->articleService->getId($id);
            if(!$article && !Auth::user()->isEditor()){
                DB::rollBack();
                toastr()->error(ucwords('Something went wrong. Please try again'));

                return back();
            }
            
            DB::commit();
            Storage::delete('public/storage/'.$article->image);
            $this->articleService->deleteArticle($id);
            $article->tags()->detach();
            toastr()->success(ucwords($article->title." ".'Article deleted successfully'));
            
            return redirect()->route('editor.articles.index');

        } catch(\Throwable $th){
            DB::rollBack();
            throw $th;
        }
    }
}

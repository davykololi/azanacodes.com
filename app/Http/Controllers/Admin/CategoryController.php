<?php

namespace App\Http\Controllers\Admin;

use App\Services\CategoryService;
use App\Http\Requests\CategoryFormRequest as StoreRequest;
use App\Http\Requests\CategoryFormRequest as UpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = $this->categoryService->paginated();
        $title = 'Categories';

        return view('admin.categories.index',compact('categories','title'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Create Category';
        return view('admin.categories.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //
        $category = $this->categoryService->create($request);
        toastr()->success(ucwords($category->name." ".'Category created successfully'));

        return redirect()->route('admin.categories.index');
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
        $category = $this->categoryService->getId($id);
        $title = 'Category Details';

        return view('admin.categories.show',compact('category','title'));
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
        $category = $this->categoryService->getId($id);
        $title = 'Edit Category';

        return view('admin.categories.edit',compact('category','title'));
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
        $category = $this->categoryService->getId($id);
        $this->categoryService->update($request,$id);
        toastr()->success(ucwords($category->name." ".'Category updated successfully'));

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = $this->categoryService->getId($id);
        $this->categoryService->delete($id);
        toastr()->success(ucwords($category->name." ".'Category deleted successfully'));

        return redirect()->route('admin.categories.index');
    }
}

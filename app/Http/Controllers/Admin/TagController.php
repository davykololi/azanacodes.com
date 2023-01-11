<?php

namespace App\Http\Controllers\Admin;

use App\Services\TagService;
use App\Http\Requests\TagFormRequest as StoreRequest;
use App\Http\Requests\TagFormRequest as UpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TagService $tagService)
    {
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
        $tags = $this->tagService->paginated();
        $title = 'Tags';

        return view('admin.tags.index',compact('tags','title'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Create Tags';
        return view('admin.tags.create',compact('title'));
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
        $tag = $this->tagService->create($request);
        toastr()->success(ucwords($tag->name." ".'tag created successfully'));

        return redirect()->route('admin.tags.index');
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
        $tag = $this->tagService->getId($id);
        $title = 'Tag Details';

        return view('admin.tags.show',compact('tag','title'));
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
        $tag = $this->tagService->getId($id);
        $title = 'Edit Tag';

        return view('admin.tags.edit',compact('tag','title'));
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
        $tag = $this->tagService->getId($id);
        $this->tagService->update($request,$id);
        toastr()->success(ucwords($tag->name." ".'tag updated successfully'));

        return redirect()->route('admin.tags.index');
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
        $tag = $this->tagService->getId($id);
        $this->tagService->delete($id);
        toastr()->success(ucwords($tag->name." ".'tag deleted successfully'));

        return redirect()->route('admin.tags.index');
    }
}

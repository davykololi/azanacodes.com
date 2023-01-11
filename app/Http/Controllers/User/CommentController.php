<?php

namespace App\Http\Controllers\User;

use Auth;
use Artisan;
use App\Models\Comment;
use App\Http\Requests\CommentFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentFormRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['article_id'] = $request->article_id;
        Comment::create($data);
        Artisan::call('cache:clear');

        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontEndUsersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        $frontEndUsers = User::where('role','user')->latest()->paginate(5);
        $title = 'Front End Users';

        return view('admin.front_end_users.index',compact('frontEndUsers','title'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}

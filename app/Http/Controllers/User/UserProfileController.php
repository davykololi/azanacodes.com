<?php

namespace App\Http\Controllers\User;

use Auth;
use Artisan;
use Storage;
use App\Enums\UserRoleEnum;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
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

    public function visitorProfile()
    {
    	$user = Auth::user()->whereRole(UserRoleEnum::Visitor)->firstOrFail();

    	return view('user.profile',compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
                        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        ]);
        $user = Auth::user();
        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('avatars',$avatarName);

        if($user){
        Storage::delete('avatars/{!! $user->avatar !!}');
        $data = $request->all();
        $data['image'] = $avatarName;
        $data['user_id'] = $user->id;
        $profile = Profile::create($data);

        return back()->withSuccess('You have successfully created your profile!');
        }
    }
}

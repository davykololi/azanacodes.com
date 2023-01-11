<?php

namespace App\Http\Controllers\Author;

use Auth;
use Artisan;
use Storage;
use App\Enums\UserRoleEnum;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorProfileController extends Controller
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

    public function profileDashboard()
    {
    	$user = Auth::user()->whereRole(UserRoleEnum::Author)->with('profile')->firstOrFail();
        $title = 'Author Profile';

    	return view('author.profile._dashboard',compact('user','title'));
    }

    public function store(Request $request)
    {
        $request->validate([
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        ]);
        $user = Auth::user();
        $avatarName = $user->id.'_image'.time().'.'.request()->image->getClientOriginalExtension();
        $request->image->storeAs('avatars',$avatarName,['disk'=>'public']);
        $data = $request->all();
        $data['image'] = $avatarName;
        $data['user_id'] = $user->id;
        Profile::create($data);
        Artisan::call('cache:clear');

        return back()->withSuccess('You have successfully created your profile!');
    }

    public function update(Request $request,Profile $profile)
    {
        $request->validate([
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        ]);
        $user = Auth::user();
        $avatarName = $user->id.'_image'.time().'.'.request()->image->getClientOriginalExtension();
        $request->image->storeAs('avatars',$avatarName,['disk'=>'public']);
        if($user){
        Storage::delete('public/avatars/'.$user->profile->image);
        $data = $request->all();
        $data['image'] = $avatarName;
        $data['user_id'] = $user->id;
        $profile->update($data);
        Artisan::call('cache:clear');

        return to_route('author.profile.dashboard')->withSuccess('You have successfully updated your profile!');
        }
    }
}

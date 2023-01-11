<?php

namespace App\Http\Controllers\Admin;

use Artisan;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserBanController extends Controller
{
    //
    public function ban(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $input['banned_at'] = Carbon::now();
        $user->ban([
            'comment' => 'You have been banned by the adminitrator',
        ]);
        $user->update($input);
        toastr()->success(ucwords($user->name." ".'banned successfully'));
        Artisan::call('cache:clear');

        return back();
    }

    public function revoke($id)
    {
        $user = User::findOrFail($id);
        if(!empty($user)){
            $user->unban();
            toastr()->success(ucwords($user->name." ".' banned status revoked successfully'));
            Artisan::call('cache:clear');

            return back();
        }
            toastr()->error(ucwords('There was an error in revoking the ban. Try again!'));

            return back();
    }
}

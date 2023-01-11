<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImpersonateController extends Controller
{
    //
    public function impersonate($id)
    {
    	if($id != ''){
    		$user = User::find($id);
    		Auth::user()->impersonate($user);
            toastr()->success(ucwords('Whoo!, You are now impersonating'." ".$user->name.'!'));

    		return redirect('/login');
    	}
    	return redirect()->back();
    }

    public function impersonateLeave()
    {
    	Auth::user()->leaveImpersonation();
        toastr()->success(ucwords('Left impersonation zone successfully'));

    	return redirect('/login');
    }
}

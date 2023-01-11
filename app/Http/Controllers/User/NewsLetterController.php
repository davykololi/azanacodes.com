<?php

namespace App\Http\Controllers\User;

use Newsletter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    //
    public function store(Request $request)
    {
    	if(!Newsletter::isSubscribed($request->email)){
    		Newsletter::subscribePending($request->email);

    		return redirect('newsletter')->withSuccess('Thanks For Subscribing');
    	}

    	return('newsletter')->withError('Sorry! You have already subscribed');
    }
}

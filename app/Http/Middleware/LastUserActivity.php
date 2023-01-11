<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online-'.Auth::user()->id,true,$expiresAt);
            User::where('id',Auth::user()->id)->update(['last_seen' => Carbon::now()]);
        }

        return $next($request);
    }
}

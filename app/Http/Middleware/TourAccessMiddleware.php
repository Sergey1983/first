<?php

namespace App\Http\Middleware;

use App\Tour;

use App\previous_tour_tourist;

use Closure;

class TourAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)

    {


        $user = $request->user();
        $tour = $request->tour;


        if(($user->permission !=1) && ($tour->user->id != $user->id)) {

            return redirect('/');
        }


        elseif((!$user->isAdmin()) && ($tour->branch != $user->branch)) {

            if($tour->user->id != $user->id) {

            return redirect('/');

            }
        }

        return $next($request);
    }
}
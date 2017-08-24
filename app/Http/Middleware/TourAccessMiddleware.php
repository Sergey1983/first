<?php

namespace App\Http\Middleware;

use App\Tour2;

use App\previoustour2_tourist;

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

        // dump($request->user()->tours);
        // dump($request->id);
        // dump(Tour2::find($request->id));
        // dump($request->user()->tours->contains(Tour2::find($request->id)));


        $user = $request->user();
        $id = $request->id;


        if (!($user->role_id == 1 OR $user->permission == 1))  {

            if ($user->tours->count()==0) {

                return redirect('/');
            }  

            elseif (previoustour2_tourist::where('tour2_id', $id)->get()->count() == 0) {

                if(!($user->tours->contains(Tour2::find($id))) ) {

                    return redirect('/');

                }

            }

            elseif($user->previoustour2_tourist->count()==0) {

                return redirect('/');

            }

            elseif(!Tour2::find($id)->previoustour2_tourist->sortBy('this_version')->first()->user->is($user))

                {
                    return redirect('/');
                }

            }

        return $next($request);
    }
}

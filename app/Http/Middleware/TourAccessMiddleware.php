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

        // dump($request->user()->tours);
        // dump($request->id);
        // dump(Tour::find($request->id));
        // dump($request->user()->tours->contains(Tour::find($request->id)));


        $user = $request->user();
        $id = $request->id;


        if (!($user->role_id == 1 OR $user->permission == 1))  {

            // if ($user->tours->count()==0) {

            //     return redirect('/');
            // }  

            // elseif (previous_tour_tourist::where('tour_id', $id)->get()->count() == 0) {

            //     if(!($user->tours->contains(Tour::find($id))) ) {

            //         return redirect('/');

            //     }

            // }

            // elseif($user->previous_tour_tourist->count()==0) {

            //     return redirect('/');

            // }

            // elseif(!Tour::find($id)->previous_tour_tourist->sortBy('this_version')->first()->user->is($user))

            //     {
            //         return redirect('/');
            //     }


                if($user->previous_tour_tourist->count()==0) {

                    return redirect('/');

                }

                elseif(!($user->previous_tour_tourist->contains(Tour::find($id))) ) {

                    return redirect('/');

                }



                elseif(!(Tour::find($id)->previous_tour_tourist->sortBy('this_version')->first()->user->is($user)) ) {

                    return redirect('/');

                }

            }

        return $next($request);
    }
}

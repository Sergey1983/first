<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tour2;

use App\Tourist;

use App\Translit;

class Tours2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $tours = Tour2::all();

            return view('Tours2.tours2', compact('tours'));


        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    
    {
        
        return view('Tours2.tours2_create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tour2::create(request(['сity_from', 'hotel']) );

        $nameEng = Translit::translit($request['name']); 
        $lastNameEng = Translit::translit($request['lastName']);

        $request->request->add(['nameEng' => $nameEng, 'lastNameEng' => $lastNameEng]);

        Tourist::create(request(['name', 'lastName', 'nameEng', 'lastNameEng', 'birth_date']));

        $latest_tour = Tour2::count();
        $latest_tourist = Tourist::count();
        $tour = Tour2::find($latest_tour);
        $tour->tourists()->sync($latest_tourist);


        return redirect()->route('tours2_index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tour = Tour2::find($id);

        $tour_tourists = $tour->tourists;

        return view('Tours2.tours2_show', compact('tour', 'tour_tourists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

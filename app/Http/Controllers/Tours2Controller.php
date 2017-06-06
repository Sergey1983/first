<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\tours2_create_tableRequest;

use Validator;

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

$data=$request->all();
        $rules = [];
        foreach (range(0, count($data['doc_fullnumber']) - 1) as $index) $rules['doc_fullnumber.'.$index] = 'unique:tourists,doc_fullnumber';
        $validator = Validator::make($data, $rules, [
            'doc_fullnumber.unique' => 'Такой турист уже есть!'
        ]);
        if ($validator->fails()) return back()->withErrors($validator)->withInput();


        Tour2::create(request(['сity_from', 'hotel']) );



        $tourists_tocreate = count($request->name);


        /// ADDING TRANSLITERATED NAME + LASTNAME:

        for ($i=0; $i < $tourists_tocreate; $i++ ) {

            $nameEng[$i] = Translit::translit($request['name'][$i]); 
            $lastNameEng[$i] = Translit::translit($request['lastName'][$i]);

        }

        $request->request->add(['nameEng' => $nameEng, 'lastNameEng' =>  $lastNameEng]);



        // ADD TOUR, ADD TOURISTS, ADD TOUR-TOURISTS RELATIONS:

        $r=$request->all();



        for ($i=0; $i < $tourists_tocreate; $i++ ) {



            Tourist::create([   'name' => $r['name'][$i], 
                                'lastName' => $r['lastName'][$i],
                                'nameEng' => $r['nameEng'][$i],
                                'lastNameEng' => $r['lastNameEng'][$i],
                                'birth_date' => $r['birth_date'][$i],
                                'doc_fullnumber' => $r['doc_fullnumber'][$i]
                             ]);

            $latest_tour = Tour2::count();
            $latest_tourist = Tourist::count();

            $tour = Tour2::find($latest_tour);
            $tour->tourists()->attach($latest_tourist);

            }




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

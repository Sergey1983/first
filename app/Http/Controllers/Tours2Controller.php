<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\tourRequest;

use Validator;

use App\Tour2;

use App\Tourist;

use App\Translit;

use App\Cities;

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

        $cities = Cities::all()->pluck('city', 'city');
        
        return view('Tours2.tours2_create', compact('cities'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(tourRequest $request)
    // public function store(Request $request)
    {



        // ADDING TOUR AND STORING IT INTO $tour (we'll use it later)
        $tour = Tour2::create(request(['сity_from', 'hotel']) );

        $tourists_tocreate = count($request->name);

        // ADDING TRANSLITERATED NAME + LASTNAME:

        for ($i=0; $i < $tourists_tocreate; $i++ ) {

            $nameEng[$i] = Translit::translit($request['name'][$i]); 
            $lastNameEng[$i] = Translit::translit($request['lastName'][$i]);

        }

        
        $request->request->add(['nameEng' => $nameEng, 'lastNameEng' =>  $lastNameEng]);


        // ADD TOUR, ADD TOURISTS, ADD TOUR-TOURISTS RELATIONS:


        $r = $request->all();


        for ($i=0; $i < $tourists_tocreate; $i++ ) {

        
        // If tourist exists, then just get their id:
            

            if( Tourist::all()->contains('doc_fullnumber', $r['doc_fullnumber'][$i]) ) {

                $tourist_id = Tourist::

                                    where('doc_fullnumber', '=', $r['doc_fullnumber'][$i])

                                    ->value('id');

            }

        // If tourist doesn't exists, then add it to Database:

            else {

                Tourist::create([   'name' => $r['name'][$i], 
                                    'lastName' => $r['lastName'][$i],
                                    'nameEng' => $r['nameEng'][$i],
                                    'lastNameEng' => $r['lastNameEng'][$i],
                                    'birth_date' => $r['birth_date'][$i],
                                    'doc_fullnumber' => $r['doc_fullnumber'][$i]
                                     ]);

                $tourist_id = Tourist::count();


            }

            //TOUR-TOURISTS RELATIONS:


            if ($r['is_buyer'] == $i) {

                $is_buyer = 1;

                $is_tourist = $r['is_tourist']; // Buyer can be a tourist or not (1 or 0)

            } else {

                $is_buyer = 0;

                $is_tourist = 1; // Tourist is alwasy tourist (always 1)


            }




            $tour->tourists()

                ->attach($tourist_id, ['is_buyer' => $is_buyer, 'is_tourist' => $is_tourist]);

        }
          

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
  
        $cities = Cities::all()->pluck('city', 'city');
        
        return view('Tours2.tours2_edit', compact('cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(tourRequest $request, $id)
    {
        

        

        
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

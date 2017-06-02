<?php

namespace App\Http\Controllers;

use App\Tour;

use Illuminate\Http\Request;



class TestController extends Controller

{


		public function index() {

			$tours = Tour::all();

      		return view('test.name_sort', compact('tours'));


		}

    
	    public function search(Request $request) {


	    if ( $request->ajax() )	

	    { 
	    	$output="";
	    	$search = $request->get('search');

	        $tours = Tour::where('name', 'like', '%' .$search. '%')
              ->orWhere('lastName', 'like', '%' .$search. '%')
                ->get();


        if ($tours) {

   		foreach ($tours as $tour)



   			$output.='<tr>'.
						'<td>'. $tour->id .'</td>'.
						'<td>'. $tour->name .'</td>'.
						'<td>'. $tour->lastName .'</td>'.
						'<td>'. $tour->nameEng .'</td>'.
						'<td>'. $tour->lastNameEng .'</td>'.
						'<td>'. $tour->destination .'</td>'.
						'<td>'. $tour->departure .'</td>'.
						'<td>'. '<a href="/tours/' . $tour->id . '">
						<button>Редактировать</button> 
						</a>' .'</td>'.
					'<tr>';




        	}

        		return Response($output);
        


	    }

      
      }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\Contract_template;
use App\Contract_Templates_Draft;
use Illuminate\Support\Facades\Storage;
use App\Services\Printing;

class TemplateController extends Controller
{


    public function index($tour_type) {

        $doc_templates = Contract_template::where('tour_type', Printing::tour_type($tour_type))->get()->sortByDesc('created_at');

        $tour_type_rus = Printing::tour_type($tour_type);

        return view('Templates.'.$tour_type, compact('doc_templates', 'tour_type', 'tour_type_rus'));
    }

    public function create() {

    	return view('Templates.create_template');
    }

    public function store(Request $request ) {


    	   	$request->merge(['template_text' => self::CleanHTML($request)]);    	   	

	        Contract_template::create($request->all());

            $draft = Contract_Templates_Draft::updateOrCreate(['doc_type' => $request->doc_type, 'tour_type' => $request->tour_type ,'template_text'=>$request->template_text]);


    }

    public function store_draft(Request $request ) {


            $request->merge(['template_text' => self::CleanHTML($request)]);     


            $draft = Contract_Templates_Draft::updateOrCreate(['doc_type' => $request->doc_type, 'tour_type' => $request->tour_type], ['template_text'=>$request->template_text]);


    }


    public function edit($tour_type, $doc_type) {


            // $doc_type = $doc_type === 'contract' ? "Договор" : "Допсоглашение";

            $doc_type_rus = Printing::doc_type($doc_type);

            $tour_type_rus = Printing::tour_type($tour_type);


		    return view('Templates.edit_template', compact('doc_type_rus', 'tour_type_rus'));

    }

    public function update(Request $request) {

    	   	$request->merge(['template_text' => self::CleanHTML($request)]);    	   	

	        Contract_template::get()->last()->update(['template_text' => $request->template_text]);

    }
 

    public function getHtml(Request $request)
    
    {
    
   		$html = Contract_Templates_Draft::where([['doc_type', $request->doc_type], ['tour_type', $request->tour_type]])->get()->last()->template_text;
	

   		return $html;
    }

    public function cleanHTML ($request) {

        $dictionary = [

            '<br>' => '',

            '<b>' => '<strong>',
            
            '</b>' => '</strong>',

            '<table class="table table-bordered">' => '<table class="table table-bordered" style="width: 100%; border-color: #000000; border-width: 2px; text-align: center">',

            '<table class="table no-border">' => '<table class="table no-border" style="width: 100%;">',

            '<i>' => '<em>',

            '</i>' => '</em>',

            'div' => 'p',

            '<td><p>' => '<td>',

            '</p></td>' => '</td>',

            '<td>' => '<td><p>',

            '</td>' => '</p></td>'


        ];

        $from = array_keys($dictionary);

        $to = array_values($dictionary);

    		return $clean_template_text = str_replace($from, $to, $request->template_text);
    }


    public function template_show_version(Contract_template $template)
    {

        return view('Templates.template_show_version', compact('template'));
    }




}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Contract_template;

use App\Contract;

use App\Tour;

class PrintingController extends Controller
{


  public function choose($id) {


    return view('Tours2.print.contract_choose', compact('id'));

  }


  public function show($id) {

    $template = Contract_template::get()->last()->template_text;

    $template = self::process_template($template, $id);

    return view('Tours2.print.contract_preview', compact('template', 'id'));

  }
   
  
  public function print_contract ($id, Request $request) {

   	$user = auth()->user()->id;

    $template = Contract_template::find(1)->template_text;

    $template = self::process_template($template, $id);

    $html = Contract::create(['text'=> $template, 'tour_id'=> $id, 'user_id' => $user]);

    $html = $html->text;

    // Storage::makeDirectory('/public/contracts_'.$id);

	  // Storage::disk('local')->put('/public/contracts_'.$id.'/contract_temp'.$id.'.html', $template);

		// $url = storage_path('app').'/public/contracts_'.$id.'/contract_temp'.$id.'.html';



    	// $phpWord = \PhpOffice\PhpWord\IOFactory::load($url, 'HTML');
        
      $objWriter =  new \PhpOffice\PhpWord\PhpWord();

      $section = $objWriter->addSection();

      \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);
        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        try {

            if(!is_dir('/public/contracts/'.$id)) {

            Storage::makeDirectory('/public/contracts/'.$id);

            }

            $objWriter->save(storage_path('app').'/public/contracts/'.$id.'/contract.docx');

        } 

        catch (Exception $e) {
        
        }

        $download_link = '/download/contracts/'.$id.'/contract.docx';

        $request->session()->flash('download.in.the.next.request', $download_link);

        return redirect()->back();


 // response()->download(storage_path('app').'/helloWorld'.$id.'.docx');

 //          return redirect()->back();

   }

   public static function process_template ($template, $id) {

      $tour= Tour::find($id);

      $template = str_replace('$tour+id', $tour->id, $template);

      $template = str_replace('$tour+buyer+name', $tour->buyer->first()->name, $template);

      $template = str_replace('$tour+buyer+lastName', $tour->buyer->first()->lastName, $template);

      return $template;

   }


  public function versions($id) {



    return view('Tours2.print.contract_versions', compact('id'));

  }



}

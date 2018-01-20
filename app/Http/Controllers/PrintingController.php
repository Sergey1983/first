<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Contract_template;

use App\Contract;

use App\Tour;

use App\Document;

use App\Services\Printing;


class PrintingController extends Controller

{


  public function choose(Tour $tour) {

    return view('Print.contract_choose', compact('tour'));

  }


  public function show(Tour $tour, $doc_type) {

    $templates = Contract_template::where([['doc_type', Printing::doc_type($doc_type)], ['tour_type', $tour->tour_type ]])->get();

    $template = $templates->isNotEmpty() ? $templates->last()->template_text : 'Нет шаблонов для данного типа туров!';

    $template = Printing::process_template($template, $tour);

    $doc_type_rus = Printing::doc_type($doc_type);

    return view('Print.contract_preview', compact('template', 'tour', 'doc_type', 'doc_type_rus'));

  }
   
  
  public function print_contract (Tour $tour, $doc_type, Request $request) {


    $tour_version = $tour->previous_tour_tourist->sortBy('this_version')->last()->this_version;

    $user = auth()->user()->id;

      $templates_available = Contract_template::where([['doc_type', Printing::doc_type($doc_type)], ['tour_type', $tour->tour_type]])->get();

      if($templates_available->isEmpty()) {  return redirect()->back()->withErrors('Нет шаблона для этого типа тура и договора!'); }

    $template = $templates_available->last()->template_text;

    $html = Printing::process_template($template, $tour);


    // $html = htmlentities($html);

    // dd($html);

    $version_by_type = 1;

    $manager = Printing::findManager($tour);

    $buyer = $tour->buyer->first()->lastName.' '.substr($tour->buyer->first()->name, 0, 2).'.'.substr($tour->buyer->first()->patronymic, 0, 2);

        
      $objWriter =  new \PhpOffice\PhpWord\PhpWord();

      $objWriter->setDefaultFontName('Times New Roman');
      $objWriter->setDefaultFontSize(8);

      $sectionStyle = array(
          'marginTop' => 1000,
          'marginBottom' => 1000, 
          'marginLeft' => 1000,
          'marginRight' => 1000,
      );

      $section = $objWriter->addSection($sectionStyle);


      $footer = $section->addFooter();
      $table = $footer->addTable(array(
      'unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50,
      ));
        $table->addRow();
        $cell = $table->addCell()->addText("Турагент ".$manager."______________");
        $cell = $table->addCell()->addText("Заказчик ".$buyer."______________", array('bold'=>false), array('align'=>'right'));


      \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);



        try {


            if(Contract::where('tour_id', $tour->id)->get()->isEmpty()) {

              Storage::makeDirectory('/contracts/'.$tour->id);

              $filename = $doc_type.'_'.$tour->id.'_1.docx';

            } else {

                $contracts = Contract::where([['tour_id', $tour->id], ['doc_type', $doc_type]])->get();

                if($contracts->isNotEmpty()) {

                 $version_by_type = $contracts->sortBy('created_at')->last()->version_by_type; 

                 ++$version_by_type;

                }


             $filename = $doc_type.'_'.$tour->id.'_'.$version_by_type.'.docx';


            }

            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($objWriter, 'Word2007');
            
            ob_clean();
            
            $objWriter->save(storage_path('app').'/contracts/'.$tour->id.'/'.$filename);

            $contract = Contract::create(['text' => $template, 'tour_id' => $tour->id, 'doc_type' => $doc_type, 'version_by_type' => $version_by_type, 'tour_version'=>$tour_version, 'user_id' => $user, 'filename' => $filename]);



        } 

        catch (Exception $e) {
        
        }

        $download_link = '/download/'.$tour->id.'/'.$filename;

        $request->session()->flash('download.in.the.next.request', $download_link);

        return redirect()->back();


   }



  public function versions(Tour $tour) {


    $contract_versions = Contract::where('tour_id', $tour->id)->get();

    $contract_versions = $contract_versions->isNotEmpty() ? $contract_versions : 'У тура еще нет документов';


    return view('Print.contract_versions', compact('id', 'contract_versions', 'tour'));

  }


  public function download(Tour $tour, $filename = '' ) { 

  // Check if file exists in storage directory


   $file_path = storage_path('app/contracts/'.$tour->id.'/') . $filename; 

   
   if ( file_exists( $file_path ) ) { 

    return response()->download($file_path);


    // \Response::download( $file_path, $filename ); 

    } else { // Error

     exit( 'Requested file does not exist on our server!' );

      } 

}




}

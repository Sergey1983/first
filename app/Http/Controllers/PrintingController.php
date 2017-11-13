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

    // dump($template);

    // // $template = self::process_template($template, $id);

    // dd($template);

    return view('Tours2.print.contract_preview', compact('template', 'id'));

  }
   
  
  public function print_contract ($id, Request $request) {

   	$type = 'Договор';

    $user = auth()->user()->id;

    $template = Contract_template::get()->last()->template_text;

    $html = self::process_template($template, $id);

    $version_by_type = 1;

// $contract = new Contract; 

//     $contract->save()



    // $html = $contract->text;

    // Storage::makeDirectory('/public/contracts_'.$id);

	  // Storage::disk('local')->put('/public/contracts_'.$id.'/contract_temp'.$id.'.html', $template);

		// $url = storage_path('app').'/public/contracts_'.$id.'/contract_temp'.$id.'.html';



    	// $phpWord = \PhpOffice\PhpWord\IOFactory::load($url, 'HTML');
        
      $objWriter =  new \PhpOffice\PhpWord\PhpWord();

      $objWriter->setDefaultFontName('Times New Roman');
      $objWriter->setDefaultFontSize(8);

      $sectionStyle = array(
          'marginTop' => 1000,
          'marginBottom' => 1000, 
          'marginLeft' => 1000,
          'marginRight' => 1000,
          // 'colsNum' => 1,
      );

      $section = $objWriter->addSection($sectionStyle);


      $footer = $section->addFooter();
      $table = $footer->addTable(array(
      'unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50,
      ));
        $table->addRow();
        $cell = $table->addCell()->addText("Заказчик ______");
        $cell = $table->addCell()->addText("Турист ______", array('bold'=>false), array('align'=>'right'));


      \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);

      // dd($objWriter);

      // dd($objWriter);
        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        try {



            // if(!is_dir(storage_path('app').'/contracts/'.$id)) {

            //   Storage::makeDirectory('/contracts/'.$id);

            //   $filename = 'contract_'.$id.'_1.docx';

            // } 

            if(Contract::where('tour_id', $id)->get()->isEmpty()) {

              Storage::makeDirectory('/contracts/'.$id);

              $filename = 'contract_'.$id.'_1.docx';

            } else {

             $version_by_type = Contract::where([['tour_id', $id], ['contract_type', $type]])->get()->sortBy('created_at')->last()->version_by_type; 

             ++$version_by_type;

             $filename = 'contract_'.$id.'_'.$version_by_type.'.docx';


              // $files = Storage::files('/contracts/'.$id);

              // foreach ($files as $key => $file) {

              //     $name = pathinfo($file)['filename'];

              //     if(strpos($name, 'contract_'.$id.'_')!== false) {

              //       $count = str_replace('contract_'.$id.'_', '', $name);

              //     }

              //   }


              // $count = $count+1;

              // $filename = 'contract_'.$id.'_'.$count.'.docx';
            }

            $objWriter->save(storage_path('app').'/contracts/'.$id.'/'.$filename);

            $contract = Contract::create(['text' => $template, 'tour_id' => $id, 'contract_type' => $type, 'version_by_type' => $version_by_type, 'user_id' => $user, 'filename' => $filename]);

//'version' => $version,


            // $contract->fill(['filename' => $filename]);

            // $contract->save();

        } 

        catch (Exception $e) {
        
        }

        $download_link = '/download/contracts/'.$id.'/'.$filename;

        $request->session()->flash('download.in.the.next.request', $download_link);

        return redirect()->back();


 // response()->download(storage_path('app').'/helloWorld'.$id.'.docx');

 //          return redirect()->back();

   }

   public static function process_template ($template, $id) {

      $tour = Tour::find($id);

      $template = str_replace('$tour+id', $tour->id, $template);

      $template = str_replace('$tour+buyer+name', $tour->buyer->first()->name, $template);

      $template = str_replace('$tour+buyer+lastName', $tour->buyer->first()->lastName, $template);

      

      return $template;

   }


  public function versions($id) {

    $contract_versions = Contract::where('tour_id', $id)->get();

    $contract_versions = $contract_versions->isNotEmpty() ? $contract_versions : 'У тура еще нет документов';


    return view('Tours2.print.contract_versions', compact('id', 'contract_versions'));

  }



}

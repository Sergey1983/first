<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;


class Payments_from_tourist extends Model

{

    use SoftDeletes;
    protected $dates = ['deleted_at'];


       public function user() {

        return $this->belongsTo('App\User');
    	
    	}    

      public function user_deleted() {

        return $this->belongsTo('App\User', 'deleted_by', 'id');
        
      }  

       public function tour() {

        return $this->belongsTo('App\Tour');
    	
    	}    

       public function pay_method() {

        return $this->belongsTo('App\PayMethod');
      
      }    

}

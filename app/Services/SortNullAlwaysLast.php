<?php

namespace App\Services;


class SortNullAlwaysLast {


    public static function cmp($a, $b) {
            
            $a = $a['popularity'];
            $b = $b['popularity'];


            if(!($a==0 OR $b==0)) { return ($a<$b) ? -1 : 1; } 

            elseif($a==0 AND $b==0) {return 0;}
            
            elseif($a==0) {return 1;}
            
            else {return -1;}

    }

}
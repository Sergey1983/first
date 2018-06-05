<?php

namespace App\Services;

// use Illuminate\Database\Eloquent\Model;


//   

class RusMonth

{

    public static function convert($str) {


// 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
      
      $rus = array('/январь/ui', '/февраль/ui', '/март/ui', '/апрель/ui', '/май/ui', '/июнь/ui', '/июль/ui', '/август/ui', '/сентябрь/ui', '/октябрь/ui', '/ноябрь/ui', '/декабрь/ui');
      $lat = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
      // return str_ireplace($rus, $lat, $str);
      return preg_replace($rus, $lat, $str);

  }

}

<?php

namespace App\Services;

// use Illuminate\Database\Eloquent\Model;


//   

class RusMonth

{

    public static function convert($str) {


// 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
      
      $rus = array('/январь/i', '/февраль/i', '/март/i', '/апрель/i', '/май/i', '/июнь/i', '/июль/i', '/август/i', '/сентябрь/i', '/октябрь/i', '/ноябрь/i', '/декабрь/i');
      $lat = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
      // return str_ireplace($rus, $lat, $str);
      return preg_replace($rus, $lat, $str);

  }

}

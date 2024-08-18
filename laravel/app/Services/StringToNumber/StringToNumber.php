<?php

namespace App\Services\StringToNumber;



use Illuminate\Http\Request;
class StringToNumber
{
  public static function stringToNumber(Request $request): string {

      if(!empty($request->string)) {
          $string = $request->string;

          if(strlen($string) <= 32) {
              $arrayOfCodes= str_split($string);
              foreach($arrayOfCodes as $key=>$val) {
                  $arrayOfCodes[$key] = ord($val);
              }
              return array_sum($arrayOfCodes);
          } else {

              return 'Error: String more then 32 characters: ' . strlen($string);
          }

      } else {
          return 'Error: String is empty';
      }
  }
}

<?php
namespace App\Services;

use App\Models\Total;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class SummaryService
{

    public function FindDuplicate($array)
       {
        $newArray = [];
          foreach ($array as $current_key => $current_array) {
          //echo "current key: $current_key<br>";
          foreach ($array as $search_key => $search_array) {
              if ($search_array->code == $current_array->code) {
                  if ($search_key != $current_key) {
                 array_push($newArray,$search_array);
                  }
              }
          }
         }
         return $newArray;
      }

        public  function diffArray($arr1, $arr2) {
            $result = [];
            for ($i=0; $i < count($arr1) ; $i++) {
                for ($j=0; $j <  count($arr1); $j++) {
                    # code...
                }
            }
            foreach($arr1 as &$value1) {
                foreach($arr2 as &$value2) {
                    if ($value1->code == $value2->code && $value1->type != $value2->type) {
                        if ($value1->type == 'debit') {
                            if (@$value1->checked != 1  || $value2->checked != 1) {
                                $minus = $value1->amount - $value2->amount;
                                $value1->type =   ($minus>0) ? 'debit' : 'credit';
                                $value1->amount = abs($minus);
                                $value1->checked = 1;
                                $value2->checked = 1;
                                \array_push($result,$value1);
                            }

                        } else{
                            if (@$value1->checked != 1 || $value2->checked != 1) {
                            $minus = $value2->amount - $value1->amount;
                            $value1->type =  ($minus>0) ? 'debit' : 'credit';
                            $value1->amount = abs($minus);
                            $value1->checked = 1;
                            $value2->checked = 1;
                            \array_push($result,$value1);
                            }
                        }
                    }
                }
            }
            return $result;
        }

        public  function trackMerge ($toMerge,$merger) {
            $result = [];
            foreach ($toMerge as $currentValue) {
                foreach ($merger as $compareValue) {
                    if ($compareValue->code == $currentValue->code) {
                       array_push($result,$compareValue);
                    }else{
                        array_push($result,$currentValue);
                    }
                }
                }
                return $result;
        }

        public  function unique_multidimensional_array($array, $key) {
            $temp_array = array();
            $i = 0;
            $key_array = array();

            foreach($array as $val) {
                if (!in_array($val->$key, $key_array)) {
                    $key_array[$i] = $val->$key;
                    $temp_array[$i] = $val;
                }else if (in_array($val->$key, $key_array)){
                    unset($temp_array[$i-1]);
                }
                $i++;
            }
            return $temp_array;
        }


}


?>

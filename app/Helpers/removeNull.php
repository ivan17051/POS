<?php

if(!function_exists('removeNull')){
   function removeNull(&$validated, $isnullifyemptystring=false) {
      if($isnullifyemptystring){
         array_walk($validated, function($val,$key) use(&$validated){
            if(!isset($val) OR trim($val)=='') unset($validated[$key]);
            else $validated[$key] = trim($val);
         });
      }else{
         array_walk($validated, function($val,$key) use(&$validated){
            if(!isset($val)) unset($validated[$key]);
            else $validated[$key] = trim($val);
         });
      }
      
   }
}
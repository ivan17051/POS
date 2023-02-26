<?php

if(!function_exists('flashSuccess')){
   function flashSuccess($message) {
        request()->session()->flash('alert', [
            'icon' => 'check',
            'message' => $message,
            'status' => '3',
        ]);
   }
}

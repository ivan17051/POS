<?php

if(!function_exists('flashError')){
   function flashError($message) {
        request()->session()->flash('alert', [
            'icon' => 'close',
            'message' => $message,
            'status' => '2',
        ]);
   }
}
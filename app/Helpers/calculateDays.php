<?php

if(! function_exists('get_no_of_days')){
    function get_no_of_days($table, $col){
        $then = DB::table($table)->$col->diffForHumans();
        return $then;

    }

}
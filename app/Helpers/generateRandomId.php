<?php

if(! function_exists('unique_random')){
    function unique_random($table, $col, $max, $min){
        $unique = false;
        $tested = [];
        do{
            $random = rand($min, $max);
            if(in_array($random, $tested)){
                continue;
            }

            $count = DB::table($table)->where($col, '=', $random)->count();
            $tested[] = $random;
            if($count == 0){
                $unique = true;
            }
        }
        while(!$unique);

        return $random;


    }

}
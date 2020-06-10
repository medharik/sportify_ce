<?php

/**
 * 
 */
trait Helper_Date
{

    public static function date_fr($date)
    {
        $d = new DateTime($date);
        return $d->format('d-m-Y');
    }
    public static function date_diff($date_de, $date_a)
    {
        $de = new DateTime($date_de);
        $a = new DateTime($date_a);
        $interval = $de->diff($a); // 1-2  =-1 , 2-1 =1
        return $interval->format('%r%a');
    }
}

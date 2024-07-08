<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 09/05/2019
 * Time: 15:44
 */

namespace App\Helpers;


class Checkstatus
{
    public static function checkstatus($status,$status_id)
    {
        foreach ($status as $state) {
            if ($state['status_id'] != $status_id) {
                return false;
            } else {
                return true;
            }

        }
    }

    public static function validateOptions($array,$option)
    {
        foreach ($array as $key=>$value)
        {
            if($value!==$option)
            {
                return false;
            }else{
                return true;
            }
        }
    }

}
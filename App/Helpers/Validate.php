<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 22/02/2019
 * Time: 14:54
 */

namespace App\Helpers;


class Validate
{
    public static function validateIMEI($IMEI)
    {
        if(is_numeric($IMEI) && strlen($IMEI)==15){

            return $IMEI;

        } else if(!is_numeric($IMEI)) {
            echo $msg = '<span class="error"> Data entered was not numeric. Please go back and re-enter a valid IMEI</span>';
            die();
        } else if(strlen($IMEI) != 15) {
            echo  $msg = '<span class="error"> The number entered was not 15 digits long. Please go back and re-enter a valid IMEI</span>';
            die();
        }




    }

    public static function validatemulti($IMEI)
    {
        if(is_numeric($IMEI) && strlen($IMEI)==15){

            return $IMEI;

        } else if(!is_numeric($IMEI)) {
            echo $msg = '<span class="error"> Data entered was not numeric. Please go back and re-enter a valid IMEI</span>';

        } else if(strlen($IMEI) != 15) {
            echo  $msg = '<span class="error"> The number entered was not 15 digits long. Please go back and re-enter a valid IMEI</span>';

        }




    }




}
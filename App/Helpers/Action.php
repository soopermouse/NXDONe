<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 02/03/2019
 * Time: 04:41
 */

namespace App\Helpers;


class Action
{
    public static function updateRMAAction($status)
    {
        switch($status) {

            case 1:
                return $action = 13;

            case 7:
                return $action = 4;

            case 11:
                return $action = 11;

            case 3:
                return $action = 5;

            case 4:
                return $action = 6;

            case 5:
                return $action = 15;

            case 15:
                return $action = 7;

            case 6:
                return $action = 15;

            case 12:
                return $action = 8;

            case 13:
                return $action = 5;

            case 16:
                return $action = 9;

            case 8:
                return $action = 16;

            case 10:
                return $action = 11;


            default:return 'unknown action';
        }



    }

    public static function updateRebuyAction($status)
    {
        switch ($status) {

            case 1:
                return $action = 13;
            default:
                return 'unknown action';
        }

    }

    public static function updateRepairAction()
    {

    }

}
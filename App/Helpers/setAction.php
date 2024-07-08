<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 07/03/2019
 * Time: 06:31
 */

namespace App\Helpers;


class setAction
{


    public static function setRMAAction($rma_id,$status)
    {
        $update=Action::updateRMAAction($status);

    }

    public static function setRebuyAction($Order_id,$status)
    {
        $update=Action::updateRMAAction($status);

    }


}
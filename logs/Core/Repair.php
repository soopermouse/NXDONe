<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 04/12/2018
 * Time: 15:39
 */
namespace Core;
abstract class Repair
{

    public function __construct($device_imei,$order_id,$date)
    {



    }

     public function createRepairEvent($user_id,$event_type)
     {
        $start_time=date('d-m-Y',now());
         $repairevent=new Event($user_id,$event_type,$start_time);



     }

     public function ReplaceParts()
     {



     }






}
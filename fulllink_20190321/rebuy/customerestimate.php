<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 17/09/2018
 * Time: 08:54
 */

class CustomerEstimate
{
    public $orderid;
    public $device_model_estimated;
    public $device_type;
    public $storage;
    public $storage_type_estimated;
    public $Connection_type_estimated;
    public $quote_estimated;


    public function __construct($orderid,$device_model_estimated,$device_type,$storage,$storage_type_estimated,$Connection_type_estimated)
    {
        if(isset($device_type))
        {
            switch ():
                case($device_Type == "Iphone"):
                    $order = new rebuyIphone($device_model_estimated, $storage);
                    break;
                case($device_type == "Ipad"):
                    $order = new rebuyIpad($device_model_estimated, $storage, $storage_type_estimated, $Connection_type_estimated);
                    break;

        }else{
            echo "Please enter a device type";
            }
        }


    }






}
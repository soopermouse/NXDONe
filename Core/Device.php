<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 15/10/2018
 * Time: 12:09
 */

namespace Core;

use App\Models\DeviceModel;

class Device
{

    public $device_type;
    public $device_storage;
    public $device_connection;
    public $device_condition;
    public $device_price;
    public $device_quantity;



    public function __construct($device_type,$device_storage,$device_connection,$device_condition,$device_price,$quantity)
        {

            $this->device_type=$device_type;
            $this->device_storage=$device_storage;
            $this->device_connection=$device_connection;
            $this->device_condition=$device_condition;
            $this->device_price=$device_price;
            $this->device_quantity=$quantity;



        }






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


    public static function addDeviceToOrder($devices)
    {
        foreach($devices as $device)
        {
            
        }
    }




}
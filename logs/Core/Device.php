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
    public $device_id;
    public $order_id;
    public $device_type;
    public $device_storage;
    public $device_connection;
    public $device_condition;
    public $device_imei;
    public $device_quote;
    public $device_inspection;
    public $device_failcard;
    public $device_warranty;


    public function __construct($order_id,$device_type,$device_storage,$device_connection,$device_condition)
        {
            self::$device_id=self::$device_id+1;
            $this->order_id=$order_id;
            $this->device_type=$device_type;
            $this->device_storage=$device_storage;
            $this->device_connection=$device_connection;
            $this->device_condition=$device_condition;


        }

        public function getInspection($device_type, $device_storage,$device_connection,$device_colour)
        {






        }

        public function setFailcard($failcard)
        {





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


        public function getDeviceId($imei)
        {
            $this->device_id=DeviceModel::getDeviceId($imei);
            return $this->device_id;
        }




}
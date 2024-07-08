<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 18/11/2018
 * Time: 07:07
 */

namespace Core;
use App\Models\OrderModel;

class Warranty
{
     public $device_IMEI;
     public $order_id;
     public $order_date;
     public $warranty_start_date;
     public $warranty_end_date;



    public function __construct($device_IMEI, $order_id,$order_date)
    {
        $this->device_IMEI=$device_IMEI;
        $this->order_id=$order_id;
        $this->warranty_start_date=$order_date;



    }

    public function setstartdate()
    {


    }


    public function getstartdate()
    {


    }

    public function setenddate()
    {
        $this->warranty_end_date=strtotime ( '+ 2 year' , [$this->warranty_start_date ];
        return $this;
    }

    public function getenddate()
    {
        return $this->warranty_end_date;

    }

    public function createWarranty()
    {
        $warranty=OrderModel::createWarranty($this->order_id,$this->warranty_start_date,$this->warranty_end_date);
    }









}
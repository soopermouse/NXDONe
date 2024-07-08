<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 17/09/2018
 * Time: 08:28
 */

use Connection.php;
 class Inspection
 {
     public $orderid;
     public $device_model_inspected;
     public $device_type;
     public $device_storage_inspected;
     public $device_storage_type_inspected;
     public $device_connection_type_inspected;
     public $quote;
     public $condition_inspected;
     public $inspection_notes;
     public $device;
     public $display;

     public function construct($orderid,$device_type)
     {
         $this->order_id=$orderid;
         $this->device_type=$device_type;


     }

     public function getDeviceEstimated()
     {
       $device=Connection()->select('rebuyplus_device_customer_estimated_status','order_id=$this->orderid');
       $this->device=$device;
       return $this->device;

     }

     public function getDeviceType()
     {
         $this->device_type=$this->device['device_type'];
         return $this->device_type;


     }

    public function showEstimated()
    {
        if($this->device_type=='Iphone')
        {
            $this->display=array(
            'model estimated'=>$this->device['device_model_estimated'],
            'storage estimated'=>$this->device['device_storage_estimated'],
            'condition estimated'=>$this->device['device_condition_estimate']
        );

        }elseif($this->device_type=="Ipad")
        {
            $this->display=array(
                'model estimated'=>$this->device['device_model_estimated'],
                'display estimated'=>$this->device['device_display_estimated'],
                'storage estimated'=>$this->device['device_storage_estimated'],
                'storage type estimated'=>$this->device['storage_type_estimated'],
                'condition estimated'=>$this->device['device_condition_estimate']
            );


        }
        return $this->display;

    }



    public function getDeviceModelInspected($device_model_inspected)
    {
        $this->$device_model_inspected=$device_model_inspected;
        return $this;

    }

    public function setDeviceModelInspected()
    {
        return $this->$device_model_inspecte;

    }

     public function getStorageInspected($device_storage_inspected)
     {
         $this->$device_storage_inspected=$device_storage_inspected;
         return $this;

     }

     public function setStorageInspected()
     {
         return $this->$device_storage_inspected;

     }

     public function getStorageTypeInspected($device_storage_type_inspected)
     {
         $this->$device_storage_type_inspected=$device_storage_type_inspected;
         return $this;

     }

     public function setStorageTypeInspected()
     {
         return $this->$device_storage_type_inspected;

     }

     public function getConnectionTypeInspected($device_connection_type_inspected)
     {
         $this->$device_connection_type_inspected=$device_connection_type_inspected;
         return $this;

     }

     public function setConnectionTypeInspected()
     {
         return $this->$device_connection_type_inspected;

     }

    public function setInspectionNotes($inspectionnotes)
    {
        $this->inspection_notes=$inspectionnotes;
        return $this;

    }

    public function setConditionInspected($conditioninspected)
    {
        $this->condition_inspected=$conditioninspected;
        return $this;


    }

     public function getConditionInspected()
     {

         return $this->condition_inspected;


     }

     public function setInspectionNotes($inspection_notes)
     {
        $this->inspection_notes=$inspection_notes;
        return $his;


     }

     public function getInspectionNotes()
     {
         return $this->inspection_notes;

     }


     public function setQuote($quote)
     {
         if($this->condition_inspected!="GRADE 0")
         {
             $this->quote = $quote;
         }
         else{
             $this->notification="This device is unSuitable and should be returned or recycled";

         }
         return $this;


     }

     public function getQuote()
     {
         if(isset($this->quote))
         {
             $makeOffer=new RebuyOffer($this->orderid,$this->quote);
             $action=new Action($this->orderid,'Send Offer');
         }
         else {

             //enter action in case of grAde zero
         }

     }

     public function getQuote()
     {
         return $this->quote;

     }






     public function doInspection()
     {
        //insert inspection data into database
     }





 }
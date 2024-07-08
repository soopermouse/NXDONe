<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 18/09/2018
 * Time: 12:07
 */

 class Offer
 {
     public $orderid;
     public $quote;
     public $offerStatus;
     public $acceptancestatus;
     public $action;

     public function __construct($orderid,$quote)
     {
         $this->orderid=$orderid;
         $this->quote=$quote;



     }

     public function sendOffer()
     {
         if(isset($his->quote)){
             $this->action="Please send offer to customer";
         }
         if($sent=1){
             $this->acceptancestatus="3";


         }

         return $this->acceptancestatus;
     }

     public function setStatus()
     {
         if($his->sendOffer==3){

             $sql="SET `acceptation_status`='OFFER SENT' FROM `rebuyplus_order_status` WHERE `order_id'=$this->orderid;";
             new CRUD->select($sql)      ;
         }



     }







 }
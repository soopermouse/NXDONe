<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 12/09/2018
 * Time: 12:21
 */

 Class PaymentMethod

 {
     public $customerId;
     public $paymenttype;
     private $IBAN;
     private $Tnv;
     private $forzacredit;


     public function __construct($customerId,$paymenttype,$Iban,$Tnv)
     {
        $this->customerId=$customerId;
        $this->paymenttype=$paymenttype;
        $this->Iban=$Iban;
        $this->Tnv=$Tnv;


     }

     public function enterpayment()
     {


     }

     public function getPaymentData()
     {
         $query="(SELECT FROM rebuyplus_customer_payment 
         WHERE `cust_id`='$this->customerId')";
         return $query();

     }

     public function getCustomerIban()
     {

         $this->IBAN=$this->getPaymentData()=>['cust_iban'];
         return $this->IBAN;





     }

     public function getCustomerTnv()
    {
        $this->IBAN=$this->getPaymentData()=>['cust_iban_name'];
        return $this->Tnv;

     }


     public function getPaymentMethod()
     {
         $query="(SELECT FROM rebuyplus_order as r WHERE `order_id`='$this->order_id')";
         return $query();


     }

     public function setpaymentmethod(order_id)
     {
         $this->paymenttype=$payment_type_id;
         return $this;

     }

     public function getpaymentmethod()
     {
         return $this->paymenttype;

     }


     public function setIban($IBAN)
     {
         $this->IBAN=$IBAN;
         return $this;


     }


     public function getIban()
     {

         return $this->IBAN;


     }

     public function setTnv($Tnv)
     {
         $this->Tnv=$Tnv;
         return $this;

     }

     Public function getTnv()
     {
         return $this->Tnv;
     }

     public function setforzacredit($credit)
     {
         $this->forzacredit=$this->forzacredit+$credit;
         return $this->forzacredit;

     }










 }
<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 10/09/2018
 * Time: 11:28
 */

 class Customer
 {
     static $customerId =0;
     public $firstname;
     public $lastname;
     public $label;
     public $address;
     public $payment;



     public function __construct($firstname, $lastname,$streetno,$addition,$streetname,$city,$postcode,$country)
     {
         self::$customerId=self::$customerId+1;
         $this->firstname=$firstname;
         $this->lastname=$lastname;
         $this->address=new Address(self::$customerId,$streetno,$addition,$streetname,$city,$postcode,$country);

     }


     public function payment($paymenttype,$Iban,$Tnv)
     {
         $payment=new Payment(self::$customerId,$paymenttype,$Iban,$Tnv);


     }






 }

 $customerObj =new Customer('Jan','Jansen',395, '','Kruidenlaan','Tilburg','5044 CJ','NL');

 echo $customerObj->setlabel();
 $customerObj->setIban('NL24669988771220');
 $customerObj->setTnv('J. Jansen');
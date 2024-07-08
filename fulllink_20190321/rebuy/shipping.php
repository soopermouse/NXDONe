<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 13/09/2018
 * Time: 13:52
 */

Class Shipping
{

    public $orderId;
    public $address;
    public $name;
    public $label;
    public $carrier;
    public $CustomerId;
        CONST SENDER='Forza Refurbished';

    public function  __construct($orderId)
    {
    $this->OrderId=$orderId;



    }

    public function getCustomerId()
    {

        $orderquery="(SELECT `customer_id` FROM `rebuyplus_orders` WHERE `order_id`='$this->orderId')";
        $this-> CustomerIdustomerid=$orderquery[1];
        return $this->CustomerId;


    }

    public function getAddress()

    {

        $addressquery="(SELECT * FROM `customer_address` WHERE `customer_id`='$this->CustomerId';) ";
        $this->address=array(

            'street number'=>$addressquery[2],
            'street addition'=>$addressquery[3],
            'street name'=>$addressquery[4],
            'postcode'=>$addressquery[5],
            'city'=>$addressquery[6],
            'country'=>$addressquery[7]

        );

        return $this->address;
    }

    public function getName()
    {
        $namequery="(SELECT `customer_first_name`,`customer_last_name` FROM `rebuyplus_customer` WHERE `customer_id`='$this->CustomerId';)";
        $this->name=array(
            'first name'=>$namequery[1],
            'last name'=>$namequery[2]
        );

        return $this->name;



    }

    public function MakeLabel()
    {
        $this->label= array(
            'sender'=>self::SENDER,
            'receiver'=>$this->name,
            'receiver address'=>$this->address

        );

        return $this->label;

    }




    public function SendLabel($carrier)
      {
        if(isset($carrier))
        {
            switch ():
                case $carrier='PostNL':
                    echo "information sent to PostNL"

                case $carrier='UPS':
                    echo "please create pickup";

                case $carrier='DynaFix':
                    echo "information sent to DynaFix";

                    endswitch();

        }else{
            echo 'please select a carrier from the list";'

        }



      }

}
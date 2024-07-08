<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 24/09/2018
 * Time: 14:56
 */
namespace Core;
use App\Models\OrderModel;
use \Core\Customer;
class Order
{

   public $device_type;
   public $device_storage;
   public $device_colour;
   public $device_grade;
   public $customer_first_name;
   public $customer_last_name;
   public $customer_type;
   public $customer_email;
   public $customer_postcode;
   public $customer_street_number;
   public $customer_addition;
   public $customer_street_name;
   public $customer_city;
   public $customer_country;
   public $customer_payment_type;
   public $customer_iban;
   public $customer_tnv;
   public $customer_id;
   public $order_id;



    public function __construct($device_type,$device_storage,$device_colour,$device_grade,$customer_first_name,
                                $customer_last_name, $customer_type,$customer_email,$customer_postcode,$customer_street_number,
                                $customer_addition, $customer_street_name,$customer_city,$customer_country,$payment_method,$customer_iban,
                                $customer_tnv)
    {
        $this->device_type=$device_type;
        $this->device_storage=$device_storage;
        $this->device_colour=$device_colour;
        $this->device_grade=$device_grade;
        $this->customer_first_name=$customer_first_name;
        $this->customer_last_name= $customer_last_name;
        $this->customer_type=$customer_type;
        $this->customer_email=$customer_email;
        $this->customer_postcod=$customer_postcode;
        $this->customer_street_number=$customer_street_number;
        $this->customer_addition=$customer_addition;
        $this->customer_street_name=$customer_street_name;
        $this->customer_city=$customer_city;
        $this->customer_country=$customer_country;
        $this->payment_type=$payment_method;
        $this->customer_iban=$customer_iban;
        $this->customer_tnv=$customer_tnv;







    }

    public function makeCustomer($customer_first_name, $customer_last_name,$customer_email,$customer_postcode, $customer_street_number,$customer_addition, $customer_street_name,$customer_city,$customer_country)
    {
        $customer=new Customer($customer_first_name, $customer_last_name,$customer_email,$customer_postcode, $customer_street_number,$customer_addition, $customer_street_name,$customer_city,$customer_country);
        $this->customer_id=$customer->createCustomer();
        return $this->customer_id;



    }

    public function createOrder()
    {
        $this->order_id=OrderModel::createRebuyOrder($this->customer_id,$this->payment_type);
        return $this->order_id;

    }

    public function setDevice($IMEI)
    {

        $device=OrderModel::setIMEI($this->order_id,$IMEI);




    }
















}
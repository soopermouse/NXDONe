<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 11/10/2018
 * Time: 17:46
 */
namespace Core;

use App\Models\CustomerModel;

class Customer
{
    public $customer_id;
    public $customer_first_name;
    public $customer_last_name;
    Public $customer_email_address;
    public $customer_phone_no;
    public $customer_type;
    public $customer_post_code;
    public $customer_street_number;
    public $customer_addition;
    public $customer_street_name;
    public $customer_city;
    public $customer_country;
    public $address;








    public function __construct($customer_first_name, $customer_last_name,$customer_email_address,$customer_number,$customer_type,$customer_post_code, $customer_street_number,$customer_addition, $customer_street_name,$customer_city,$customer_country)
    {

        $this->customer_first_name=$customer_first_name;
        $this->customer_last_name=$customer_last_name;
        $this->customer_email_address=$customer_email_address;
        $this->customer_phone_no=$customer_number;
        $this->customer_type=$customer_type;
        $this->customer_post_code=$customer_post_code;
        $this->customer_street_number=$customer_street_number;
        $this->customer_addition=$customer_addition;
        $this->customer_street_name=$customer_street_name;
        $this->customer_city=$customer_city;
        $this->customer_country=$customer_country;



    }



    public function getAddress()
    {
        return $this->address;



    }

    public function createCustomer()
    {
       $this->customer_id= CustomerModel::createCustomer( $this->customer_first_name,$this->customer_last_name,$this->customer_email_address,$this->customer_phone_no,$this->customer_type);
       return $this->customer_id;
    }

    public function setAddress()

    {
        CustomerModel::createAddress($this->customer_id,$this->customer_post_code,$this->customer_street_number,$this->customer_addition,$this->customer_street_name,$this->customer_city,$this->customer_country);

    }







}
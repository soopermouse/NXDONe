<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 12/09/2018
 * Time: 15:00
 */

Class Address
{
    public $streetno;
    public $addition;
    public $streetname;
    public $city;
    public $postcode;
    public $country;
    public $customerid;
    public $address;
    public $customer;




    public function __construct($customerid, $streetno,$streetaddition,$streetname,$city,$postcode,$country)
    {
        $this->streetno=$streetno;
        $this->streetaddition=$streetaddition;
        $this->streetname=$streetname;
        $this->city=$city;
        $this->postcode=$postcode;
        $this->country=$country;
        $this->customerid=$customerid;



    }

    public function checkPostcode()
    {
        $this->postcode->checkpostcode();
        return true;




    }


    public function enterAddress()
    {
        if($this->checkPostcode()=true) {

            $addressquery = "(INSERT INTO customer_address  `customer_id`, `street_no`, `addition`, `street_name,`postcode`,`city`,`country` VALUES ($this->customerid,$this->streetno,$this->addition,$this->streetname,$this->postcode,$this->city,$this->country);)";
            if ($addressquery) {
                return true;

            } else {

                echo "there was an error entering the address into the database";
            }
        }else{

            echo "the postcode is incorrect. Please try again";
        }




    }


    public function getAddress()
    {
        $getaddress="(SELECT * FROM customer_address where `customer_id`=$this->customerid;)";
        $address = array(
            'streetno.' => $getaddress[1],
            'streetaddition' => $getaddress[2],
            'streetname' => $getaddress[3],
            'postcode' => $getaddress[4],
            'city' => $getaddress[5],
            'country' => $getaddress[6],

        );
        return $address;

    }

    public function getCustomer()
    {
        $customerquery="(SELECT `customer_first_name`,`customer_last_name`,`customer_emai1` FROM rebuyplus_customer WHERE `customer_id`=$customerId)";
        $this->customer=array(
            'firstname'=>$customerquery[1],
            'last name'=>$customerquery[2],
            'email'=>$customerquery[3]


        );
        return $this->customer;



    }


    public function setlabel()
    {
        $this->label= array(
            'streetno.'=>$this->streetno,
            'addition'=>$this->streetaddition,
            'city'=>$this->city,
            'postcode'=>$this->postcode,
            'country'=>$this->country

        );
        return $this;



    }


    public function getLabel()
    {
        return $this->label;
    }

}
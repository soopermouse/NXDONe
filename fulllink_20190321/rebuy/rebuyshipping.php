<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 19/09/2018
 * Time: 09:22
 */
 class RebuyShipping
 {
     public $orderid;
     public $carrier;
     public $customeraddress;
     public $addressforza= "Graaf Engelbertlaan 75".</br>."4837 DS Breda".</br>."The Netherlands";

     public $date;
     public $status;


    public function __construct($orderid,$customeraddress)
    {
        $this->orderid=$orderid;
        $this->customeraddress=$customeraddress;
        $this->date=date();




    }

    public function makelabel()
    {

        

    }


    public function setDtatus()
    {



    }

 }
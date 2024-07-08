<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 15/10/2018
 * Time: 11:23
 */

namespace Core;

use App\Models\FinanceModel;

class Payment
{
    public $customer_first_name;
    public $customer_last_name;
    public $customer_email;
    public $customer_payment_type;
    public $customer_IBAN;
    public $customer_tnv;
    public $customer_credit;
    public $order_id;
    public $customer_id;

    public function __construct( $customer_first_name, $customer_last_name,$customer_email,$customer_payment_type, $customer_IBAN,$customer_tnv,$order_id)
    {
        $this->$customer_first_name=$customer_first_name;
        $this->$customer_last_name=$customer_last_name;
        $this-> $customer_email=$customer_email;
        $this->$customer_payment_type=$customer_payment_type;
        $this->$customer_IBAN=$customer_IBAN;
        $this->$customer_tnv=$customer_tnv;
        $this->order_id=$order_id;

        $payment=FinanceModel::createPaymentData($this->customer_id,$this->order_id,$this->customer_IBAN,$this->customer_tnv);

    }

    public function getCustomerInfo()
    {



    }


    public function setPayment($quote)
    {
        if($this->customer_payment_type="IBAN"){
           self::makeBankPayment($quote);

        }elseif($this->customer_payment_type=="Forza Credit")
        {
            self::makeForzaCreditPayment($quote);
        }


    }

    public static function makeBankPayment($quote)
    {









    }

    public function setRebuyPayment($quote)
    {
        // set credit

        $this->customer_credit=$this->customer_credit +$quote;
        return $this->customer_credit;
    }


    public static function setRebuyPayment($device_model,$device_storage,$device_connection,$device_condition)
    {
        switch($device_model)
        {
            case 1:
                if($devicestorage==1)





        }

    }






}